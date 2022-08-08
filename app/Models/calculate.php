<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calculate extends Model
{
    public function inflics()
    {
        return $this->hasMany(inflic::class);
    }
    public function personnels()
    {
        return $this->hasMany(personnel::class);
    }
    use HasFactory;
    protected $fillable = [
        'item',
        'type',
        'description',
        'inflic_1_year',
        'inflic_2_year',
        'inflic_3_year',
        'inflic_4_year',
        'inflic_5_year',
        'total'
    ];

}
