<?php

namespace App\Http\Controllers\Admin;

use App\Models\IslamicPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\IslamicPageRequest;
use App\Http\Requests\IslamicPageUpdateRequest;
use Illuminate\Support\Str;
use Image;
use App\Helpers\helper as Helper;

class IslamicPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.islamicPage.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IslamicPageRequest $request)
    {
        $slug = Str::slug($request->detail_name_en, '-');

        $checkSlug = IslamicPage::select('id','slug')->whereSlug($slug)->first();
        if($checkSlug != false){

            $id = IslamicPage::select('id')->orderBy('id', 'desc')->first()->toArray();
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

        $khums = (isset($request->khums) ? $request->khums : 0 );
        $sistani = (isset($request->sistani) ? $request->sistani : 0 );
        $khamenei = (isset($request->khamenei) ? $request->khamenei : 0 );
        $najafy = (isset($request->najafy) ? $request->najafy : 0 );
        $khorasani = (isset($request->khorasani) ? $request->khorasani : 0 );
        $fayyadh = (isset($request->fayyadh) ? $request->fayyadh : 0 );
        $hakeem = (isset($request->hakeem) ? $request->hakeem : 0 );

        $niaz = (isset($request->niaz) ? $request->niaz : 0 );
        $general_niaz = (isset($request->general_niaz) ? $request->general_niaz : 0 );
        $muharram = (isset($request->muharram) ? $request->muharram : 0 );
        $ashura = (isset($request->ashura) ? $request->ashura : 0 );
        $shahadat_imam_hussain_as = (isset($request->shahadat_imam_hussain_as) ? $request->shahadat_imam_hussain_as : 0 );
        $arbaeen = (isset($request->arbaeen) ? $request->arbaeen : 0 );
        $shahadat_holy_prophet_pbuh = (isset($request->shahadat_holy_prophet_pbuh) ? $request->shahadat_holy_prophet_pbuh : 0 );
        $wiladat_holy_prophet_pbuh = (isset($request->wiladat_holy_prophet_pbuh) ? $request->wiladat_holy_prophet_pbuh : 0 );
        $shahadat_sayyida_fatima_sa = (isset($request->shahadat_sayyida_fatima_sa) ? $request->shahadat_sayyida_fatima_sa : 0 );
        $wiladat_sayyida_fatima_sa = (isset($request->wiladat_sayyida_fatima_sa) ? $request->wiladat_sayyida_fatima_sa : 0 );
        $wiladat_imam_ali_as = (isset($request->wiladat_imam_ali_as) ? $request->wiladat_imam_ali_as : 0 );
        $wiladat_imam_hussain_as = (isset($request->wiladat_imam_hussain_as) ? $request->wiladat_imam_hussain_as : 0 );
        $wiladat_abul_fadhl_as = (isset($request->wiladat_abul_fadhl_as) ? $request->wiladat_abul_fadhl_as : 0 );
        $wiladat_imam_mahdi_as = (isset($request->wiladat_imam_mahdi_as) ? $request->wiladat_imam_mahdi_as : 0 );
        $wiladat_imam_hassan_as = (isset($request->wiladat_imam_hassan_as) ? $request->wiladat_imam_hassan_as : 0 );
        $night_of_injury_imam_ali_as = (isset($request->night_of_injury_imam_ali_as) ? $request->night_of_injury_imam_ali_as : 0 );
        $shahadat_imam_ali_as = (isset($request->shahadat_imam_ali_as) ? $request->shahadat_imam_ali_as : 0 );
        $night_of_qadr = (isset($request->night_of_qadr) ? $request->night_of_qadr : 0 );
        $eid_al_ghadeer = (isset($request->eid_al_ghadeer) ? $request->eid_al_ghadeer : 0 );
        $eid_al_mubahilah = (isset($request->eid_al_mubahilah) ? $request->eid_al_mubahilah : 0 );
        $other = (isset($request->other) ? $request->other : 0 );

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
            'khums'                      => $khums,
            'sistani'                      => $sistani,
            'khamenei'                      => $khamenei,
            'najafy'                      => $najafy,
            'khorasani'                      => $khorasani,
            'fayyadh'                      => $fayyadh,
            'hakeem'                      => $hakeem,
            'niaz'                      => $niaz,
            'general_niaz'                      => $general_niaz,
            'muharram'                      => $muharram,
            'ashura'                      => $ashura,
            'shahadat_imam_hussain_as'                      => $shahadat_imam_hussain_as,
            'arbaeen'                      => $arbaeen,
            'shahadat_holy_prophet_pbuh'                      => $shahadat_holy_prophet_pbuh,
            'wiladat_holy_prophet_pbuh'                      => $wiladat_holy_prophet_pbuh,
            'shahadat_sayyida_fatima_sa'                      => $shahadat_sayyida_fatima_sa,
            'wiladat_sayyida_fatima_sa'                      => $wiladat_sayyida_fatima_sa,
            'wiladat_imam_ali_as'                      => $wiladat_imam_ali_as,
            'wiladat_imam_hussain_as'                      => $wiladat_imam_hussain_as,
            'wiladat_abul_fadhl_as'                      => $wiladat_abul_fadhl_as,
            'wiladat_imam_mahdi_as'                      => $wiladat_imam_mahdi_as,
            'wiladat_imam_hassan_as'                      => $wiladat_imam_hassan_as,
            'night_of_injury_imam_ali_as'                      => $night_of_injury_imam_ali_as,
            'shahadat_imam_ali_as'                      => $shahadat_imam_ali_as,
            'night_of_qadr'                      => $night_of_qadr,
            'eid_al_ghadeer'                      => $eid_al_ghadeer,
            'eid_al_mubahilah'                      => $eid_al_mubahilah,
            'other'                      => $other,
        );

        IslamicPage::create(array_merge($request->all(), $merge_data ));

        return back()->with('success', 'Record has been added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IslamicPage  $islamicPage
     * @return \Illuminate\Http\Response
     */
    public function show(IslamicPage $islamicPage)
    {
        $islamicPage = IslamicPage::select('id','detail_name_en','detail_page_image','page_status')->get()->toArray();
        return view('admin.islamicPage.listing', compact('islamicPage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IslamicPage  $islamicPage
     * @return \Illuminate\Http\Response
     */
    public function edit(IslamicPage $islamicPage, $id)
    {
        $record = $islamicPage::whereId($id)->first();

        if($record != false){
            return view('admin.islamicPage.edit', compact('record'));
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IslamicPage  $islamicPage
     * @return \Illuminate\Http\Response
     */
    public function update(IslamicPageUpdateRequest $request, IslamicPage $islamicPage)
    {
        $islamicPage = islamicPage::find($request['id']);

        $slug = Str::slug($request->detail_name_en, '-');

        $checkSlug = islamicPage::select('id','slug')->whereSlug($slug)->where('id', '!=' , $request['id'])->first();

        if($checkSlug != false){

            $slug = $slug.$request['id'];

        }

        if(isset($request['page_image'])){

            $page_image = Helper::upload_image($request->file('page_image'));

            $data = array(
                'detail_page_image'        => $page_image,
            );

            $islamicPage->update($data);

        }

        if(isset($request['banner_image'])){

            $banner_image = Helper::upload_image_for_banner($request->file('banner_image'));

            $data = array(
                'detail_banner_image'        => $banner_image,
            );

            $islamicPage->update($data);

        }

        $khums = (isset($request->khums) ? $request->khums : 0 );
        $sistani = (isset($request->sistani) ? $request->sistani : 0 );
        $khamenei = (isset($request->khamenei) ? $request->khamenei : 0 );
        $najafy = (isset($request->najafy) ? $request->najafy : 0 );
        $khorasani = (isset($request->khorasani) ? $request->khorasani : 0 );
        $fayyadh = (isset($request->fayyadh) ? $request->fayyadh : 0 );
        $hakeem = (isset($request->hakeem) ? $request->hakeem : 0 );

        $niaz = (isset($request->niaz) ? $request->niaz : 0 );
        $general_niaz = (isset($request->general_niaz) ? $request->general_niaz : 0 );
        $muharram = (isset($request->muharram) ? $request->muharram : 0 );
        $ashura = (isset($request->ashura) ? $request->ashura : 0 );
        $shahadat_imam_hussain_as = (isset($request->shahadat_imam_hussain_as) ? $request->shahadat_imam_hussain_as : 0 );
        $arbaeen = (isset($request->arbaeen) ? $request->arbaeen : 0 );
        $shahadat_holy_prophet_pbuh = (isset($request->shahadat_holy_prophet_pbuh) ? $request->shahadat_holy_prophet_pbuh : 0 );
        $wiladat_holy_prophet_pbuh = (isset($request->wiladat_holy_prophet_pbuh) ? $request->wiladat_holy_prophet_pbuh : 0 );
        $shahadat_sayyida_fatima_sa = (isset($request->shahadat_sayyida_fatima_sa) ? $request->shahadat_sayyida_fatima_sa : 0 );
        $wiladat_sayyida_fatima_sa = (isset($request->wiladat_sayyida_fatima_sa) ? $request->wiladat_sayyida_fatima_sa : 0 );
        $wiladat_imam_ali_as = (isset($request->wiladat_imam_ali_as) ? $request->wiladat_imam_ali_as : 0 );
        $wiladat_imam_hussain_as = (isset($request->wiladat_imam_hussain_as) ? $request->wiladat_imam_hussain_as : 0 );
        $wiladat_abul_fadhl_as = (isset($request->wiladat_abul_fadhl_as) ? $request->wiladat_abul_fadhl_as : 0 );
        $wiladat_imam_mahdi_as = (isset($request->wiladat_imam_mahdi_as) ? $request->wiladat_imam_mahdi_as : 0 );
        $wiladat_imam_hassan_as = (isset($request->wiladat_imam_hassan_as) ? $request->wiladat_imam_hassan_as : 0 );
        $night_of_injury_imam_ali_as = (isset($request->night_of_injury_imam_ali_as) ? $request->night_of_injury_imam_ali_as : 0 );
        $shahadat_imam_ali_as = (isset($request->shahadat_imam_ali_as) ? $request->shahadat_imam_ali_as : 0 );
        $night_of_qadr = (isset($request->night_of_qadr) ? $request->night_of_qadr : 0 );
        $eid_al_ghadeer = (isset($request->eid_al_ghadeer) ? $request->eid_al_ghadeer : 0 );
        $eid_al_mubahilah = (isset($request->eid_al_mubahilah) ? $request->eid_al_mubahilah : 0 );
        $other = (isset($request->other) ? $request->other : 0 );

        if(isset($request['page_status'])){

            if($request['page_status'] == "on"){

                $request['page_status'] = 1 ;

            }

        }else{

            $request['page_status'] = 0 ;
        }

        $merge_data = array(

            'slug'                      => $slug,
            'khums'                     => $khums,
            'sistani'                   => $sistani,
            'khamenei'                  => $khamenei,
            'najafy'                    => $najafy,
            'khorasani'                   => $khorasani,
            'fayyadh'                   => $fayyadh,
            'hakeem'                    => $hakeem,
            'niaz'                      => $niaz,
            'general_niaz'                      => $general_niaz,
            'muharram'                      => $muharram,
            'ashura'                      => $ashura,
            'shahadat_imam_hussain_as'                      => $shahadat_imam_hussain_as,
            'arbaeen'                      => $arbaeen,
            'shahadat_holy_prophet_pbuh'                      => $shahadat_holy_prophet_pbuh,
            'wiladat_holy_prophet_pbuh'                      => $wiladat_holy_prophet_pbuh,
            'shahadat_sayyida_fatima_sa'                      => $shahadat_sayyida_fatima_sa,
            'wiladat_sayyida_fatima_sa'                      => $wiladat_sayyida_fatima_sa,
            'wiladat_imam_ali_as'                      => $wiladat_imam_ali_as,
            'wiladat_imam_hussain_as'                      => $wiladat_imam_hussain_as,
            'wiladat_abul_fadhl_as'                      => $wiladat_abul_fadhl_as,
            'wiladat_imam_mahdi_as'                      => $wiladat_imam_mahdi_as,
            'wiladat_imam_hassan_as'                      => $wiladat_imam_hassan_as,
            'night_of_injury_imam_ali_as'                      => $night_of_injury_imam_ali_as,
            'shahadat_imam_ali_as'                      => $shahadat_imam_ali_as,
            'night_of_qadr'                      => $night_of_qadr,
            'eid_al_ghadeer'                      => $eid_al_ghadeer,
            'eid_al_mubahilah'                      => $eid_al_mubahilah,
            'other'                      => $other,
            'page_status'               => $request['page_status'],

        );

        $islamicPage->update(array_merge($request->all(), $merge_data) );

        return redirect(route('admin.islamic_page.listing'))->with('success', 'Record has been updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IslamicPage  $islamicPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(IslamicPage $islamicPage)
    {
        //
    }
}
