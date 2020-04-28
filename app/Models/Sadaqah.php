<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sadaqah extends Model
{
    protected $fillable = [
    	'detail_name_en',
        'slug',
        'description_en',
        'detail_page_image',
        'detail_banner_image',
        'recurring',
        'monthly',
        'quarterly',
        'half_yearly',
        'yearly',
        'donation_amount',
        'value_one',
        'value_two',
        'value_three',
        'holy_personality',
        'imam_zamin',
        'imam_ali_mahdi_as',
        'sayyida_zainab_sa',
        'umm_ul_baneen',
        'abul_fadhl_abbas_as',
        'sayyid_ali_akbar_as',
        'sayyida_ruqayyah_sakina_sa',
        'sayyid_ali_asghar_as',
		'meta_title',
		'meta_keyword',
		'meta_description',
        'page_status'
    ];
}
