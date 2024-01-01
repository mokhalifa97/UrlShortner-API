<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function createShortUrl(Request $request){
        $request->validate([
            'url'=> 'required|url',
        ]);

        $originalUrl= $request->input('url');
        $shortUrl = Url::create([
            'original_url' => $originalUrl,
        ]);

        return response()->json([
            "msg"=> "return all data from DB",
            "status"=> 200,
            "data"=> [
                'original_url' => $originalUrl,
                'short_url' => $shortUrl->id,
            ]
        ]);
    }

    public function redirectUrl($short){
        $url = Url::find($short);

        if(!$url){
            return response()->json([
                'error' => 'Invalid short URL'
            ]);
        }

        return redirect($url->original_url);
    }
}
