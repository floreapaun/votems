<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $names = DB::table('users')
            ->join('votes', 'users.user_id', '=', 'votes.user_id')
            ->select('users.first_name')->where('votes.candidate_id', '=', '1')
            ->get();
         */

        /*
        SELECT candidat.nume, candidat.prenume, candidat.nume_partid,
                          COUNT(candidat.nume) AS voturi FROM candidat
                          INNER JOIN voturi ON voturi.id_candidat=candidat.id_candidat
                          GROUP BY candidat.nume ORDER BY count(candidat.nume) DESC LIMIT 10 

        SELECT candidates.first_name, candidates.second_name, candidates.party,
                          COUNT(candidates.first_name) AS votes_cnt FROM candidates
                          INNER JOIN votes ON votes.candidate_id=candidates.candidate_id
                          GROUP BY candidates.first_name ORDER BY count(candidates.first_name)
        */
        
        //dd($names); 
        //

        $data = array();

        $fields = ['candidates.first_name', 'candidates.second_name', 'candidates.party'];
        $top_arr = DB::table('candidates')
                     ->join('votes', 'candidates.candidate_id', '=', 'votes.candidate_id')
                     ->select($fields);
        $top_arr = $top_arr->addSelect(DB::raw('count(candidates.first_name) as votes_cnt'))
                               ->groupBy('candidates.first_name')
                               ->orderBy('votes_cnt', 'DESC')
                               ->get();
        $data['top_arr'] = $top_arr;

        /*
         SELECT voturi.data_vot, voturi.timp_vot,
                          votant.nume, votant.prenume, candidat.nume, candidat.prenume
                          FROM voturi
                          INNER JOIN votant ON voturi.id_votant=votant.id_votant
                          INNER JOIN candidat ON voturi.id_candidat=candidat.id_candidat
                          ORDER BY voturi.id_votant DESC LIMIT 10
        */
        $fields = ['votes.vote_date', 'votes.vote_time', 
                    'users.first_name', 'users.second_name'];
        $last_arr = DB::table('votes')
                    ->join('users', 'votes.user_id', '=', 'users.user_id')
                    ->join('candidates', 'votes.candidate_id', '=', 'candidates.candidate_id')
                    ->select($fields);
        $last_arr = $last_arr->addSelect(DB::raw('candidates.first_name as cfirst_name'))
                    ->addSelect(DB::raw('candidates.second_name as csecond_name'))
                    ->orderBy('votes.user_id', 'desc')
                    ->get(); 
        $data['last_arr'] = $last_arr;
        //dd(compact("data"));

        return view('home', compact("data"));
    }
}
