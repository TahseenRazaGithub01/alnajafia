<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sadaqah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SadaqahRequest;
use App\Http\Requests\SadaqahUpdateRequest;
use Illuminate\Support\Str;
use Image;
use App\Helpers\helper as Helper;

class SadaqahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sadaqah.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SadaqahRequest $request)
    {
        $slug = Str::slug($request->detail_name_en, '-');

        $checkSlug = Sadaqah::select('id','slug')->whereSlug($slug)->first();
        if($checkSlug != false){

            $id = Sadaqah::select('id')->orderBy('id', 'desc')->first()->toArray();
            $number = $id['id'] + 1 ;
            $slug = $slug.$number;

        }

        if(isset($request['page_image'])){

            $page_image = Helper::upload_image($request->file('page_image'));

        }else{
            $page_image = NULL ;
        }

        if(isset($request['banner_image'])){

            $banner_image = Helper::upload_image_for_banner($request->file('banner_image'));

        }else{
            $banner_image = NULL ;
        }

        $recurring = (isset($request->recurring) ? $request->recurring : 0 );
        $monthly = (isset($request->monthly) ? $request->monthly : 0 );
        $quarterly = (isset($request->quarterly) ? $request->quarterly : 0 );
        $half_yearly = (isset($request->half_yearly) ? $request->half_yearly : 0 );
        $yearly = (isset($request->yearly) ? $request->yearly : 0 );

        $donation_amount = (isset($request->donation_amount) ? $request->donation_amount : 0 );
        $value_one = (isset($request->value_one) ? $request->value_one : NULL );
        $value_two = (isset($request->value_two) ? $request->value_two : NULL );
        $value_three = (isset($request->value_three) ? $request->value_three : NULL );

        $holy_personality = (isset($request->holy_personality) ? $request->holy_personality : 0 );
        $imam_zamin = (isset($request->imam_zamin) ? $request->imam_zamin : 0 );
        $imam_ali_mahdi_as = (isset($request->imam_ali_mahdi_as) ? $request->imam_ali_mahdi_as : 0 );
        $sayyida_zainab_sa = (isset($request->sayyida_zainab_sa) ? $request->sayyida_zainab_sa : 0 );
        $umm_ul_baneen = (isset($request->umm_ul_baneen) ? $request->umm_ul_baneen : 0 );
        $abul_fadhl_abbas_as = (isset($request->abul_fadhl_abbas_as) ? $request->abul_fadhl_abbas_as : 0 );
        $sayyid_ali_akbar_as = (isset($request->sayyid_ali_akbar_as) ? $request->sayyid_ali_akbar_as : 0 );
        $sayyida_ruqayyah_sakina_sa = (isset($request->sayyida_ruqayyah_sakina_sa) ? $request->sayyida_ruqayyah_sakina_sa : 0 );
        $sayyid_ali_asghar_as = (isset($request->sayyid_ali_asghar_as) ? $request->sayyid_ali_asghar_as : 0 );

        if(isset($request['page_status'])){

            if($request['page_status'] == "on"){

                $request['page_status'] = 1 ;

            }

        }else{

            $request['page_status'] = 0 ;
        }

        $merge_data = array(

            'slug'                      => $slug,
            'detail_page_image'         => $page_image,
            'detail_banner_image'       => $banner_image,
            'page_status'               => $request['page_status'],
            'recurring'                      => $recurring,
            'monthly'                      => $monthly,
            'quarterly'                      => $quarterly,
            'half_yearly'                      => $half_yearly,
            'yearly'                      => $yearly,
            'donation_amount'                      => $donation_amount,
            'value_one'                      => $value_one,
            'value_two'                      => $value_two,
            'value_three'                      => $value_three,
            'holy_personality'                      => $holy_personality,
            'imam_zamin'                      => $imam_zamin,
            'imam_ali_mahdi_as'                      => $imam_ali_mahdi_as,
            'sayyida_zainab_sa'                      => $sayyida_zainab_sa,
            'umm_ul_baneen'                      => $umm_ul_baneen,
            'abul_fadhl_abbas_as'                      => $abul_fadhl_abbas_as,
            'sayyid_ali_akbar_as'                      => $sayyid_ali_akbar_as,
            'sayyida_ruqayyah_sakina_sa'                      => $sayyida_ruqayyah_sakina_sa,
            'sayyid_ali_asghar_as'                      => $sayyid_ali_asghar_as,
        );

        Sadaqah::create(array_merge($request->all(), $merge_data ));

        return back()->with('success', 'Record has been added successfully.');

    }
	
	/**
     * Display the specified resource.
     *
     * @param  \App\Sadaqah  $sadaqah
     * @return \Illuminate\Http\Response
     */
    public function show(Sadaqah $sadaqah)
    {
        $sadaqah = Sadaqah::select('id','detail_name_en','detail_page_image','page_status')->get()->toArray();
        return view('admin.sadaqah.listing', compact('sadaqah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sadaqah  $sadaqah
     * @return \Illuminate\Http\Response
     */
    public function edit(Sadaqah $sadaqah, $id)
    {
        $record = $sadaqah::whereId($id)->first();

        if($record != false){
            return view('admin.sadaqah.edit', compact('record'));
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sadaqah  $sadaqah
     * @return \Illuminate\Http\Response
     */
    public function update(SadaqahUpdateRequest $request, Sadaqah $sadaqah)
    {
        $sadaqah = sadaqah::find($request['id']);

        $slug = Str::slug($request->detail_name_en, '-');

        $checkSlug = sadaqah::select('id','slug')->whereSlug($slug)->where('id', '!=' , $request['id'])->first();

        if($checkSlug != false){

            $slug = $slug.$request['id'];

        }

        if(isset($request['page_image'])){

            $page_image = Helper::upload_image($request->file('page_image'));

            $data = array(
                'detail_page_image'        => $page_image,
            );

            $sadaqah->update($data);

        }

        if(isset($request['banner_image'])){

            $banner_image = Helper::upload_image_for_banner($request->file('banner_image'));

            $data = array(
                'detail_banner_image'        => $banner_image,
            );

            $sadaqah->update($data);

        }

        $recurring = (isset($request->recurring) ? $request->recurring : 0 );
        $monthly = (isset($request->monthly) ? $request->monthly : 0 );
        $quarterly = (isset($request->quarterly) ? $request->quarterly : 0 );
        $half_yearly = (isset($request->half_yearly) ? $request->half_yearly : 0 );
        $yearly = (isset($request->yearly) ? $request->yearly : 0 );

        $donation_amount = (isset($request->donation_amount) ? $request->donation_amount : 0 );
        $value_one = (isset($request->value_one) ? $request->value_one : NULL );
        $value_two = (isset($request->value_two) ? $request->value_two : NULL );
        $value_three = (isset($request->value_three) ? $request->value_three : NULL );

        $holy_personality = (isset($request->holy_personality) ? $request->holy_personality : 0 );
        $imam_zamin = (isset($request->imam_zamin) ? $request->imam_zamin : 0 );
        $imam_ali_mahdi_as = (isset($request->imam_ali_mahdi_as) ? $request->imam_ali_mahdi_as : 0 );
        $sayyida_zainab_sa = (isset($request->sayyida_zainab_sa) ? $request->sayyida_zainab_sa : 0 );
        $umm_ul_baneen = (isset($request->umm_ul_baneen) ? $request->umm_ul_baneen : 0 );
        $abul_fadhl_abbas_as = (isset($request->abul_fadhl_abbas_as) ? $request->abul_fadhl_abbas_as : 0 );
        $sayyid_ali_akbar_as = (isset($request->sayyid_ali_akbar_as) ? $request->sayyid_ali_akbar_as : 0 );
        $sayyida_ruqayyah_sakina_sa = (isset($request->sayyida_ruqayyah_sakina_sa) ? $request->sayyida_ruqayyah_sakina_sa : 0 );
        $sayyid_ali_asghar_as = (isset($request->sayyid_ali_asghar_as) ? $request->sayyid_ali_asghar_as : 0 );

        if(isset($request['page_status'])){

            if($request['page_status'] == "on"){

                $request['page_status'] = 1 ;

            }

        }else{

            $request['page_status'] = 0 ;
        }

        $merge_data = array(

            'slug'                      => $slug,
            'page_status'               => $request['page_status'],
            'recurring'                      => $recurring,
            'monthly'                      => $monthly,
            'quarterly'                      => $quarterly,
            'half_yearly'                      => $half_yearly,
            'yearly'                      => $yearly,
            'donation_amount'                      => $donation_amount,
            'value_one'                      => $value_one,
            'value_two'                      => $value_two,
            'value_three'                      => $value_three,
            'holy_personality'                      => $holy_personality,
            'imam_zamin'                      => $imam_zamin,
            'imam_ali_mahdi_as'                      => $imam_ali_mahdi_as,
            'sayyida_zainab_sa'                      => $sayyida_zainab_sa,
            'umm_ul_baneen'                      => $umm_ul_baneen,
            'abul_fadhl_abbas_as'                      => $abul_fadhl_abbas_as,
            'sayyid_ali_akbar_as'                      => $sayyid_ali_akbar_as,
            'sayyida_ruqayyah_sakina_sa'                      => $sayyida_ruqayyah_sakina_sa,
            'sayyid_ali_asghar_as'                      => $sayyid_ali_asghar_as,
        );

        $sadaqah->update(array_merge($request->all(), $merge_data) );

        return redirect(route('admin.sadaqah.listing'))->with('success', 'Record has been updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sadaqah  $sadaqah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sadaqah $sadaqah)
    {
        $detail = Sadaqah::findOrFail(request()->id);

        $detail->delete();
        return back()->with('success', 'Record has been deleted successfully.');
    }
}
