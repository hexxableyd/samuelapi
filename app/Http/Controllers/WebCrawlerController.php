<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twitter;

class WebCrawlerController extends Controller
{
    public function parse($link, $numposts)
    {
        if(isset($link))
        {
            $web = $this->checkLink($link);
            if($web['success']) {
                switch ($web['website']) {
                    case 'reddit':
                        // GETS OBJECT FROM REDDIT URL
                        $json = $this->getObjectReddit($web['link']);
                        if ($json['success']) {
                            try{
                                // DECODES THE URL TO GET THE JSON ARRAY
                                $web['object'] = json_decode($json['object']);
                                // GETS CREATOR DATA FROM OBJECT
                                $reddit_creator = $web['object'][0]->data->children;
                                $date = new \DateTime();
                                $date->setTimestamp($reddit_creator[0]->data->created);
                                $web['creator'] = array(
                                    'theme' => 'skin-red',
                                    'icon' => '/img/ico/reddit.svg',
                                    'title' => $this->regStr($reddit_creator[0]->data->title),
                                    'content' => $this->regStr($reddit_creator[0]->data->selftext),
                                    'author' => $this->regStr($reddit_creator[0]->data->author),
                                    'author-link' => 'https://www.reddit.com/user/' . $reddit_creator[0]->data->author,
                                    'permalink' => $reddit_creator[0]->data->permalink,
                                    'upvote' => $reddit_creator[0]->data->ups,
                                    'date' => $date->format('Y-m-d')
                                );
                                if (!empty($reddit_creator[0]->data->preview)) {
                                    $web['creator']['img-url'] = $reddit_creator[0]->data->preview->images[0]->source->url;
                                }
                                // ATTEMPTS TO GET REPLY DATA FROM OBJECT
                                $reply = $this->getRepliesReddit($web['object'][1]);
                                if($reply['status'])
                                {
                                    // IF SUCCESSFUL, CUTS EXCESS DATA
                                    $web['replies'] = $reply['replies'];
                                    if(count($web['replies']) > $numposts)
                                    {
                                        $web['replies'] = array_slice($web['replies'], 0, $numposts);
                                    }

                                    // THE RETURN REPLY IF SUCCESSFUL
                                    $web['message'] = "<b>" . $web['creator']['title'] . "</b>";
                                    $web['message'] .= "<br>by <i>" . $web['creator']['author'] . "</i>";
                                }
                                else
                                {
                                    $web['success'] = $reply['status'];
                                    $web['errors'] = $reply['errors'];
                                }
                            }
                            catch(\Exception $e){
                                $web['success'] = FALSE;
                                $web['errors'] = "Don't worry, it just seems like there's some error.<br><em>LINK: ".$web['link']."</em><br><b>ERROR CODE: ".$e->getMessage()."</b>";
                            }
                        } else {
                            $web['success'] = FALSE;
                            $web['errors'] = $json['errors'];
                        }
                        break;
                    case 'youtube':
                        // EXPLODES THE LINK TO GET THE VIDEO ID
                        $vidID = explode("?v=", $web['link']);
                        // GETS THE VIDEO OBJECT FROM URL BY VIDEO ID
                        $json = $this->getObjectYoutube($vidID[1]);
                        if ($json['success']) {
                            // GETS VIDEO CREATOR DATA FROM OBJECT
                            $video_creator = json_decode($json['object-creator']);
                            $web['creator'] = array(
                                'theme' => 'skin-red',
                                'icon' => '/img/ico/youtube.png',
                                'title' => $this->regStr($video_creator->items[0]->snippet->title),
                                'content' => $this->regStr($video_creator->items[0]->snippet->description),
                                'author' => $this->regStr($video_creator->items[0]->snippet->channelTitle),
                                'author-link' => 'https://www.youtube.com/channel/' . $video_creator->items[0]->snippet->channelId,
                                'permalink' => explode('youtube.com', $link)[1],
                                'embed' => explode('youtube.com/watch?v=', $link)[1],
                                'upvote' => "N/A",
                                'date' => date('Y-m-d', strtotime($video_creator->items[0]->snippet->publishedAt))
                            );
                            // GETS COMMENT THREAD DATA FROM OBJECT
                            $video_comments = json_decode($json['object-comments']);
                            $web['replies'] = $this->getRepliesYoutube($video_comments);
                            try{
                                // RECURSION OF FUNCTIONS TO GET MORE THAN 100 COMMENTS WHICH YOUTUBE API LIMITS ON ONE REQUEST
                                while(!empty($video_comments->nextPageToken) && count($web['replies'])<$numposts){
                                    $next_page = $this->getObjectYoutube($vidID[1], false, $video_comments->nextPageToken);
                                    $video_comments = json_decode($next_page['object-comments']);
                                    $web['replies'] = array_merge($web['replies'], $this->getRepliesYoutube($video_comments));
                                }
                            }
                            catch (\Exception $e)
                            {
//                              break;
                            }
                            if(count($web['replies']) > $numposts)
                            {
                                $web['replies'] = array_slice($web['replies'], 0, $numposts);
                            }
                            // THE RETURN REPLY IF SUCCESSFUL
                            $web['message'] = "<b>" . $web['creator']['title'] . "</b>";
                            $web['message'] .= "<br>by <i>" . $web['creator']['author'] . "</i>";
                        } else {
                            $web['success'] = FALSE;
                            $web['errors'] = $json['errors'];
                        }
                        break;
                    case 'twitter' :
                        $web_url = explode('&',parse_url($web['link'], PHP_URL_QUERY));
                        foreach ($web_url as $obj)
                        {
                            if((strpos(strtoupper($obj),"Q=")!==FALSE))
                            {
                                $queue = urldecode(explode('q=', $obj)[1]);
                                $web['queue'] = $queue;
                                break;
                            }
                        }
                        if(isset($queue))
                        {
                            try{
                                // TWITTER API ALREADY RETURNS JSON
                                $json = $this->getObjectTwitter($queue);
                                if($json['success'])
                                {
                                    // GETS OBJECT
                                    $web['object'] = $json['object'];

                                    // GETS CREATOR ARRAY FROM JSON
                                    $web['creator'] = array(
                                        'theme' => 'skin-blue',
                                        'icon' => '/img/ico/twitter.png',
                                        'title' => 'Query : '.$queue,
                                        'content' => "",
                                        'author' => "You Searched",
                                        'author-link' => $link,
                                        'permalink' => explode('twitter.com', $link)[1],
                                        'upvote' => "N/A",
                                        'date' => date('Y-m-d')
                                    );
                                    // GETS TWITTER THREAD FROM JSON
                                    $web['replies'] = array();
                                    foreach ($web['object']->statuses as $threads)
                                    {
                                        array_push($web['replies'], array(
                                            'content' => $this->regStr($threads->text),
                                            'author' => $this->regStr($threads->user->name),
                                            'date' => date('Y-m-d', strtotime($threads->created_at))
                                        ));
                                    }
                                    if(count($web['replies']) > $numposts)
                                    {
                                        $web['replies'] = array_slice($web['replies'], 0, $numposts);
                                    }

                                    // MESSAGE REPLY
                                    $web['message'] = "<b>" . $web['creator']['title'] . "</b>";
                                }
                                else
                                {
                                    $web['success'] = FALSE;
                                    $web['errors'] = $json['errors'];
                                }
                            }
                            catch (\Exception $e)
                            {
                                // QWERTY LOG ERROR
                                $web['success'] = FALSE;
                                $web['errors'] = "Something went wrong with getting the Twitter Object";
                            }
                        }
                        break;
                    case 'forum.philboxing':
                        // GETS OBJECT FROM URL
                        $json = $this->getObjectForum($web['link'], 'philboxing');

                        if($json['success']){
                            // GETS CREATOR ARRAY FROM JSON
                            $web['creator'] = array(
                                'theme' => 'skin-blue',
                                'icon' => '/img/ico/philbox.jpg',
                                'title' => $this->regStr($json['title']),
                                'content' => "",
                                'author' => "Author",
                                'author-link' => $link,
                                'permalink' => explode('philboxing.com', $link)[1],
                                'upvote' => "N/A",
                                'date' => date('Y-m-d')
                            );

                            // GETS REPLIES FROM ARRAY
                            $web['replies'] = $json['discussion'];
                            $ctr = 15;
                            while(count($web['replies']) < $numposts)
                            {
                                try
                                {
                                    $temp = $this->getObjectForum($web['link'].'&start='.$ctr, 'philboxing');
                                    $web['replies'] = array_merge($web['replies'], $temp['discussion']);
                                }
                                catch (\Exception $e)
                                {
//                                    $web['success'] = FALSE;
//                                    $web['errors'] = "Error on ".$web['link'].'&start='.$ctr;
                                    break 2;
                                }
                                finally
                                {
                                    $ctr += 15;
                                }
                            }
                            if(count($web['replies']) > $numposts)
                            {
                                $web['replies'] = array_slice($web['replies'], 0, $numposts);
                            }

                            // MESSAGE REPLY
                            $web['message'] = "<b>" . $web['creator']['title'] . "</b>";
                        }
                        else{
                            $web['success'] = FALSE;
                            $web['errors'] = $json['errors'];
                        }
                        break;
                    case 'forum.generic':
                        // GETS OBJECT FROM FORUM URL
                        $json = $this->getObjectDissBot($web['link']);

                        if ($json['success']) {
                            // DECODES THE URL TO GET THE JSON ARRAY
                            $web['object'] = json_decode($json['object']);

                            // GETS CREATOR DATA FROM OBJECT
                            $web['creator'] = array(
                                'theme' => 'skin-red',
                                'icon' => '/img/ico/discussion.png',
                                'title' => $this->regStr($web['object']->objects[0]->title),
                                'content' => "",
                                'author' => "Author",
                                'author-link' => $web['link'],
                                'permalink' => $web['link'],
                                'upvote' => "N/A",
                                'date' => date('Y-m-d')
                            );

                            // GETS REPLY DATA FROM OBJECT
                            $web['replies'] = array();
                            foreach($web['object']->objects[0]->posts as $posts)
                            {
                                array_push($web['replies'], array(
                                    'content' => $this->regStr($posts->text),
                                    'author' => $this->regStr($posts->author),
                                    'date' => $posts->date,
                                ));
                            }
//                            if(count($web['replies']) > $numposts)
//                            {
//                                $web['replies'] = array_slice($web['replies'], 0, $numposts);
//                            }

                            // THE RETURN REPLY IF SUCCESSFUL
                            $web['message'] = "<b>" . $web['creator']['title'] . "</b>";
                        } else {
                            $web['success'] = FALSE;
                            $web['errors'] = $json['errors'];
                        }
                        break;
                    default:
                        break;
                }
            }
            return $web;
        }
        else
        {
            return false;
        }
    }

