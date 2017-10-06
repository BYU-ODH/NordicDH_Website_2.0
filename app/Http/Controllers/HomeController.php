<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Blog;
use App\Link;
use DB;

class HomeController extends Controller
{
  public function getPage()
  {
  	$parameters = [];
  	$parameters['projects'] = Project::all();
    $parameters['blogs'] = Blog::all();

  	return view('home', $parameters);
  }
}
