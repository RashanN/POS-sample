<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChildController extends Controller
{
    //
    public function create()
    {
        return view('child.create');
    }
}