    public function checkLink($link)
    {
        $result = array();

        // CHECKS IF THERE IS HTTP or HTTPS on BEGINNING OF URL
        $parsed = parse_url($link);
        if (empty($parsed['scheme'])) {
            $result['link'] = 'http://' . ltrim($link, '/');
        }
        else
        {
            $result['link'] = $link;
        }

        // CHECKS WHAT KIND OF LINK IT IS
        if((strpos(strtoupper(parse_url($result['link'], PHP_URL_HOST)),"REDDIT")!==FALSE)) {
            if((strpos(strtoupper($result['link']),"/R/")!==FALSE)) {
                $result['success'] = TRUE;
                $result['message'] = "Your link is a Reddit Link!";
                $result['website'] = "reddit";
            }
            else
            {
                $result['success'] = FALSE;
                $result['errors'] = 'We only "Linkify" Reddit threads on subreddits and reddit discussions! And we\'re pretty sure your link is not one of them.';
                $result['website'] = NULL;
            }
        }
        else if((strpos(strtoupper(parse_url($result['link'], PHP_URL_HOST)),"YOUTUBE")!==FALSE)) {
            if((strpos(strtoupper($result['link']),"WATCH?V=")!==FALSE)) {
                $result['success'] = TRUE;
                $result['message'] = "Your link is a YouTube Link!";
                $result['website'] = "youtube";
            }
            else
            {
                $result['success'] = FALSE;
                $result['errors'] = 'We only "Linkify" YouTube comments on videos! And we\'re pretty sure your link is not one of them.';
                $result['website'] = NULL;
            }
        }
        else if((strpos(strtoupper(parse_url($result['link'], PHP_URL_HOST)),"FACEBOOK")!==FALSE)) {
            if((strpos(strtoupper($result['link']),"/POSTS/")!=FALSE)) {
//                $result['success'] = TRUE;
//                $result['message'] = "Your link is a Facebook Link!";
//                $result['website'] = "facebook";

                $result['success'] = FALSE;
                $result['errors'] = 'Sorry, but it seems like this specific Forum is not yet supported :(';

                $result['website'] = NULL;
            }
            else
            {
                $result['success'] = FALSE;
                $result['errors'] = 'We only "Linkify" comments on Facebook posts! And we\'re pretty sure your link is not one of them.';
                $result['website'] = NULL;
            }
        }
        else if((strpos(strtoupper(parse_url($result['link'], PHP_URL_HOST)),"TWITTER")!==FALSE)) {
            if((strpos(strtoupper($result['link']),"/SEARCH?Q=")!=FALSE)) {
                $result['success'] = TRUE;
                $result['message'] = "Your link is a Twitter Link!";
                $result['website'] = "twitter";
            }
            else
            {
                $result['success'] = FALSE;
                $result['errors'] = 'We only "Linkify" tweet searches on Twitter! And we\'re pretty sure your link is not one of them.';
                $result['website'] = NULL;
            }
        }
        else if((strpos(strtoupper($result['link']),"FORUM")!==FALSE)) {
            if((strpos(strtoupper($result['link']),"PHILBOXING")!==FALSE))
            {
                if((strpos(strtoupper($result['link']),"T=")!==FALSE)) {
                    $result['success'] = TRUE;
                    $result['message'] = "Your link is a Philboxing Forum Link!";
                    $result['website'] = "forum.philboxing";
                }
                else
                {
                    $result['success'] = FALSE;
                    $result['errors'] = 'We only "Linkify" valid and existing forum posts! And we\'re pretty sure your link is not one of them.';
                    $result['website'] = NULL;
                }
            }
            else
            {
                $result['success'] = FALSE;
                $result['errors'] = 'Sorry, but it seems like this specific Forum is not yet supported :(';
                $result['website'] = NULL;

//                $result['success'] = TRUE;
//                $result['message'] = 'Your link is a Forum Link!';
//                $result['website'] = 'forum.generic';
            }
        }
        else{
//            $result['success'] = TRUE;
//            $result['message'] = 'Your link is a Forum Link!';
//            $result['website'] = 'forum.generic';

            $result['success'] = FALSE;
            $result['errors'] = 'It seems like '.parse_url($result['link'], PHP_URL_HOST)." is not supported yet! :(";
            $result['website'] = NULL;
        }

        return $result;
    }

