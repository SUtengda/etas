<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Vats extends Model
{
    protected $table = 'vats';
    protected $primaryKey = 'VAT_UID';
    public $timestamps = false;

    protected $guarded=[];

    function partner(){
        return $this->belongsTo('App\Models\Partners','PAR_UID');
    }
    function client(){
        return $this->belongsTo('App\Models\Client','CLI_UID');
    }
}
