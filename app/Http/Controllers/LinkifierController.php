<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\WebCrawlerController as Crawl;


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
                'title' => 'Linkifier',
                'description' => 'Understanding statements are hard, SAMUEL makes it easy',
                'type' => $json_object['type']
            );
            $corpus = "";
//            $corpus = array();

            if($data['type'] === 'reddit' || $data['type'] === 'youtube' || $data['type'] === 'forum.philboxing' || $data['type'] === 'forum.generic' || $data['type'] === 'twitter')
            {
                $crawl = new Crawl();
                foreach($json_object['replies'] as $reps)
                {
                    $corpus .= " " . $crawl->regStr($reps['content'], true);
//                    array_push($corpus, $crawl->remNL($reps['content']));
                }

                $sum_data = array(
                    'creator' => $json_object['author'],
                    'replies' => $json_object['replies'],
                    'corpus' => $crawl->remNL($corpus),
                    'website' => $json_object['type'],
                    'url_link' => $json_object['link'],
//                    'corpus' => $corpus,
                );

                $data = array_merge($data, $sum_data);
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
                'numberpost' => $request->input('numberpost')
            );
            if($data['agree'])
            {
                if($data['link']!='')
                {
                    $crawl = new Crawl();
                    $response = $crawl->parse($data['link'], $data['numberpost']);
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
}
