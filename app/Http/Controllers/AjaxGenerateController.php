<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//dd($bttn);

class AjaxGenerateController extends Controller
{
    public function index(){
        $bttn_id = $_POST["bttn_id"];
        //dd($bttn);
        if($bttn_id === "BttnGenAvgAge")
        {

            $pname = $_POST["helpdat"];

            /*
              $query = "SELECT AVG(votant.varsta) FROM voturi INNER JOIN votant 
              ON voturi.id_votant=votant.id_votant WHERE voturi.nume_partid=?
              GROUP BY voturi.nume_partid";
             */
    
            /*
                SELECT AVG(users.age) FROM votes INNER JOIN users ON votes.user_id=users.user_id 
                WHERE votes.party_name="Partidul Social Democrat" 
            */

            $value = DB::table('votes')
                ->join('users', 'votes.user_id', '=', 'users.user_id')
                ->where('votes.party_name', '=', $pname)
                ->avg('users.age');

            return response()->json(compact("bttn_id", "value"), 200);
        }
        else
            return response()->json(array('data'=> "sssssss"), 200);

   }
}
