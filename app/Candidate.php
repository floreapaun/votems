<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $primaryKey = 'candidate_id';

    public function votes()
    {
        return $this->hasMany('App\Vote', 'candidate_id', 'candidate_id');
    }
}
