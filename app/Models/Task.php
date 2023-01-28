<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function pegawai(){

        return $this->belongsToMany(Pegawai::class)->withTimestamps();

    }

    public function task_details(){

        return $this->hasOne(TaskDetail::class)->withTimestamps();
    }

}
