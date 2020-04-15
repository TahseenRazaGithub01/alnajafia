<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrphanCategory extends Model
{
    protected $fillable = [
    	'category_name_en','slug','category_banner_image','category_description_en','meta_title','meta_keyword','meta_description'
    ];
	
	public function detail()
    {
        return $this->belongsToMany(OrphanDetail::class);
    }
}
