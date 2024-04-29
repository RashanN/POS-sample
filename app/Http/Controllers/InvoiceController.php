<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Intime;
use App\Models\Outtime;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Playtimes;
use Illuminate\Http\Request;
use App\Models\Playtimesprice;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{

    public function create()
    {
        $customers = Customer::all(); // Fetch all customers
        $products = Product::all(); // Fetch all products
        $priceranges = Playtimesprice::all();

        return view('invoice.create', compact('customers', 'products', 'priceranges'));
    }

    public function generate(Request $request)
    {
        // $playedTime = $request->route('playedTime');
        // $customerId = $request->route('customerId');
        // $inTime = $request->route('inTime');

        // list($hours, $minutes) = explode(':', $inTime);
        // $inTimes = Carbon::createFromTime($hours, $minutes);
        // $time = $inTimes->format('H:i');



        $products = Product::all();
        // $played_time_formatted = $playedTime . 'm';

        $playtimesprice= Playtimesprice::all();

        $defaultPrice = Playtimesprice::where('name', 'default')->value('price');
        $a=Playtimesprice::where('name', 'A')->value('price');
        $b=Playtimesprice::where('name', 'B')->value('price');
        $c=Playtimesprice::where('name', 'C')->value('price');
        $d=Playtimesprice::where('name', 'D')->value('price');
    // Extract hours and minutes from the string
    $matches = [];
    //preg_match('/(\d+)h (\d+)m/', $played_time_formatted, $matches);

    // Extract hours and minutes from the matches array
    $hours = isset($matches[1]) ? (int) $matches[1] : 0;
    $minutes = isset($matches[2]) ? (int) $matches[2] : 0;


    $prices = [
        ['start' => 0, 'end' => 60, 'price' => 0],  // First hour, free
        ['start' => 60, 'end' => 300, 'price' => $a], // 5-15 minutes
        ['start' => 300, 'end' => 900, 'price' => $b], // 15-30 minutes
        ['start' => 900, 'end' => 1800, 'price' => $c], // 30-45 minutes
        ['start' => 1800, 'end' => 3600, 'price' => $d], // 45-60 minutes
    ];

    // Initialize total price
    $totalPrice = 0;

    $additionalHours = max(0, $hours - 2);
    $totalPrice += $defaultPrice;


    if($minutes<5){
        $totalPrice=$totalPrice;
    }elseif($minutes>5 && $minutes<15){
        $totalPrice+=($minutes*15);
    }

        return view('invoice.show',['products' => $products,'amount'=>$totalPrice]);

    }

    public function getProductDetails(Request $request){

        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        $products = Product::where('id', $productId)->first();


return response()->json(['quantity'=>$quantity, 'products'=>$products]);
    }

    public function getTime(Request $request){

        $rfid = $request->input('rfid');
        $ChildID = $request->input('ChildID');

        $children = Child::where('id', $ChildID)->first();
        
        return response()->json(['rfid'=>$rfid, 'children'=>$children]);
    }
}
