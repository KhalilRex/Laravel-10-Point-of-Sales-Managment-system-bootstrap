<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::paginate(5);
        return view('user.index',['user'=>$user]);
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
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phoneNumber = $request->input('phoneNumber');
        $user->is_admin = $request->input('is_admin');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        if($user){
            return redirect()->route('user.index')->with('success', 'User created successfully');
        }
        return redirect()->back()->with('error', 'Failed to create user'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
       
       if (!$user) {
        return redirect()->route('user.index')->with('error', 'User not found');
    }
       $user->update($request->all());
       return redirect()->route('user.index')->with('success', 'user updated successfully'); 
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User not found');
        }
           $user->delete($request->all());
           return redirect()->route('user.index')->with('success', 'user updated successfully'); 
  
    }
}
