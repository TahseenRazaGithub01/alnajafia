<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrphanDetail;
use App\Models\OrphanCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrphanDetailRequest;
use App\Http\Requests\OrphanDetailUpdateRequest;
use Illuminate\Support\Str;
use Image;
use App\Helpers\helper as Helper;

class OrphanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = OrphanCategory::all()->pluck('category_name_en', 'id');
        return view('admin.orphanDetail.index', compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrphanDetail  $orphanDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OrphanDetail $orphanDetail)
    {
        $orphanDetail = OrphanDetail::select('id','detail_name_en')->get();
        return view('admin.orphanDetail.listing', compact('orphanDetail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrphanDetailRequest $request)
    {
        $orphanDetail = OrphanDetail::create($request->all());
        $orphanDetail->category()->attach($request->input('category_id'));

        return back()->with('success', 'Record has been added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrphanDetail  $orphanDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrphanDetail $orphanDetail, $id)
    {
        $record = $orphanDetail::with('category')->whereId($id)->first();

        $categories = OrphanCategory::all()->pluck('category_name_en', 'id');

        if($record != false){
            return view('admin.orphanDetail.edit', compact('record','categories'));
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrphanDetail  $orphanDetail
     * @return \Illuminate\Http\Response
     */
    public function update(OrphanDetailUpdateRequest $request, OrphanDetail $orphanDetail)
    {
        $orphanDetail = orphanDetail::find($request['id']);

        $orphanDetail->update($request->all());
        $orphanDetail->category()->sync($request->input('category_id'));

        return redirect(route('admin.basic_care.listing'))->with('success', 'Record has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrphanDetail  $orphanDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrphanDetail $orphanDetail)
    {
        $detail = OrphanDetail::findOrFail(request()->id);

        $detail->category()->detach();
        $detail->delete();
        return back()->with('success', 'Record has been deleted successfully.');
    }
}
