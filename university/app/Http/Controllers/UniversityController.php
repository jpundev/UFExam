<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TotalUni;
class UniversityController extends Controller
{
    function get(){
        //paginate the table
        $data = TotalUni::paginate(25);
        return view('university',compact('data'));
    }
}
