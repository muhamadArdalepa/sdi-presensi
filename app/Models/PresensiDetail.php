<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiDetail extends Model
{
    public $table ='presensi_details';
    use HasFactory;

    public function presensi()
    {
        return $this->hasOne('App\Models\Presensi','user_id', 'id');
    }


}
