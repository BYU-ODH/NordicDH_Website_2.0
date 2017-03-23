<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use App\LagerlofMain;
use App\LagerlofChunks;
use App\LagerlofImages;
use App\LagerlofWords;

class LagerlöfIndividualController extends Controller
{
    public function getIndividualTopic($topic_id)
    {
    	$topic_id = str_replace("-", "/", $topic_id);
    	$parameters = [];
    	$parameters['links'] = Link::all();
    	$parameters['main'] = LagerlofMain::where('global_id', $topic_id)->first();
    	$parameters['chunk_links'] = LagerlofChunks::where('global_id', $topic_id)->get();
    	$parameters['chunk_names'] = LagerlofChunks::where('global_id', $topic_id)->orderBy('rank', 'asc')->get();

		foreach($parameters['chunk_names'] as $chunk)
		{
            $chunk->name = str_replace("_", " ", $chunk->name);
            $chunk->name  = str_replace("./", "", $chunk->name);
            $chunk->name = str_replace(".txt", "", $chunk->name);
            $chunk->name = str_replace("LagerlofS", "", $chunk->name);
            $chunk->name = str_replace("of", " of ", $chunk->name);
            $chunk->name = preg_replace("/\d{4}/", "", $chunk->name);
            $chunk->name = preg_replace("/(?<!\ )[A-Z]/", " $0", $chunk->name);
            $chunk->name = str_replace("Gosta Berlings Saga", "Gösta Berlings Saga", $chunk->name);
            $chunk->name = str_replace("Osynliga Lankar", "Osynliga Länkar", $chunk->name);
            $chunk->name = str_replace("Korkarlen", "Körkarlen", $chunk->name);
            $chunk->name = str_replace("Troll Och Mann", "Troll Och Männ", $chunk->name);
            $chunk->name = str_replace("Marbacka", "Mårbacka", $chunk->name);
            $chunk->name = str_replace("Lowenskoldska R", "Löwensköldska", $chunk->name);
            $chunk->name = str_replace("Charlotte Lowenskold", "Charlotte Löwensköld", $chunk->name);
            $chunk->name = str_replace("Anna Svard", "Anna Svärd", $chunk->name);
            $chunk->name = str_replace("Fran Skilda Tider", "Från Skilda Tider", $chunk->name);
	    }

	    $parameters['words'] = LagerlofWords::where('global_id', $topic_id)->orderBy('rank', 'asc')->get();
	    $parameters['images'] = LagerlofImages::where('global_id', $topic_id)->first();
        $parameters['topic_id'] = $topic_id;

	    return view('lagerlöf_individual', $parameters);
    }
}
