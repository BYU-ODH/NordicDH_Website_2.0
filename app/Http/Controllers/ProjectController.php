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
            case 2:
                break;
            case 3:
                break;
            default:
                // Error
        }

    	$view = $parameters['project']->view;
    	return view($view, $parameters);
    }

    private function getLagerlofProject($parameters)
    {
        $parameters['main'] = LagerlofMain::all();
        $parameters['chunks'] = LagerlofChunks::all();
        $parameters['images'] = LagerlofImages::all();
        $parameters['words'] = LagerlofWords::all();

        return $parameters;
    }
}
