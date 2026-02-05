<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    protected $fillable = [
        'house_number',
        'kk_name',
        'rt',
        'rw',
        'dusun',
        'kalurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'latitude',
        'longitude',
        'description',
        'family_members'
    ];
}

