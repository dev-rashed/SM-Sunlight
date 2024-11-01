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
        'home_appliance_have_f',
        'home_appliance_not_have_f',
        'remarks',
        'created_at',
        'updated_at',
    ];
}
