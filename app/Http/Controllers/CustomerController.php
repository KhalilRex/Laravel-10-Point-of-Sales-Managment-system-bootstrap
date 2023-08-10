<?php

Namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::paginate(5);
        return view('customers.index', compact('customers')); 
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
        $customers = new Customer;
        $customers->Name = $request->input('Name');
        $customers->Address = $request->input('Address');
        $customers->PhoneNo = $request->input('PhoneNo');
        $customers->save();

        if($customers){
            return redirect()->route('customers.index')->with('success', 'User created successfully');
        }
        return redirect()->back()->with('error', 'Failed to create user'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customers)
    {
        $customers->update($request->all());
        return redirect()->route('customers.index')->with('success', 'customers updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customers)
    {
        if (!$customers) {
            return redirect()->route('customers.index')->with('error', 'User not found');
        }
           $customers->delete($request->all());
           return redirect()->route('customers.index')->with('success', 'customers updated successfully');
    }
    
}
