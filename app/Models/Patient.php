<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_of_birth',
        'gender',
        'no_telp',
        'email',
        'keluhan',
        'diagnosa',

    ];
    public function examinations()
    {
        return $this->hasMany(Examination::class);
    }
}
