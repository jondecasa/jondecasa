<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(){
        return view('inicio');
    }
    public function politicaPrivacidad(){
        return view('legal.politicaPrivacidad');
    }
    public function politicaCookies(){
        return view('legal.politicaCookies');
    }
    
    public function indexLogued(){
        return view("layouts.logued");
    }
}
