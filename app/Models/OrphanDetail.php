<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrphanDetail extends Model
{
    protected $fillable = [
    	'detail_name_en',
		'meta_title',
		'meta_keyword',
		'meta_description'
    ];
	
	public function category()
    {
        return $this->belongsToMany(OrphanCategory::class);
    }

}
