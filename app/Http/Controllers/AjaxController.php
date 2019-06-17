<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Candidate;
use App\County;

class AjaxController extends Controller
{
    public function get_avg_age(){

      $pname = $_POST["party"];

      /*
      $query = "SELECT AVG(votant.varsta) FROM voturi INNER JOIN votant 
      ON voturi.id_votant=votant.id_votant WHERE voturi.nume_partid=?
      GROUP BY voturi.nume_partid";
      */

      /*
      SELECT AVG(users.age) FROM votes
      INNER JOIN users ON votes.user_id = users.user_id
      INNER JOIN candidates ON votes.candidate_id = candidates.candidate_id
      WHERE candidates.party = "Partidul Social Democrat"
      */

      $value = DB::table('votes')
          ->join('users', 'votes.user_id', '=', 'users.user_id')
          ->join('candidates', 'votes.candidate_id', '=', 'candidates.candidate_id')
          ->where('candidates.party', '=', $pname)
          ->avg('users.age');
      
      return response()->json(compact("value"), 200);

   }

    public function get_cnt_poor() {

        $data_arr = array();

        /*SELECT candidates.party, COUNT(votes.user_id) AS cnt FROM `votes` 
         INNER JOIN counties ON votes.county_name = counties.county_name 
         INNER JOIN candidates ON votes.candidate_id = candidates.candidate_id 
         WHERE counties.corruption_level = ( SELECT MAX(counties.corruption_level) FROM counties)
         */
        
       DB::enableQueryLog();

       $value = DB::table('counties')
           ->select('county_name')->orderBy('gdp', 'asc')->first();
        
       $data_arr[0] = $value->county_name;

       $data_arr[1] = DB::table('votes')
           ->select('user_id')->where('county_name', '=', $value->county_name)
           ->count();

       //dd(DB::getQueryLog());
       //dd($value);
       return response()->json($data_arr, 200);
   }

    public function get_win_corrupt() {

        /*
        SELECT candidates.party_name, COUNT(votes.user_id) AS cnt FROM `votes`
        INNER JOIN counties
        ON votes.county_name = counties.county_name
        WHERE counties.corruption_level =
        ( SELECT MAX(counties.corruption_level) FROM  counties);
         */
        

       $data_arr = array();

       $value = DB::table('counties')
           ->select('county_name')->orderBy('corruption_level', 'desc')->first();
        
       $data_arr[0] = $value->county_name;

       $top_arr = DB::table('votes')
                     ->join('candidates', 'candidates.candidate_id', '=', 'votes.candidate_id')
                     ->join('counties', 'votes.county_name', '=', 'counties.county_name')
                     ->where('counties.county_name', '=', $value->county_name)
                     ->select('candidates.party');
       $top_arr = $top_arr->addSelect(DB::raw('count(candidates.first_name) as votes_cnt'))
                               ->groupBy('candidates.first_name')
                               ->orderBy('votes_cnt', 'DESC')
                               ->get();
       $data_arr[1] = $top_arr[0]->party;

       //dd($value);
       return response()->json($data_arr, 200);
   }


   public function getparty() {
       $candid_id = $_POST['candid_id'];
       $party = DB::table('candidates')
                 ->where('candidate_id', '=', $candid_id)
                 ->select('party')
                 ->get();
       //dd($party);
       return response()->json($party, 200);
   }
   
   public function getcandid() {
       $party_name = $_POST['party'];
       $candid_id = DB::table('candidates')
                 ->where('party', '=', $party_name)
                 ->select('candidate_id')
                 ->get();

       return response()->json($candid_id, 200);
   }

   public function get_image_data_TopReg() {
       $region = $_POST['region'];
       /*
        $fields = ['candidates.first_name', 'candidates.second_name', 'candidates.party'];
        $top_arr = DB::table('votes')
                     ->join('candidates', 'candidates.candidate_id', '=', 'votes.candidate_id')
                     ->join('counties', 'votes.county_name', '=', 'counties.county_name')
                     ->where('counties.region', '=', $region)
                     ->select($fields);
        $top_arr = $top_arr->addSelect(DB::raw('count(candidates.first_name) as votes_cnt'))
                               ->groupBy('candidates.first_name')
                               ->orderBy('votes_cnt', 'DESC')
                               ->take(7)
                               ->get();
        dd($top_arr);
        $data['top_arr'] = $top_arr;
        */

        /*
        SELECT COUNT(candidates.first_name) AS votes_cnt, candidates.party
        FROM votes
        INNER JOIN candidates ON votes.candidate_id = candidates.candidate_id
        INNER JOIN counties ON votes.county_name = counties.county_name
        WHERE counties.region = "Transilvania"
        GROUP BY candidates.first_name
        ORDER BY votes_cnt DESC
        */

        $top_arr = DB::table('votes')
                     ->join('candidates', 'candidates.candidate_id', '=', 'votes.candidate_id')
                     ->join('counties', 'votes.county_name', '=', 'counties.county_name')
                     ->where('counties.region', '=', $region)
                     ->select('candidates.party');
        $top_arr = $top_arr->addSelect(DB::raw('count(candidates.first_name) as votes_cnt'))
                               ->groupBy('candidates.first_name')
                               ->orderBy('votes_cnt', 'DESC')
                               ->get();
       //top_arr is a Collection object

       /*
           I want to put on graph first six parties ascended and alphabeticallyy ordered.
           And a "the rest of the parties" procent.
       */
        //dd($top_arr);
        $bottom_cnt = 0;

        //count the votes of the last parties
        for($i = 6; $i < sizeof($top_arr); $i++) {
            //echo $top_arr[$i]->party . " ";
            $bottom_cnt += $top_arr[$i]->votes_cnt;
        }
        //dd($bottom_cnt); 

        $topfirst_arr = array();
        for($i = 0; $i < 6; $i++) {
            $topfirst_arr[$i]["party"] = $top_arr[$i]->party;
            $topfirst_arr[$i]["votes_cnt"] = $top_arr[$i]->votes_cnt;
        }
        //dd($topfirst_arr);
        
        $topfirst_arr[6]["party"] = "restul_partidelor";
        $topfirst_arr[6]["votes_cnt"] = $bottom_cnt;
        //dd($topfirst_arr);

        //dd($top_arr);
        $data['top_arr'] = $top_arr;
        //dd($top_arr);
        //dd($data);
        //dd(compact("data"));
       return response()->json($topfirst_arr, 200);
   }

