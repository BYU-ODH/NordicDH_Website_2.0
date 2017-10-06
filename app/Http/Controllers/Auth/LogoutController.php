<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Project;
use DB;

class LogoutController extends Controller
{
  public function logout()
  {
    Auth::logout();
    Session::flush();

    return redirect()->back();
  }
}
