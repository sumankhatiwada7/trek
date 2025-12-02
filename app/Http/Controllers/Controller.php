<?php

namespace App\Http\Controllers;
use App\Models\trek;
use Illuminate\Http\Request;
abstract class Controller
{
     public function index(){
        $treks=trek::all();
        return view('treks.index',compact('treks'));
     }
     public function show($id){
        $treks=trek::findorfail($id);
        return view('treks.show',compact('treks'));
     }
}
