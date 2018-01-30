<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function index()
    {
    	$path = public_path().'shell/update.sh';
    	exec($path);

    	return redirect('update')->withOk("Project Updated");
    }
}
