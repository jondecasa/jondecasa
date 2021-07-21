<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

use App\Models\Registros;

class BotController extends Controller
{
    public function index(){
        $registros = Auth::user()->registros;
        
        return view("bot.index", compact("registros"));
    }
}
