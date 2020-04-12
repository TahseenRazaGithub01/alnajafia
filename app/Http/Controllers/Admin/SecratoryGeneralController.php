<?php

namespace App\Http\Controllers\Admin;

use App\Models\SecratoryGeneral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SecratoryGeneralRequest;
use App\Http\Requests\SecratoryGeneralUpdateRequest;
use Image;
use App\Helpers\helper as Helper;

class SecratoryGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.secretoryGeneral.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SecratoryGeneral  $secratoryGeneral
     * @return \Illuminate\Http\Response
     */
    public function show(SecratoryGeneral $secratoryGeneral)
    {
        $secratoryGeneral = SecratoryGeneral::select('id','banner_image','title_en','message_image','message_description_en')->get();
        return view('admin.secretoryGeneral.listing', compact('secratoryGeneral'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SecratoryGeneralRequest $request)
    {
        if(isset($request['banner_image'])){

            $bannerImage = Helper::upload_image($request->file('banner_image'));

        }else{
            $bannerImage = NULL ;
        }

        if(isset($request['message_image'])){

            $messageImage = Helper::upload_image($request->file('message_image'));

        }else{
            $messageImage = NULL ;
        }

        $secratoryGeneral = new SecratoryGeneral();
        $secratoryGeneral->banner_image = $bannerImage;
        $secratoryGeneral->title_en = $request->title;
        $secratoryGeneral->message_image = $messageImage;
        $secratoryGeneral->message_description_en = $request->message_description;
        $secratoryGeneral->save();

        return back()->with('success', 'Record has been added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SecratoryGeneral  $secratoryGeneral
     * @return \Illuminate\Http\Response
     */
    public function edit(SecratoryGeneral $secratoryGeneral, $id)
    {
        $record = $secratoryGeneral::select('id','banner_image','title_en','message_image','message_description_en')->whereId($id)->first();
        if($record != false){
            return view('admin.secretoryGeneral.edit', compact('record'));
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SecratoryGeneral  $secratoryGeneral
     * @return \Illuminate\Http\Response
     */
    public function update(SecratoryGeneralUpdateRequest $request, SecratoryGeneral $secratoryGeneral)
    {
        $record = SecratoryGeneral::find($request['id']);

        if(isset($request['banner_image'])){

            $bannerImage = Helper::upload_image($request->file('banner_image'));

            $record->update(['banner_image' => $bannerImage]);
        }

        if(isset($request['message_image'])){

            $message_image = Helper::upload_image($request->file('message_image'));

            $record->update(['message_image' => $message_image]);
        }

        $data = array(
                'title_en'                  => $request['title'],
                'message_description_en'    => $request['message_description'],
            );
        $record->update($data);

        return redirect(route('admin.secratory_general.listing'))->with('success', 'Record has been updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SecratoryGeneral  $secratoryGeneral
     * @return \Illuminate\Http\Response
     */
    public function destroy(SecratoryGeneral $secratoryGeneral)
    {
        //
    }
}
