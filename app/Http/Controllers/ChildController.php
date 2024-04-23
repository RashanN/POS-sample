<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Customer;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    //
    public function create()
    {
        $customers= Customer::all();
        return view('child.create', compact('customers'));
    }
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'parent_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|' // Make the image field nullable
        ]);

        // Store the form data
        $child = new Child();
        $child->customer_id = $validatedData['parent_id'];
        $child->name = $validatedData['name'];
        $child->dob = $validatedData['dob'];

        // Handle profile image upload

        if($image = $request->file('profile_image')){
            $destinationPath = 'image/';
            $profileImage = date('YmHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $child->profile_image= $profileImage;
        }
        //dd($child);
        $child->save();

        return redirect()->back()->with('success', 'Child saved successfully.');
    }
    public function index()
    {
          $children = Child::with('customer')->get();
            dd($children);
        // Pass the children data to the index view
        return view('child.index', compact('children'));
    }
    public function show()
    {
        // Retrieve all children
        $children = Child::all();
        //dd($children);
        // Pass children data to the view
        return view('child.index', compact('children'));
    }
}
