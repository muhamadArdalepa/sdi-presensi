<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;
    public $table = 'cabang';

    protected $fillable =[
        'cabang',
        'alamat',
        
    ];
 
    public function user()
    {
     return $this->hasMany('App\Models\user', 'cabang_id');
    }
}
