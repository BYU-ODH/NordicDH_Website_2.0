<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LagerlofMain;

class SQLUpdateController extends Controller
{
	public function getLagerlöfUpdate(Request $request, $global_id)
	{
		$name = $request->name;
		$topic_id = str_replace("-", "/", $global_id);
    	LagerlofMain::where('global_id', $topic_id)->update(['topic_name' => $name]);

    	return redirect()->back();
	}
}
