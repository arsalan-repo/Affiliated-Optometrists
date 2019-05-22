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
        var_dump($doctors);die;
    }
}
