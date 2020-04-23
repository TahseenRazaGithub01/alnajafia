<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IslamicDetail extends Model
{
    protected $fillable = [
    	'detail_name_en',
        'slug',
        'description_en',
        'detail_page_image',
        'detail_banner_image',
        'min_amount',
        'min_value',
        'recurring',
        'monthly',
        'quarterly',
        'half_yearly',
        'yearly',
        'year_around',
        'marhomeen',
        'calender',
        'syed',
        'amount',
        'amount_value',
        'duration',
        'start_duration_date',
        'end_duration_date',
        'count_number',
        'min_count',
        'max_count',
		'meta_title',
		'meta_keyword',
		'meta_description',
        'page_status'
    ];

    public function category()
    {
        return $this->belongsToMany(IslamicCategory::class);
    }

}
