<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    protected $fillable = [
    	'project_name_en','slug','project_description_en','project_image','project_banner_image','project_status','subcategory_options','wheel_chair','general_fund','education_phd','education_master','cart','eye_cataract','aun','donation_process','min_amount','recurring','monthly','quarterly','half_yearly','yearly','year_around','fixed_amount','fixed_amount_value','duration','start_duration_date','end_duration_date','count_number','min_count','max_count','meta_title','meta_keyword','meta_description'
    ];
}
