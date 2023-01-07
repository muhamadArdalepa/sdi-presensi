<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    public $table ='presensi';
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\Presensi','user_id','id');
    }
}
