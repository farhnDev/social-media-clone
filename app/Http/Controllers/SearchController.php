<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Lakukan logika pencarian disini
        $results = User::where('name', 'like', '%' . $query . '%')->get();

        return view('search.index', compact('results'));
    }
}
