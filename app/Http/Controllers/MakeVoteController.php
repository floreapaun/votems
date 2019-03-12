<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Vote;

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
            'party_name' => 'required',
            'os' => 'required'
        ]);

        
        $vote = new Vote;
        $vote->user_id = Auth::id();
        $vote->candidate_id = request('candidate_id');
        $vote->party_name = request('party_name');
        $vote->county_name = request('county_name');
        $vote->vote_time = date("H:i:s");
        $vote->vote_date = date("Y-m-d");
        $vote->ip = $_SERVER['REMOTE_ADDR'];
        $vote->os = request('os');
        $vote->save();

        return redirect()->route('home');
    }    
}
