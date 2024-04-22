<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Playtimesprice;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{

    public function create()
    {
        $customers = Customer::all(); // Fetch all customers
        $products = Product::all(); // Fetch all products


        return view('invoice.create', ['customers' => $customers, 'products' => $products]);
    }

    public function generate(Request $request, $played_time)
    {
        $products = Product::all();
        $played_time_formatted = $played_time . 'm';

    // Extract hours and minutes from the string
    $matches = [];
    preg_match('/(\d+)h (\d+)m/', $played_time_formatted, $matches);

    // Extract hours and minutes from the matches array
    $hours = isset($matches[1]) ? (int) $matches[1] : 0;
    $minutes = isset($matches[2]) ? (int) $matches[2] : 0;
        $amount=1000;
    // Log::info('Generate method called with played_time: ' . $played_time);
        return view('invoice.show',['products' => $products,'amount'=>$amount]);

    }

    public function getProductDetails(Request $request){
        
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        $products = Product::where('id', $productId)->first();


return response()->json(['quantity'=>$quantity, 'products'=>$products]);
    }
}
