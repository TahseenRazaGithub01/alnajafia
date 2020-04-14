<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrphanStudent extends Model
{
    protected $fillable = [
    	'name_en',
    	'gender',
    	'orphan_type',
    	'cast',
    	'date_of_birth',
    	'orphan_profile_id',
    	'city',
    	'mother_name',
    	'orphan_profile_picture',
        'student_status'
    ];
}
