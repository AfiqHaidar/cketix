<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.welcomepage');
    }
    
    public function guest(){
        return view('admin.guest');
    }
    
    public function concert(){
        return view('admin.concert');
    }
}
