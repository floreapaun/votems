<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }
     
    public function candidate()
    {
        return $this->belongsTo('App\Candidate', 'candidate_id', 'candidate_id');
    }
    
    public function party()
    {
        return $this->belongsTo('App\Party', 'party_name', 'party_name');
    }

    public function county()
    {
        return $this->belongsTo('App\County', 'county_name', 'county_name');
    }

}

