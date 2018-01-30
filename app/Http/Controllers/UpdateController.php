<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateController extends Controller
{
	function index(){
	$path = public_path().'/shell/update.sh';
    	echo $path;
	exec($path, $output);
	var_dump($output);
	//return redirect("home");
	}
}
