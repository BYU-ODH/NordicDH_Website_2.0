<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Link;

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
    	$view = $parameters['project']->view;
    	return view($view, $parameters);
    }
}
