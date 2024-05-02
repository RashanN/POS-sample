<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Playtimesprice;
use Illuminate\Support\Facades\DB;

class ChildController extends Controller
{
    //
    public function create()
    {
        $customers = Customer::all();
       
    return view('child.create', compact('customers'));
    }
    public function store(Request $request)
    {
       // dd($request);
        $validatedData = $request->validate([
            'parent_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'school' => 'nullable|string|max:255',
            'relationship' => 'nullable|string|max:255',
        ]);
    
     //   dd($validatedData);
        $child = new Child();
        $child->customer_id = $validatedData['parent_id'];
        $child->name = $validatedData['name'];
        $child->DOB = $validatedData['dob'];
        $child->gender = $validatedData['gender'];
        $child->relationship = $validatedData['relationship'];
        $child->school = $validatedData['school'];

       
      //  dd($child); 
        $child->save();

        return redirect()->route('child.index')->with('success', 'Child saved successfully.');
    }
    public function index()
    {
          $children = Child::with('customer')->get();


        return view('child.index', compact('children'));
    }
    public function show()
    {

        $children = Child::all();
        //dd($children);

        return view('child.index', compact('children'));
    }
    public function edit($id)
    {
    $child = Child::with('customer')->findOrFail($id);
    $customers = Customer::all();
    return view('child.edit', compact('child', 'customers'));
    }

    public function update(Request $request, $id)
    {

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'dob' => 'required|date',
        'school' => 'nullable|string|max:255',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'customer_id' => 'required|exists:customers,id',
    ]);

    $child = Child::findOrFail($id);
    $child->name = $validatedData['name'];
    $child->dob = $validatedData['dob'];
    $child->school = $validatedData['school'];
    $child->customer_id = $validatedData['customer_id'];

    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $destinationPath = 'image/';
        $profileImage = date('YmHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $child->profile_image = $profileImage;
    }
    
    $child->save();

    return redirect()->back()->with('success', 'Child updated successfully.');
}
public function destroy($id)
{
    $child = Child::findOrFail($id);
    $child->delete();

    return redirect()->back()->with('success', 'Child deleted successfully.');
}
public function fetchChildren(Request $request) {
    $customerId = $request->input('customerId');

    // Fetch children associated with the selected customer
    $children = Child::where('customer_id', $customerId)->get();
   
    return response()->json($children);
}
}
