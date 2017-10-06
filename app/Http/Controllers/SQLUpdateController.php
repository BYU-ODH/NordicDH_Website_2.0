<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LagerlofMain;
use App\Blog;
use Carbon\Carbon;

class SQLUpdateController extends Controller
{
	public function getLagerlöfUpdate(Request $request, $global_id)
	{
		$name = $request->name;
		$topic_id = str_replace("-", "/", $global_id);
  	LagerlofMain::where('global_id', $topic_id)->update(['topic_name' => $name]);

  	return redirect()->back();
	}

  public function getBlogPost(Request $request, $project_id, $project_name, $author)
  {
    $path = "";
    if(request()->file('uploaded_images') != null)
    {
      $path = request()->file('uploaded_images')->store('public');
    }
    $title = $request->title;
    $content = $request->content;
    $timestamp = Carbon::now()->toDateTimeString();
    Blog::insert(['project_id' => $project_id, 'project_name' => $project_name,
    'entry_content' => $content, 'authors' => $author, 'image_path' => $path,
    'entry_title' => $title, 'created' => $timestamp, 'last_updated' => $timestamp]);

    return redirect()->back();
  }

  public function getBlogUpdate(Request $request, $project_id, $project_name, $author, $blog_entry)
  {
    $path = "";
    $content = $request->content;
    $title = $request->title;
    if(request()->file('uploaded_images') != null)
    {
      $path = request()->file('uploaded_images')->store('public');
    }
    $timestamp = Carbon::now()->toDateTimeString();
    $updates=array('last_updated' => $timestamp,'entry_content' => $content, 'authors' => $author, 'image_path' => $path, 'entry_title' => $title);
    Blog::where('blog_entry', $blog_entry)->update($updates);

    return redirect()->back();
  }

  public function deleteBlogPost($project_id, $project_name, $blog_entry)
  {
    Blog::where('blog_entry', $blog_entry)->delete();

    return redirect()->back();
  }
}
