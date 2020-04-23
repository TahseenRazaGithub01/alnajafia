<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IslamicCategory extends Model
{
    protected $fillable = [
    	'category_name_en',
        'slug',
        'category_description_en',
        'category_banner_image',
		'meta_title',
		'meta_keyword',
		'meta_description',
        'category_status'
    ];
}
