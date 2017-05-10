<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;

class ComingSoonController extends Controller
{
	public function getPage()
	{
    	return view('coming_soon');
    }
}
