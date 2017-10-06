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
  public function getWordComparison($chunk_size, $part_of_speech, $topic_number, $word)
  {
  	$topic_id = "L_" . $chunk_size . $part_of_speech . "_1/" . $topic_number;
  	$parameters = [];
  	$parameters['word'] = $word;
  	$parameters['chunk_size'] = $chunk_size;
    $parameters['part_of_speech'] = $part_of_speech;
    $parameters['topic_number'] = $topic_number;
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
