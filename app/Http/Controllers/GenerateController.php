<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $partyname_arr = array(); 
        $partyname_arr = DB::table('parties')->select('party_name')->get();
    
        //dd($partyname_arr);
        return view('generate', ['partyname_arr' => $partyname_arr]); 
    }

}
