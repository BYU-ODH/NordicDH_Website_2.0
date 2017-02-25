<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use DB;

class HomeController extends Controller
{
    public function getPage(){
    	
    	$parameters = [];
    	$parameters['projects'] = Project::all();
    	

    	return view('home', $parameters);
    }
}