    // TODO: LOG ERRORS, ON DB, THROWN ALONG WITH THE LINK THAT CAUSED THE ERROR
    // REDDIT FUNCTIONS
    public function getObjectReddit($link)
    {
        $result = array();
        try{
            $result['success'] = TRUE;
            $result['object'] = file_get_contents($link.".json");
        }
        catch (\Exception $e){
            $result['success'] = FALSE;
            $result['errors'] = "Don't worry, it just seems like there's some error.<br><b>ERROR CODE: 404 Your Link is not Valid</b>";
        }
        finally{
            return $result;
        }
    }
    public function getRepliesReddit($object)
    {
        $reddit_replies = $object->data->children;
        $replies = array();
        try{
            $replies['status'] = TRUE;
            $replies['replies'] = array();
            foreach($reddit_replies as $rep)
            {
                if ($rep->kind === 't1' && $rep->data->body !== "[deleted]")
                {
                    $date = new \DateTime();
                    $date->setTimestamp($rep->data->created);
                    array_push($replies['replies'], array(
                        'content' => $this->regStr($rep->data->body),
                        'author' => $this->regStr($rep->data->author),
                        'date' => $date->format('Y-m-d')
                    ));
                    if($rep->data->replies != NULL && $rep->data->replies !== "")
                    {
                        $reps = $this->getRepliesReddit($rep->data->replies);
                        if($reps['status'])
                        {
                            $replies['replies'] = array_merge($replies['replies'], $reps['replies']);
                        }
                    }
                }
            }
        }
        catch(\Exception $e){
            $replies['status'] = FALSE;
            $replies['errors'] = "Don't worry, it just seems like there's some error.<br><b>ERROR CODE: ".$e->getMessage()."</b>";
        }
        finally{
            return $replies;
        }
    }

