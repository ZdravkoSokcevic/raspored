<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
    	'weekup_time',
    	'bed_time',
    	'tea_143_quantity',
    	'tea_143_quatity_type',
    	'tea_11_quantity',
    	'tea_11_quatity_type',
    	'tea_55_quantity',
    	'tea_55_quatity_type',
    	'tea_all_day_quantity',

    ];
}
