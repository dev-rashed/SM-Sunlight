<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeVisitReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'customer_name',
        'mobile_number',
        'village_name',
        'word_number',
        'union_name',
        'thana',
        'district',
        'home_appliance_have',
        'home_appliance_not_have',
        'remarks',
    ];
}
