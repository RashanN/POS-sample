<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $customerCount = Customer::count();

        
        return view('admin.dashboard', ['customerCount' => $customerCount]);

        
    }
}
