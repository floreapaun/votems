<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'party_name';

    public function votes()
    {
        return $this->hasMany('App\Vote', 'party_name', 'party_name');
    }
}
