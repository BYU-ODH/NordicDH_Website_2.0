<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Blog;
use App\Link;

class BlogController extends Controller
{
  public function getIndividualBlog($project_id)
  {
    $parameters = [];
    $parameters['project'] = Project::where("project_id", $project_id)->first();
    $parameters['entries'] = Blog::where("project_id", $project_id)->paginate(5);

    return view('blog', $parameters);
  }

  public function getIndividualBlogPost($project_id, $project_name, $blog_entry)
  {
    $parameters = [];
    $parameters['project'] = Project::where("project_id", $project_id)->first();
    $parameters['entries'] = Blog::where("project_id", $project_id)->get();
    $parameters['post'] = Blog::where([["blog_entry", $blog_entry], ["project_id", $project_id]])->first();
    $parameters['blog_entry'] = $blog_entry;

    return view('blog_individual', $parameters);
  }
}