   public function get_image_data_TopYng() {

        /*
        SELECT COUNT(candidates.first_name) AS votes_cnt, candidates.party
        FROM votes
        INNER JOIN candidates ON votes.candidate_id = candidates.candidate_id
        INNER JOIN counties ON votes.county_name = counties.county_name
        WHERE counties.region = "Transilvania"
        GROUP BY candidates.first_name
        ORDER BY votes_cnt DESC
        */

        $top_arr = DB::table('votes')
                     ->join('candidates', 'candidates.candidate_id', '=', 'votes.candidate_id')
                     ->join('users', 'votes.user_id', '=', 'users.user_id')
                     ->where('users.age', '<', 30)
                     ->select('candidates.party');
        $top_arr = $top_arr->addSelect(DB::raw('count(candidates.first_name) as votes_cnt'))
                               ->groupBy('candidates.first_name')
                               ->orderBy('votes_cnt', 'DESC')
                               ->get();
       //top_arr is a Collection object

       /*
           I want to put on graph first six parties ascended and alphabeticallyy ordered.
           And a "the rest of the parties" procent.
       */
        //dd($top_arr);
        $bottom_cnt = 0;

        //count the votes of the last parties
        for($i = 6; $i < sizeof($top_arr); $i++) {
            //echo $top_arr[$i]->party . " ";
            $bottom_cnt += $top_arr[$i]->votes_cnt;
        }
        //dd($bottom_cnt); 

        $topfirst_arr = array();
        for($i = 0; $i < 6; $i++) {
            $topfirst_arr[$i]["party"] = $top_arr[$i]->party;
            $topfirst_arr[$i]["votes_cnt"] = $top_arr[$i]->votes_cnt;
        }
        //dd($topfirst_arr);
        
        $topfirst_arr[6]["party"] = "restul_partidelor";
        $topfirst_arr[6]["votes_cnt"] = $bottom_cnt;
        //dd($topfirst_arr);

        //dd($top_arr);
        $data['top_arr'] = $top_arr;
        //dd($top_arr);
        //dd($data);
        //dd(compact("data"));
       return response()->json($topfirst_arr, 200);
   }

   public function get_image_data_TopHgh() {

        /*
        SELECT COUNT(candidates.first_name) AS votes_cnt, candidates.party
        FROM votes
        INNER JOIN candidates ON votes.candidate_id = candidates.candidate_id
        INNER JOIN counties ON votes.county_name = counties.county_name
        WHERE counties.region = "Transilvania"
        GROUP BY candidates.first_name
        ORDER BY votes_cnt DESC
        */

        $top_arr = DB::table('votes')
                     ->join('candidates', 'candidates.candidate_id', '=', 'votes.candidate_id')
                     ->join('users', 'votes.user_id', '=', 'users.user_id')
                     ->where('users.education', '=', 1)
                     ->select('candidates.party');
        $top_arr = $top_arr->addSelect(DB::raw('count(candidates.first_name) as votes_cnt'))
                               ->groupBy('candidates.first_name')
                               ->orderBy('votes_cnt', 'DESC')
                               ->get();
       //top_arr is a Collection object

       /*
           I want to put on graph first six parties ascended and alphabeticallyy ordered.
           And a "the rest of the parties" procent.
       */
        //dd($top_arr);
        $bottom_cnt = 0;

        //count the votes of the last parties
        for($i = 6; $i < sizeof($top_arr); $i++) {
            //echo $top_arr[$i]->party . " ";
            $bottom_cnt += $top_arr[$i]->votes_cnt;
        }
        //dd($bottom_cnt); 

        $topfirst_arr = array();
        for($i = 0; $i < 6; $i++) {
            $topfirst_arr[$i]["party"] = $top_arr[$i]->party;
            $topfirst_arr[$i]["votes_cnt"] = $top_arr[$i]->votes_cnt;
        }
        //dd($topfirst_arr);
        
        $topfirst_arr[6]["party"] = "restul_partidelor";
        $topfirst_arr[6]["votes_cnt"] = $bottom_cnt;
        //dd($topfirst_arr);

        //dd($top_arr);
        $data['top_arr'] = $top_arr;
        //dd($top_arr);
        //dd($data);
        //dd(compact("data"));
       return response()->json($topfirst_arr, 200);
   }

   public function update_gdp() {
     $gdp = $_POST['gdp'];
     $county = $_POST['county'];

     County::where('county_name', '=', $county)->update(array('gdp' => $gdp));
     return response()->json("sucess", 200);
   }

   public function update_corr() {
     $corr = $_POST['corr'];
     $county = $_POST['county'];

     County::where('county_name', '=', $county)->update(array('corruption_level' => $corr));
     return response()->json("sucess", 200);
   }

   public function write_voting_state() {
     $stop_vote = $_POST["stop_vote"];

     $myFile = "/srv/http/pollvot/public/state.txt";
     $myFileLink = fopen($myFile, 'w+') or die("Can't open file.");
     fwrite($myFileLink, $stop_vote);
     fclose($myFileLink);

     return response()->json("sucess", 200);
   }
}
