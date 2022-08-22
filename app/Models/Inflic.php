<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inflic extends Model
{
    use HasFactory;
    protected $fillable = [
        'connect_id',
        'item',
        'type',
        'description',
        'inflic_1_year',
        'inflic_2_year',
        'inflic_3_year',
        'inflic_4_year',
        'inflic_5_year',
    ];
}
