<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSpecial extends Model
{
    use HasFactory;
    protected $fillable = [
        'GUID',
        'name',
        'status_IS',
        'criticality',
        'expert',
        'responsible_for_development',
        'responsible_for_maintenance',
        'functions_IS',
        'producer_IS',
        'domain',
        'subdomain',
    ];
}
