<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personnel extends Model
{
    use HasFactory;
    protected $fillable = [
        'post',
        'quantity_of_the_rate',
        'unified_social_tax',
        'wage',
        'number_of_month_of_work',
    ];
}
