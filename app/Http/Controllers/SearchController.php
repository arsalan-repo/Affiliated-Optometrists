<?php

namespace App\Http\Controllers;

use App\Doctors;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){
        return view('search.search');
    }

    public function search_doctors(Request $request){
        $input = $request->input();
        $input = $input['input'];
        $doctors = Doctors::where("name", "like", "{$input}%")->get();
        return response()->json(['success' => 1, 'data' => $doctors]);
    }
}
