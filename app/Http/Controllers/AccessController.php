<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
   
    public function index()
    {
        return view('access.index');
    }
    public function auth(Request $request)
    {
       if(!Auth::attempt($request->only(['email', 'password']))){
            return redirect()->back()->withErrors('Invalid username or password');
       }
       return redirect()->route('list_series'); 
    }
}
