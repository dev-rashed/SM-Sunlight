<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteVisitReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_name',
        'institute_location',
        'teachers_name',
        'teachers_mobile_number',
        'teachers_quantity',
        'students_quantity',
        'home_appliance_have',
        'home_appliance_dont_have',
        'remarks',
    ];
}
