<?php

namespace App\Http\Controllers\Admin;

use App\Models\IslamicDetail;
use App\Models\IslamicCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\IslamicDetailRequest;
use App\Http\Requests\IslamicDetailUpdateRequest;
use Illuminate\Support\Str;
use Image;
use App\Helpers\helper as Helper;


class IslamicDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = IslamicCategory::all()->pluck('category_name_en', 'id');
        return view('admin.islamicDetail.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IslamicDetailRequest $request)
    {
        $slug = Str::slug($request->detail_name_en, '-');

        $checkSlug = IslamicDetail::select('id','slug')->whereSlug($slug)->first();
        if($checkSlug != false){

            $id = IslamicDetail::select('id')->orderBy('id', 'desc')->first()->toArray();
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

        $min_amount = (isset($request->min_amount) ? $request->min_amount : 0 );
        $recurring = (isset($request->recurring) ? $request->recurring : 0 );
        $monthly = (isset($request->monthly) ? $request->monthly : 0 );
        $quarterly = (isset($request->quarterly) ? $request->quarterly : 0 );
        $half_yearly = (isset($request->half_yearly) ? $request->half_yearly : 0 );
        $yearly = (isset($request->yearly) ? $request->yearly : 0 );
        $year_around = (isset($request->year_around) ? $request->year_around : 0 );
        $marhomeen = (isset($request->marhomeen) ? $request->marhomeen : 0 );
        $calender = (isset($request->calender) ? $request->calender : 0 );
        $syed = (isset($request->syed) ? $request->syed : 0 );
        $fixed_amount = (isset($request->fixed_amount) ? $request->fixed_amount : 0 );
        $duration = (isset($request->duration) ? $request->duration : 0 );

        if($duration == 1){
            if($request['start_duration_date'] != null){
                $start_duration_date = date('yy-m-d', strtotime($request['start_duration_date']));
            }else{
                $start_duration_date = NULL;
            }
            if($request['end_duration_date']){
                $end_duration_date = date('yy-m-d', strtotime($request['end_duration_date']));              
            }else{
                $end_duration_date = NULL;
            }
        }else{
            $start_duration_date = NULL;
            $end_duration_date = NULL;
        }

        $count_number = (isset($request->count_number) ? $request->count_number : 0 );

        if(isset($request['page_status'])){

            if($request['page_status'] == "on"){

                $request['page_status'] = 1 ;

            }

        }else{

            $request['page_status'] = 0 ;
        }

        $merge_data = array(

            'slug'                  => $slug,
            'detail_page_image'     => $page_image,
            'detail_banner_image'     => $banner_image,
            'min_amount'                => $min_amount,
            'min_value'                 => $request->min_value,
            'recurring'             => $recurring,
            'monthly'                => $monthly,
            'quarterly'             => $quarterly,
            'half_yearly'            => $half_yearly,
            'yearly'                 => $yearly,
            'year_around'              => $year_around,
            'marhomeen'                => $marhomeen,
            'calender'                 => $calender,
            'syed'                     => $syed,
            'amount'                   => $fixed_amount,
            'amount_value'             => $request->fixed_amount_value,
            'duration'                  => $duration,
            'start_duration_date'       => $start_duration_date,
            'end_duration_date'         => $end_duration_date,
            'count_number'              => $count_number,
            'page_status'               => $request['page_status'],

        );

        $islamicDetail = IslamicDetail::create(array_merge($request->all(), $merge_data ));

        $islamicDetail->category()->attach($request->input('category_id'));

        return back()->with('success', 'Record has been added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IslamicDetail  $islamicDetail
     * @return \Illuminate\Http\Response
     */
    public function show(IslamicDetail $islamicDetail)
    {
        $islamicDetail = IslamicDetail::select('id','detail_name_en','detail_page_image','page_status')->get()->toArray();
        return view('admin.islamicDetail.listing', compact('islamicDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IslamicDetail  $islamicDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(IslamicDetail $islamicDetail, $id)
    {
        $record = $islamicDetail::whereId($id)->first();

        $categories = IslamicCategory::all()->pluck('category_name_en', 'id');

        if($record != false){
            return view('admin.islamicDetail.edit', compact('record', 'categories'));
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IslamicDetail  $islamicDetail
     * @return \Illuminate\Http\Response
     */
    public function update(IslamicDetailUpdateRequest $request, IslamicDetail $islamicDetail)
    {
        $islamicDetail = islamicDetail::find($request['id']);

        $slug = Str::slug($request->detail_name_en, '-');

        $checkSlug = islamicDetail::select('id','slug')->whereSlug($slug)->where('id', '!=' , $request['id'])->first();

        if($checkSlug != false){

            $slug = $slug.$request['id'];

        }

        if(isset($request['page_image'])){

            $page_image = Helper::upload_image($request->file('page_image'));

            $data = array(
                'detail_page_image'        => $page_image,
            );

            $islamicDetail->update($data);

        }

        if(isset($request['banner_image'])){

            $banner_image = Helper::upload_image_for_banner($request->file('banner_image'));

            $data = array(
                'detail_banner_image'        => $banner_image,
            );

            $islamicDetail->update($data);

        }

        $min_amount = (isset($request->min_amount) ? $request->min_amount : 0 );
        $recurring = (isset($request->recurring) ? $request->recurring : 0 );
        $monthly = (isset($request->monthly) ? $request->monthly : 0 );
        $quarterly = (isset($request->quarterly) ? $request->quarterly : 0 );
        $half_yearly = (isset($request->half_yearly) ? $request->half_yearly : 0 );
        $yearly = (isset($request->yearly) ? $request->yearly : 0 );
        $year_around = (isset($request->year_around) ? $request->year_around : 0 );
        $marhomeen = (isset($request->marhomeen) ? $request->marhomeen : 0 );
        $calender = (isset($request->calender) ? $request->calender : 0 );
        $syed = (isset($request->syed) ? $request->syed : 0 );
        $fixed_amount = (isset($request->fixed_amount) ? $request->fixed_amount : 0 );
        $duration = (isset($request->duration) ? $request->duration : 0 );

        if($duration == 1){
            if($request['start_duration_date'] != null){
                $start_duration_date = date('yy-m-d', strtotime($request['start_duration_date']));
            }else{
                $start_duration_date = NULL;
            }
            if($request['end_duration_date']){
                $end_duration_date = date('yy-m-d', strtotime($request['end_duration_date']));              
            }else{
                $end_duration_date = NULL;
            }
        }else{
            $start_duration_date = NULL;
            $end_duration_date = NULL;
        }

        $count_number = (isset($request->count_number) ? $request->count_number : 0 );

        if(isset($request['page_status'])){

            if($request['page_status'] == "on"){

                $request['page_status'] = 1 ;

            }

        }else{

            $request['page_status'] = 0 ;
        }

        $merge_data = array(

            'slug'                      => $slug,
            'min_amount'                => $min_amount,
            'min_value'                 => $request->min_value,
            'recurring'                 => $recurring,
            'monthly'                   => $monthly,
            'quarterly'                 => $quarterly,
            'half_yearly'               => $half_yearly,
            'yearly'                    => $yearly,
            'year_around'               => $year_around,
            'marhomeen'                => $marhomeen,
            'calender'                 => $calender,
            'syed'                      => $syed,
            'amount'                   => $fixed_amount,
            'amount_value'             => $request->fixed_amount_value,
            'duration'                  => $duration,
            'start_duration_date'       => $start_duration_date,
            'end_duration_date'         => $end_duration_date,
            'count_number'              => $count_number,

        );

        $islamicDetail->update(array_merge($request->all(), $merge_data) );

        $islamicDetail->category()->sync($request->input('category_id'));

        return redirect(route('admin.islamic_detail.listing'))->with('success', 'Record has been updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IslamicDetail  $islamicDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(IslamicDetail $islamicDetail)
    {
        $detail = IslamicDetail::findOrFail(request()->id);

        $detail->category()->detach();
        $detail->delete();
        return back()->with('success', 'Record has been deleted successfully.');
    }
}
