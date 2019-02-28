<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'county_name';

    public function votes()
    {
        return $this->hasMany('App\Vote', 'county_name', 'county_name');
    }
}
