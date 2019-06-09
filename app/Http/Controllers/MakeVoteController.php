<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DB;
use App\Vote;
use App\County;

class MakeVoteController extends Controller
{
    /*
     * Ensure the user is signed in to access this page
     */

    public function __construct() {

        $this->middleware('auth');

    }
    
    public function store(Request $request)
    {

        //dd($request);
        
        $this->validate($request, [
            'candidate_id' => 'required',
            'county_name' => 'required',
            'os' => 'required'
        ]);


        //changes and county_name actually stores county_id 
        $county_id = intval(request('county_name'));
        //dd($county_id);
        $county_name = DB::table('counties')->select('county_name')
                        ->where('county_id', '=', $county_id)
                        ->get();
        //dd($county_name[0]->county_name);

        $vote = new Vote;
        $vote->user_id = Auth::id();
        $vote->candidate_id = request('candidate_id');
        
        $vote->county_name = $county_name[0]->county_name; 
        $vote->vote_time = date("H:i:s");
        $vote->vote_date = date("Y-m-d");
        $vote->ip = $_SERVER['REMOTE_ADDR'];
        $vote->os = request('os');
        $vote->save();

        return redirect()->route('home');
    }    
}
