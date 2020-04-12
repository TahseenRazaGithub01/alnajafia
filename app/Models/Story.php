<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
    	'name_en','slug','description_en','story_image','our_story','success_story','news','meta_title','meta_keyword','meta_description'
    ];
}