    // YOUTUBE FUNCTIONS
    public function getObjectYoutube($videoid, $title=true, $nextPageToken="")
    {
        $apikey = env('YOUTUBE_API_KEY');
        $result = array();
        try{
            // REQUEST ON COMMENT THREADS
            $request = "https://www.googleapis.com/youtube/v3/commentThreads?part=snippet&videoId=".$videoid."&key=".$apikey."&maxResults=100&order=relevance&textFormat=plainText";
            if ($nextPageToken !== "")
            {
                $request .= "&pageToken=".$nextPageToken;
            }
            $result['object-comments'] = file_get_contents($request);
            // REQUEST ON VIDEO INFORMATION
            if($title)
            {
                $result['object-creator'] = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" . $videoid . "&key=" . $apikey);
            }
            $result['success'] = TRUE;
        }
        catch (\Exception $e){
            $result['success'] = FALSE;
            $result['errors'] = "Don't worry, it just seems like there's some error.<br><b>ERROR CODE: ".$e->getMessage()."</b>";
        }
        finally{
            return $result;
        }
    }
    public function getRepliesYoutube($object)
    {
        try{
            $discussion = $object->items;
            $replies = array();
            foreach($discussion as $rep)
            {
                $reply = $rep->snippet->topLevelComment->snippet;
                array_push($replies, array(
                    'content' => $this->regStr($reply->textOriginal),
                    'author' => $this->regStr($reply->authorDisplayName),
                    'date' => date('Y-m-d', strtotime($reply->updatedAt))
                ));
            }
        }
        catch (\Exception $e){
        }
        finally{
            return $replies;
        }
    }

