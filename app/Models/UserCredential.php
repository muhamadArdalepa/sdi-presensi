<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredential extends Model
{
    use HasFactory;
    public $table='user_credentials';

    public function user()
    {
        return $this->hasOne('App\Models\User','user_id', 'id');
    }
}
