<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class connect extends Model
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
    use HasFactory;
    protected $fillable = [
        'user_id',
        'guid_id',
    ];
}