    // FORUM FUNCTIONS
    public function getObjectForum($link, $type)
    {
        $result = array();
        try{
            $result['success'] = TRUE;

            $result['object'] = file_get_contents($link);
            // SPECIFIC FORUM FUNCTIONS
            switch($type)
            {
                case 'philboxing':
                    // INIT DOM
                    $dom = new \DOMDocument;
                    $dom->loadHTML($result['object']);
                    // INIT DOMXPATH
                    $finder = new \DomXPath($dom);
                    // FORUM TITLE
                    $title = $dom->getElementsByTagName('title');
                    foreach($title as $topic)
                    {
                        $result['title'] = explode('• View topic - ', $topic->textContent)[1];
                    }
                    // FORUM COMMENTS
                    $author = $finder->query("//*[contains(@class, 'postauthor')]");
                    $content = $finder->query("//*[contains(@class, 'postbody')]");
                    // TODO: FILTER CONTENT REMOVE NOT NECESSARY CLUTTER
//                    for($count = 0; $count < count($content); $count++) {
//                        if (strpos($content[$count]->textContent, '_________________') === false && $content[$count]->textContent !== "")
//                        {
//                            array_splice($content, $count, 1);
//                        }
//                    }
                    $date = $finder->query("//*[contains(@class, 'gensmall')]");
                    $posted = array();
                    foreach($date as $datetime)
                    {
                        if (strpos($datetime->textContent, 'Posted:') !== false) {
                            array_push($posted,explode("Posted:",$datetime->textContent)[1]);
                        }
                    }
                    $result['discussion'] = array();
                    foreach($author as $ctr2 => $auth)
                    {
                        if (strpos($content[$ctr2]->textContent, '_________________') === false && $content[$ctr2]->textContent !== "") {
                            array_push($result['discussion'], array(
                                'author' => $auth->textContent,
                                'content' => $content[$ctr2]->textContent,
                                'date' => $posted[$ctr2]
                            ));
                        }
                    }
                    break;
                default:
                    break;
            }
        }
        catch (\RuntimeException $e){
            $result['success'] = FALSE;
            $result['errors'] = "Don't worry, it just seems like there's some error.\nERROR CODE: Runtime Error || GET Forum Discussion";
        }
        catch (\Exception $e){
            $result['success'] = FALSE;
            $result['errors'] = "Don't worry, it just seems like there's some error.\nERROR CODE: Exception Error || GET Forum Discussion";
        }
        finally{
            return $result;
        }
    }

