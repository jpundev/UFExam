<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TotalUni;
class UniversityController extends Controller
{
    function get(){
        phpinfo();
        $data = TotalUni::all();
        return view('university',compact('data'));
    }
}
