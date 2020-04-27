<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IslamicPage extends Model
{
    protected $fillable = [
    	'detail_name_en',
        'slug',
        'description_en',
        'detail_page_image',
        'detail_banner_image',
        'khums',
        'sistani',
        'khamenei',
        'najafy',
        'khorasani',
        'fayyadh',
        'hakeem',
        'niaz',
        'general_niaz',
        'muharram',
        'ashura',
        'shahadat_imam_hussain_as',
        'arbaeen',
        'shahadat_holy_prophet_pbuh',
        'wiladat_holy_prophet_pbuh',
        'shahadat_sayyida_fatima_sa',
        'wiladat_sayyida_fatima_sa',
        'wiladat_imam_ali_as',
        'wiladat_imam_hussain_as',
        'wiladat_abul_fadhl_as',
        'wiladat_imam_mahdi_as',
        'wiladat_imam_hassan_as',
        'night_of_injury_imam_ali_as',
        'shahadat_imam_ali_as',
        'night_of_qadr',
        'eid_al_ghadeer',
        'eid_al_mubahilah',
        'other',
		'meta_title',
		'meta_keyword',
		'meta_description',
        'page_status'
    ];
}
