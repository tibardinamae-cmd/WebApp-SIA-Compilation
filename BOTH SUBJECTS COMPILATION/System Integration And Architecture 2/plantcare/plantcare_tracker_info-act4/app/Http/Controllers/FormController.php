<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        // ✅ VALIDATION
        $request->validate([
            'plant_name' => 'required|min:3',
            'owner_email' => 'required|email',
            'plant_age' => 'required|numeric|min:1',
            'sunlight' => 'required',
            'notes' => 'required|min:5'
        ]);

        // ✅ SUCCESS (NO DATABASE NEEDED)
        return back()->with('success', '🌱 Plant record submitted successfully!');
    }
}