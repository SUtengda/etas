<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    protected $table = 'partners';
    protected $primaryKey = 'PAR_UID';
    public $timestamps = false;
}
