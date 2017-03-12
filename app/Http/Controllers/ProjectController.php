<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Link;
use App\LagerlofMain;
use App\LagerlofChunks;
use App\LagerlofImages;
use App\LagerlofWords;

class ProjectController extends Controller
{
    public function getAllProjects()
    {
    	//
    }

    public function getIndividualProject($project_id)
    {
        $parameters = [];
        $parameters['links'] = Link::all();
    	$parameters['project'] = Project::where("project_id", $project_id)->first();

        switch ($project_id) 
        {
            case 1:
                $parameters = self::getLagerlofProject($parameters);
                break;
            default:
                // Error
        }

    	$view = $parameters['project']->view;
    	return view($view, $parameters);
    }

    private function getLagerlofProject($parameters)
    {
        $main = new LagerlofMain;

        if(request()->has('chunk_size'))
        {
            $main = $main->where('chunk_size', 'like', request('chunk_size') . '%');
        }

        else
        {
            $main = $main->where('chunk_size', 'like', '1000%');
        }

        if(request()->has('topic_number'))
        {
            $main = $main->where('topic_number', request('topic_number'));
        }

        else
        {
            $main = $main->where('topic_number', '25');
        }

        if(request()->has('part_of_speech'))
        {
             $main = $main->where('chunk_size', 'like', '%' . request('part_of_speech'));
        }

        else
        {
            $main = $main->where('chunk_size', 'like', '%N');
        }

        $parameters['main'] = $main->paginate(6)->appends([
            'chunk_size' => request('chunk_size'),
            'topic_number' => request('topic_number'),
            'part_of_speech' => request('part_of_speech')]);
        $parameters['chunks'] = LagerlofChunks::all();
        $parameters['images'] = LagerlofImages::all();
        $parameters['words'] = LagerlofWords::all();

        return $parameters;
    }
}
