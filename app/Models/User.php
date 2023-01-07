<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    public $table = 'user';

    protected $guarded = ['id'];

    public function cabang()
    {
     return $this->belongsTo('App\Models\Cabang', 'cabang_id', 'cabang');
    }

    public function jabatan()
    {
     return $this->belongsTo('App\Models\Jabatan', 'jabatan_id', 'jabatan');
    }

}
