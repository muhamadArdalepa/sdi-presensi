<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredential extends Model
{
    use HasFactory;
    public $table='usercredential';

    public function User()
    {
        return $this->hasOne('App\Models\User','user_id', 'id');
    }
}
