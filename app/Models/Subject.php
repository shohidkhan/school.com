<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
