<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use App\LagerlofMain;
use App\LagerlofChunks;
use App\LagerlofImages;
use App\LagerlofWords;

class LagerlöfWordController extends Controller
{
    public function getWordWithTopic($word, $topic_id)
    {
    	$topic_id = str_replace("-", "/", $topic_id);
    	$parameters = [];
    	$parameters['word'] = $word;
    	$parameters['topic_id'] = $topic_id;
    	$parameters['links'] = Link::all();
    	$parameters['main'] = LagerlofMain::where('global_id', $topic_id)->first();

    	//$topics = LagerlofWords::where('word', $word)->get();
    	$topics = LagerlofWords::where([['global_id', 'like', substr($topic_id, 0, 8) . '%' . substr($topic_id, -2)], ['word', $word]])->get();

    	foreach ($topics as $key => $value) 
    	{
    		if(substr($topic_id, 6, 2) != substr($value->global_id, 6, 2))
    		{
    			$topics->forget($key);
    		}
    	}

    	$parameters['topics'] = $topics;
    	/*$parameters['words'][0] = LagerlofWords::where('global_id', $topic_id)->orderBy('rank', 'asc')->get();

    	$i = 1;
    	foreach($topics as $topic)
    	{
    		$parameters['words'][$i] = LagerlofWords::where('global_id', $topic->global_id)->orderBy('rank', 'asc')->get();
    		$i++;
    	}*/

    	$i = 0;
    	foreach($topics as $topic)
    	{
    		$parameters['words'][$i] = LagerlofWords::where('global_id', $topic->global_id)->orderBy('rank', 'asc')->get();
    		$i++;
    	}

    	return view('lagerlöf_word', $parameters);
    }

    public function getWordWithoutTopic($word)
    {
    	return view('home');
    }
}
