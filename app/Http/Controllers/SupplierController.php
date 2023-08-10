<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = supplier::paginate(5);
        return view('suppliers.index', compact('suppliers')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $suppliers = new supplier;
        $suppliers->Name = $request->input('Name');
        $suppliers->Address = $request->input('Address');
        $suppliers->PhoneNo = $request->input('PhoneNo');
        $suppliers->save();

        if($suppliers){
            return redirect()->route('suppliers.index')->with('success', 'User created successfully');
        }
        return redirect()->back()->with('error', 'Failed to create user'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(supplier $suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(supplier $suppliers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, supplier $suppliers)
    {
        $suppliers->update($request->all());
        return redirect()->route('suppliers.index')->with('success', '$suppliers updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, supplier $suppliers)
    {
        if (!$suppliers) {
            return redirect()->route('suppliers.index')->with('error', 'User not found');
        }
           $suppliers->delete($request->all());
           return redirect()->route('suppliers.index')->with('success', 'suppliers updated successfully');
    }
}
