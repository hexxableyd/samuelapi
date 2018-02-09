<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebCrawlerController extends Controller
{
    public function parse($link)
    {
        if(isset($link))
        {
            $web = $this->checkLink($link);
            switch ($web['website']){
                case 'reddit':
                    $json = $this->getObjectReddit($web['link']);
                    if($json['success'])
                    {
                        $web['object'] = json_decode($json['object']);
                        $reddit_creator = $web['object'][0]->data->children;
                        $date = new \DateTime();
                        $date->setTimestamp($reddit_creator[0]->data->created);
                        $web['creator'] = array(
                            'theme' => 'skin-red',
                            'icon' =>'/img/ico/reddit.svg',
                            'title' => $this->regStr($reddit_creator[0]->data->title),
                            'content' => $this->regStr($reddit_creator[0]->data->selftext),
                            'author' => $this->regStr($reddit_creator[0]->data->author),
                            'author-link' => 'https://www.reddit.com/user/'.$reddit_creator[0]->data->author,
                            'permalink' => $reddit_creator[0]->data->permalink,
                            'upvote' => $reddit_creator[0]->data->ups,
                            'date' =>   $date->format('Y-m-d')
                        );
                        if(!empty($reddit_creator[0]->data->preview))
                        {
                            $web['creator']['img-url'] = $reddit_creator[0]->data->preview->images[0]->source->url;
                        }
                        $web['replies'] = $this->getRepliesReddit($web['object'][1]);
                    }
                    else
                    {
                        $web['success'] = FALSE;
                        $web['errors'] = $json['errors'];
                    }
                    break;
                case 'youtube':
                    $vidID = explode("?v=",$web['link']);
                    $json = $this->getObjectYoutube($vidID[1]);
                    if($json['success'])
                    {
                        $video_comments = json_decode($json['object-comments']);
                        $video_creator = json_decode($json['object-creator']);
                        $web['creator'] = array(
                            'theme' => 'skin-red',
                            'icon' => '/img/ico/youtube.png',
                            'title' => $this->regStr($video_creator->items[0]->snippet->title),
                            'content' => $this->regStr($video_creator->items[0]->snippet->description),
                            'author' => $this->regStr($video_creator->items[0]->snippet->channelTitle),
                            'author-link' => 'https://www.youtube.com/channel/'.$video_creator->items[0]->snippet->channelId,
                            'permalink' => $link,
                            'upvote' => "N/A",
                            'date' =>  date('Y-m-d', strtotime($video_creator->items[0]->snippet->publishedAt))
                        );
                        $web['replies'] = $this->getRepliesYoutube($video_comments);
                    }
                    else
                    {
                        $web['success'] = FALSE;
                        $web['errors'] = $json['errors'];
                    }
                    break;
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
        if((strpos(strtoupper(parse_url($result['link'], PHP_URL_HOST)),"REDDIT")!=FALSE)) {
            $result['success'] = TRUE;
            $result['message'] = "Your link is a Reddit Link!";
            $result['website'] = "reddit";
        }
        else if((strpos(strtoupper(parse_url($result['link'], PHP_URL_HOST)),"YOUTUBE")!=FALSE)) {
            $result['success'] = TRUE;
            $result['message'] = "Your link is a YouTube Link!";
            $result['website'] = "youtube";
        }
        else{
            $result['success'] = FALSE;
            $result['errors'] = 'It seems like '.parse_url($result['link'], PHP_URL_HOST)." is not supported yet! :(";
            $result['website'] = NULL;
        }

        return $result;
    }

    // REDDIT FUNCTIONS
    public function getObjectReddit($link)
    {
        // TODO: LOG ERRORS, ON DB, THROWN ALONG WITH THE LINK THAT CAUSED THE ERROR
        $result = array();
        try{
            $result['success'] = TRUE;
            $result['object'] = file_get_contents($link.".json");
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
    public function getRepliesReddit($object)
    {
        $reddit_replies = $object->data->children;
        $replies = array();
        foreach($reddit_replies as $rep)
        {
            if ($rep->kind === 't1' && $rep->data->body !== "[deleted]")
            {
                $date = new \DateTime();
                $date->setTimestamp($rep->data->created);
                array_push($replies, array(
                    'content' => $this->regStr($rep->data->body),
                    'author' => $this->regStr($rep->data->author),
                    'date' => $date->format('Y-m-d')
                ));
                if($rep->data->replies != NULL && $rep->data->replies !== "")
                {
                    $reps = $this->getRepliesReddit($rep->data->replies);
                    $replies = array_merge($replies, $reps);
                }
            }
        }
        return $replies;
    }

    // YOUTUBE FUNCTIONS
    public function getObjectYoutube($videoid)
    {
        // TODO: LOG ERRORS, ON DB, THROWN ALONG WITH THE LINK THAT CAUSED THE ERROR
        $apikey = "AIzaSyBFactY2wGBHiSQBh4pjw1Im2uuXx3Qoaw";
        $result = array();
        try{
            $result['success'] = TRUE;
            $result['object-comments'] = file_get_contents("https://www.googleapis.com/youtube/v3/commentThreads?part=snippet&videoId=".$videoid."&key=".$apikey);
            $result['object-creator'] = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" . $videoid . "&key=" . $apikey);
        }
        catch (\RuntimeException $e){
            $result['success'] = FALSE;
            $result['errors'] = "Don't worry, it just seems like there's some error.\nERROR CODE: Runtime Error";
        }
        catch (\Exception $e){
            $result['success'] = FALSE;
            $result['errors'] = "Don't worry, it just seems like there's some error.\nERROR CODE: Exception Error";
//            $result['errors'] = "https://www.googleapis.com/youtube/v3/commentThreads?part=snippet&videoId=".$videoid."key=".$apikey;
        }
        finally{
            return $result;
        }
    }
    public function getRepliesYoutube($object)
    {
        $reddit_replies = $object->items;
        $replies = array();
        foreach($reddit_replies as $rep)
        {
            $reply = $rep->snippet->topLevelComment->snippet;
            array_push($replies, array(
                'content' => $this->regStr($reply->textOriginal),
                'author' => $this->regStr($reply->authorDisplayName),
                'date' => date('Y-m-d', strtotime($reply->updatedAt))
            ));
        }
        return $replies;
    }


    public function regStr($string)
    {
        // REGULATES THE STRING
//        $normal = preg_replace("/[^a-zA-Z0-9\s]/", "", $string);
//        $normal = preg_replace("/[\r\n]+/", ". ", $string);
//        $string = nl2br($string);
//        $normal = preg_replace("/([\uE000-\uF8FF]|\uD83C[\uDF00-\uDFFF]|\uD83D[\uDC00-\uDDFF])/g", '', $string);

        // REMOVES STRING WITH EMOJIS
        $normal = preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $string);
        return $normal;
    }
    public function remNL($string, $query = false)
    {
        // NORMALIZES STRING. REMOVES NEW LINE AND TABS AS WELL AS REMOVES EMOJIS
        $normal = preg_replace("/[\r\n]+/", "", $string);
        if ($query)
        {
            $normal = preg_replace("/[^a-zA-Z0-9\s]/", "", $normal);
        }
        $normal = $this->regStr($normal);
        return $normal;
    }
}
