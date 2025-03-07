<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function registration(){
        return view('simple-form');
    }

    public function register(Request $request){

        $validated = $request->validate([
            'FirstName' => 'required|max:50',
            'LastName' => 'required|max:50',
            'MobilePhone' => 'required|regex:/^09\d{2}-\d{3}-\d{3}$/',
            'TelNo' => 'numeric',
            'Birthdate' => 'required|date_format:Y-m-d',
            'Address' => 'max:100',
            'Email' => 'email',
            'Website' => 'url'
        ]);

        return back()->with('success', 'Form Submitted Successfully');
    }
}
