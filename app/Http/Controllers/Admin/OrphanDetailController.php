<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrphanDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Requests\OrphanCategoryRequest;
//use App\Http\Requests\OrphanCategoryUpdateRequest;
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
        return view('admin.orphanDetail.index');
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
    public function store(Request $request)
    {
        $orphanDetail = OrphanDetail::create($request->all());
        $orphanDetail->category()->sync($request->input('category_id'));

        return back()->with('success', 'Record has been added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrphanDetail  $orphanDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrphanDetail $orphanDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrphanDetail  $orphanDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrphanDetail $orphanDetail)
    {
        //
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
