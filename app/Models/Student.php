<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];
    function user(){
        return $this->belongsTo(User::class);
    }
    function class(){
        return $this->belongsTo(Classes::class);
    }
}
