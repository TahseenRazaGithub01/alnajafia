<?php

namespace App\Http\Controllers\Admin;

use App\Models\IslamicCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\IslamicCategoryRequest;
use App\Http\Requests\IslamicCategoryUpdateRequest;
use Illuminate\Support\Str;
use Image;
use App\Helpers\helper as Helper;

class IslamicCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.islamicCategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IslamicCategory  $islamicCategory
     * @return \Illuminate\Http\Response
     */
    public function show(IslamicCategory $islamicCategory)
    {
        $islamicCategory = IslamicCategory::select('id','category_name_en','category_banner_image','category_status')->orderBy('id', 'DESC')->get();

        return view('admin.islamicCategory.listing', compact('islamicCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IslamicCategoryRequest $request)
    {
        $slug = Str::slug($request->category_name_en, '-');

        $checkSlug = IslamicCategory::select('id','slug')->whereSlug($slug)->first();

        if($checkSlug != false){

            $id = IslamicCategory::select('id')->orderBy('id', 'desc')->first()->toArray();
            $number = $id['id'] + 1 ;
            $slug = $slug.$number;

        }

        if(isset($request['banner_image'])){

            $banner_image = Helper::upload_image_for_banner($request->file('banner_image'));

        }else{
            $banner_image = NULL ;
        }


        $merge_data = array(
            'slug'                      => $slug,
            'category_banner_image'     => $banner_image,
        );

        IslamicCategory::create(array_merge($request->all(), $merge_data ));

        return back()->with('success', 'Record has been added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IslamicCategory  $islamicCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(IslamicCategory $islamicCategory, $id)
    {
        $record = $islamicCategory::whereId($id)->first();

        if($record != false){
            return view('admin.islamicCategory.edit', compact('record'));
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IslamicCategory  $islamicCategory
     * @return \Illuminate\Http\Response
     */
    public function update(IslamicCategoryUpdateRequest $request, IslamicCategory $islamicCategory)
    {
        $islamicCategory = islamicCategory::find($request['id']);

        $slug = Str::slug($request->category_name_en, '-');

        $checkSlug = islamicCategory::select('id','slug')->whereSlug($slug)->where('id', '!=' , $request['id'])->first();

        if($checkSlug != false){

            $slug = $slug.$request['id'];

        }

        if(isset($request['banner_image'])){

            $banner_image = Helper::upload_image_for_banner($request->file('banner_image'));

            $data = array(
                'category_banner_image'        => $banner_image,
            );

            $islamicCategory->update($data);

        }

        if(isset($request['category_status'])){

            if($request['category_status'] == "on"){

                $request['category_status'] = 1 ;

            }

        }else{

            $request['category_status'] = 0 ;
        }

        $merge_data = array(

            'slug'                         => $slug,
            'category_status'              => $request['category_status'],

        );


        //$islamicCategory->update($request->all());

        $islamicCategory->update(array_merge($request->all(), $merge_data) ); 

        return redirect(route('admin.islamic_category.listing'))->with('success', 'Record has been updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IslamicCategory  $islamicCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(IslamicCategory $islamicCategory)
    {
        $detail = islamicCategory::findOrFail(request()->id);

        $detail->delete();
        return back()->with('success', 'Record has been deleted successfully.');
    }
}
