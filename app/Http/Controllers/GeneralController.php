<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;

class GeneralController extends Controller
{
	public function getComingSoonPage()
	{
  	return view('coming_soon');
  }

  public function getSoftwareDownloadPage()
  {
    return view('software_download');
  }
}
