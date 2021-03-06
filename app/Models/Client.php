<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'CLI_UID';
    public $timestamps = false;

    protected $guarded=[];

    public function vats(){
        return $this->hasMany('App\Models\Vats','CLI_UID');
    }
}