    // TWITTER FUNCTIONS
    public function getObjectTwitter($queue)
    {
        $result = array();
        try{
            $result['success'] = TRUE;
            $result['object'] = Twitter::getSearch([
                'q' => $queue,
                'count' => 100,
                'result_type' => 'mixed',
                'lang' => 'en',
            ]);
        }
        catch (\RuntimeException $e){
            $result['success'] = FALSE;
            $result['errors'] = "Don't worry, it just seems like there's some error.\nERROR CODE: Runtime Error";
        }
        catch (\Exception $e){
            $result['success'] = FALSE;
            $result['errors'] = "Don't worry, it just seems like there's some error.\nERROR CODE: Exception Error";
        }
        finally{
            return $result;
        }
    }

    // DISCUSSION API FUNCTIONS
    public function getObjectDissBot($link){
        $result = array();
        $token = env('DIFFBOT_API_KEY');
        try{
            $result['success'] = TRUE;
            $result['object'] = file_get_contents("https://api.diffbot.com/v3/discussion?token=".$token."&url=".urlencode($link));
        }
        catch (\RuntimeException $e){
            $result['success'] = FALSE;
            $result['errors'] = "Don't worry, it just seems like there's some error.\nERROR CODE: Runtime Error";
        }
        catch (\Exception $e){
            $result['success'] = FALSE;
            $result['errors'] = "Don't worry, it just seems like there's some error.\nERROR CODE: Exception Error";
        }
        finally{
            return $result;
        }
    }

    // TODO: MIGRATE TO ANOTHER CONTROLLER
    // STRING FUNCTIONS
    public function regStr($string, $corpus = false)
    {
        $normal = $string;
        // REGULATES THE STRING
        if ($corpus)
        {
//            $normal = preg_replace("/[^a-zA-Z0-9\s]/", "", $normal);
//            $normal = preg_replace("/[\r\n]+/", ". ", $normal);
//            $normal = preg_replace("/([\uE000-\uF8FF]|\uD83C[\uDF00-\uDFFF]|\uD83D[\uDC00-\uDDFF])/g", '', $normal);
            // REGEX : LINK REMOVAL http://example.com
            $normal = preg_replace("/[a-zA-Z]*[:\/\/]*[A-Za-z0-9\-_]+\.+[A-Za-z0-9\.\/%&=\?\-_]+/i", "", $normal);
            // REGEX : TIME ( digit+ : digit+ )
            $normal = preg_replace("/\d+:\d+/", "", $normal);
        }
        // REGEX : EMOJIS
        $normal = preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $normal);
        return $normal;
    }
    public function remNL($string, $query = false)
    {
        // REGEX : NEWLINE & EMOJI
        $normal = preg_replace("/[\r\n]+/", "", $string);
        if ($query)
        {
            $normal = preg_replace("/[^a-zA-Z0-9\s]/", "", $normal);
        }
        $normal = $this->regStr($normal);
        return $normal;
    }
}