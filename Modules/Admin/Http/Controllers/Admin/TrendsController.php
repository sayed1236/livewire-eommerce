<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrendingHashtag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TrendsController extends Controller
{
    public function index()
    {
        $title_page = Auth::User()->user_lang=='ar' ? 'الهاشتاجات' : 'Trending Hashtags';
        $results=TrendingHashtag::where(['is_active'=>'Y'])->paginate(100);
        return view('admin.trending-hashtags.index',compact('title_page','results'))->extends('admin.layouts.app',['datatables'=>1]);
    }

    public function get_counts()
    {
        $get_trends=TrendingHashtag::where('is_active', 'Y')->get();
        if(count($get_trends))
        {
            foreach ($get_trends as $get_trend) {
                if($get_trend->since_id ==0)
                {
                    $since='';
                }
                else
                {
                    $since='&since_id='.$get_trend->since_id;
                }
                $response= Http::withToken('AAAAAAAAAAAAAAAAAAAAAMnWLQEAAAAAJNnWgXhlvWY1OWttYFeBUU3OGIs%3DzZh9Ikxmh3yzZzsMP5haFcUke5c7mOCZwlPiCwqO0xkqnIYKim')
                    ->get('https://api.twitter.com/1.1/search/tweets.json?q='.str_replace('#','',$get_trend->name).'&count=100'.$since);
                if ($response->status() == 200) {
                    echo $response->json()['search_metadata']['count'].'-id:'.$get_trend->id.'<hr/>';
                    $count_trends=count($response->json()['statuses']);
                    if($count_trends > 0)
                    {
                        $count_trends_m=$count_trends-1;
                        // update count trends
                        $trend_upd=TrendingHashtag::find($get_trend->id);
                        $trend_upd->tweet_volume+=$count_trends;
                        $trend_upd->since_id=$response->json()['statuses'][$count_trends_m]['id'];
                        $trend_upd->save();
                    }
                }
                sleep(1);
            }
            return true;
        }
    }
}
