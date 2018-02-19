<?php

namespace App\Http\Controllers;

use Twitter;
use Illuminate\Http\Request;
use Faker\Provider\File;

class TwitterController extends Controller
{
    public function twitterUserTimeLine()
    {
        // TODO : APPLY TO HAVE A USER TIMELINE THERE
        $data = Twitter::getUserTimeline([
            'count' => 100,
            'format' => 'array',
            'screen_name' => 'CLR_n_Hues',
        ]);
        return view('twitter',compact('data'));
    }

    public function tweet(Request $request)
    {
        $this->validate($request, [
            'tweet' => 'required'
        ]);

        $newTwitte = ['status' => $request->tweet];

        if(!empty($request->images)){
            foreach ($request->images as $key => $value) {
                $uploaded_media = Twitter::uploadMedia(['media' => File::get($value->getRealPath())]);
                if(!empty($uploaded_media)){
                    $newTwitte['media_ids'][$uploaded_media->media_id_string] = $uploaded_media->media_id_string;
                }
            }
        }


        $twitter = Twitter::postTweet($newTwitte);


        return back();
    }
}
