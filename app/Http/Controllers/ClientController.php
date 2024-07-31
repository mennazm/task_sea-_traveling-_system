<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Client::create([
            'name' => $validated['name'],
        ]);

        return redirect()->route('contracts.create')->with('success', 'Client added successfully.');
    }
}
