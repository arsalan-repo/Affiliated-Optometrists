<?php

namespace App\Http\Controllers;

use App\Doctors;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function index(){
        return view('search.search');
    }

    public function get_all_doctors(){
        $doctors = Doctors::all();
        return response()->json(['success' => 1, 'data' => $doctors]);
    }

    public function profile($id){
        $doctor = Doctors::findorfail($id);
        return response()->json(['success' => 1, 'data' => $doctor]);
    }

}
