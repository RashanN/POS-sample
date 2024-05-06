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
    public function index1()
    {
        $customerCount = Customer::count();

        
        return view('admin.dashboard1', ['customerCount' => $customerCount]);

        
    }
    public function paneldata(){

        $customerCount = Customer::count();

        
        return view('dashboard', ['customerCount' => $customerCount]);
    }
}
