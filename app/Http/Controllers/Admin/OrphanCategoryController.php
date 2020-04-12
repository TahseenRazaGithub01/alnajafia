<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrphanCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrphanCategoryRequest;
use App\Http\Requests\OrphanCategoryUpdateRequest;
use Illuminate\Support\Str;
use Image;
use App\Helpers\helper as Helper;

class OrphanCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.orphanCategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrphanCategory  $orphanCategory
     * @return \Illuminate\Http\Response
     */
    public function show(OrphanCategory $orphanCategory)
    {
        $orphanCategory = OrphanCategory::select('id','category_name_en','category_description_en','category_banner_image')->get();
        return view('admin.orphanCategory.listing', compact('orphanCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrphanCategoryRequest $request)
    {

        $slug = Str::slug($request->name, '-');

        $checkSlug = OrphanCategory::select('id','slug')->whereSlug($slug)->first();

        if($checkSlug != false){

            $id = OrphanCategory::select('id')->orderBy('id', 'desc')->first()->toArray();
            $number = $id['id'] + 1 ;
            $slug = $slug.$number;

        }

        if(isset($request['banner_image'])){

            $banner_image = Helper::upload_image_for_banner($request->file('banner_image'));

        }else{
            $banner_image = NULL ;
        }

        $orphanCategory = new OrphanCategory();

        $orphanCategory->category_name_en = $request->name;
        $orphanCategory->slug = $slug;
        $orphanCategory->category_description_en = $request->description;
        $orphanCategory->category_banner_image = $banner_image;
        
        $orphanCategory->meta_title = $request->meta_title;
        $orphanCategory->meta_keyword = $request->meta_keyword;
        $orphanCategory->meta_description = $request->meta_description;
        $orphanCategory->save();

        return back()->with('success', 'Record has been added successfully.');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrphanCategory  $orphanCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(OrphanCategory $orphanCategory, $id)
    {
        $record = $orphanCategory::whereId($id)->first();
        if($record != false){
            return view('admin.orphanCategory.edit', compact('record'));
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrphanCategory  $orphanCategory
     * @return \Illuminate\Http\Response
     */
    public function update(OrphanCategoryUpdateRequest $request, OrphanCategory $orphanCategory)
    {
        $orphanCategory = OrphanCategory::find($request['id']);

        $slug = Str::slug($request->name, '-');

        $checkSlug = OrphanCategory::select('id','slug')->whereSlug($slug)->where('id', '!=' , $request['id'])->first();

        if($checkSlug != false){

            $slug = $slug.$request['id'];

        }

        if(isset($request['banner_image'])){

            $banner_image = Helper::upload_image_for_banner($request->file('banner_image'));

            $data = array(
                'category_banner_image'        => $banner_image,
            );
            $orphanCategory->update($data);
        }

        $data = array(
            'category_name_en'                => $request['name'],
            'slug'                            => $slug,
            'category_description_en'         => $request['description'],
        
            'meta_title'                     => $request['meta_title'],
            'meta_keyword'                   => $request['meta_keyword'],
            'meta_description'               => $request['meta_description'],
        );
        
        $orphanCategory->update($data);
        return redirect(route('admin.orphan.listing'))->with('success', 'Record has been updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrphanCategory  $orphanCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrphanCategory $orphanCategory)
    {
        OrphanCategory::where('id', request()->id )->delete();
        return back()->with('success', 'Record has been deleted successfully.');
    }
}
