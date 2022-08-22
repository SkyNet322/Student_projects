<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guid_id',
    ];

    public function inflics()
    {
        return $this->hasMany(inflic::class);
    }
    public function personnels()
    {
        return $this->hasMany(personnel::class);
    }

    public function dataSpecial()
    {
        return $this->belongsTo(DataSpecial::class);
    }
}
