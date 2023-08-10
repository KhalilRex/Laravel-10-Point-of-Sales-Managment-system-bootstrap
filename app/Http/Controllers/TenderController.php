<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tender = Tender::paginate(5);
        return view('admin.tender.index', compact('tender')); 
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date', // Add the 'date' validation rule here
        ]);
    
        // If the validation passes, create the Tender record
        Tender::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
        ]);
    
        return redirect()->route('admin.tenders.index')->with('success', 'Tender added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tender $tender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tender $tender, Request $request )
    {
        $tender->update($request->all());
        return redirect()->route('tender.index')->with('success', 'tender updated successfully'); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tender $tender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tender $tender, Request $request)
    {
        if (!$tender) {
            return redirect()->route('tender.index')->with('error', 'User not found');
        }
           $tender->delete($request->all());
           return redirect()->route('tender.index')->with('success', 'tender updated successfully');
    }
}
