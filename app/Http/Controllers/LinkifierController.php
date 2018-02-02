<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkifierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'title' => 'Samuel API',
            'description' => 'Understanding statements are hard, SAMUEL makes it easy',
            'services' => ['placeholder','placeholder','placeholder','placeholder','placeholder','placeholder',],
        );
        return view('pages.linkifier')->with($data);
    }

    //create
    //store
    //edit
    //update
    //destroy
    //show
    //
    //ganito magsave sa shit
    //$post = new App\Post();
    //$post->body = "dsadasda"
    //$post->save();

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function linkifyRes(Request $request)
    {
        if ($request->isMethod('post')){
            $init_data = $request->input('url-data');
            $json_object = json_decode($init_data, true);
            $data = array(
                'title' => 'Samuel API',
                'description' => 'Understanding statements are hard, SAMUEL makes it easy',
                'type' => $json_object['type']
            );
            $corpus = "";
            if($data['type'] === 'reddit')
            {
                foreach($json_object['replies'] as $reps)
                {
                    $corpus .= " " . $reps['content'];
                }

                $reddit_data = array(
                    'creator' => $json_object['author'],
                    'replies' => $json_object['replies'],
                    'corpus' => $this->remNL($corpus),
                );

                $data = array_merge($data, $reddit_data);
                return view('pages.linkifier_result')->with($data);
            }
        }
        return redirect('/linkifier');
    }
    public function linkify(Request $request)
    {
        $response = array();
        if ($request->isMethod('post')){
            $data = array(
              'link' => $request->input('linkify-url'),
                'agree' => $request->input('terms-conditions'),
            );
            if($data['agree'])
            {
                if($data['link']!='')
                {
//                    if((strpos(strtoupper($data['link']),"FACEBOOK")!=FALSE))
//                    {
//                        $response['success'] = TRUE;
//                        $response['message'] = "Your link is a Facebook Link!";
//                    }
                    if((strpos(strtoupper($data['link']),"REDDIT")!=FALSE))
                    {
                        $response['success'] = TRUE;
                        $response['message'] = "Your link is a Reddit Link!";
                        $response['website'] = "reddit";
                        $json = file_get_contents($data['link'].".json");
                        $object = json_decode($json);
                        $response['object'] = $object;
                        $reddit_creator = $object[0]->data->children;
                        $date = new \DateTime();
                        $date->setTimestamp($reddit_creator[0]->data->created);
                        $response['creator'] = array(
                            'theme' => 'skin-red',
                            'title' => $this->regStr($reddit_creator[0]->data->title),
                            'content' => $this->regStr($reddit_creator[0]->data->selftext),
                            'author' => $this->regStr($reddit_creator[0]->data->author),
                            'author-link' => 'https://www.reddit.com/user/'.$reddit_creator[0]->data->author,
                            'permalink' => $reddit_creator[0]->data->permalink,
                            'upvote' => $reddit_creator[0]->data->ups,
                            'date' =>   $date->format('Y-m-d')
                        );
                        $response['replies'] = $this->replies($object[1]);
                    }
                    else
                    {
                        $response['success'] = FALSE;
                        $response['errors'] = 'It seems like '.$data['link']." is not supported yet! :(";
                    }
                }
                else
                {
                    $response['success'] = FALSE;
                    $response['errors'] = "Please input the URL!";
                }
            }
            else
            {
                $response['success'] = FALSE;
                $response['errors'] = "Please agree to our Terms and Conditions before proceeding.";
            }
            return response()->json($response);
        }
        return redirect('/linkifier');
    }
    public function replies($object)
    {
        $reddit_replies = $object->data->children;
        $replies = array();
        foreach($reddit_replies as $rep)
        {
            if ($rep->kind === 't1')
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
                    $reps = $this->replies($rep->data->replies);
                    $replies = array_merge($replies, $reps);
                }
            }
        }
        return $replies;
    }
    public function regStr($string)
    {
//        $normal = preg_replace("/[^a-zA-Z0-9\s]/", "", $string);
//        $normal = preg_replace("/[\r\n]+/", ". ", $string);
//        $string = nl2br($string);
//        $normal = preg_replace("/([\uE000-\uF8FF]|\uD83C[\uDF00-\uDFFF]|\uD83D[\uDC00-\uDDFF])/g", '', $string);
        $normal = preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $string);
        return $normal;
    }
    public function remNL($string, $query = false)
    {
        $normal = preg_replace("/[\r\n]+/", "", $string);
        if ($query)
        {
            $normal = preg_replace("/[^a-zA-Z0-9\s]/", "", $normal);
        }
        $normal = preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $normal);
//        $normal = preg_replace("/([\uE000-\uF8FF]|\uD83C[\uDF00-\uDFFF]|\uD83D[\uDC00-\uDDFF])/", '', $normal);
//        $string = nl2br($string);
        return $normal;
    }
}
