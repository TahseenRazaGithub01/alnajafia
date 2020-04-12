<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use Illuminate\Support\Str;
use Image;
use App\Helpers\helper as Helper;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.gallery.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        if(isset($request['gallery_image'])){

            $imageName = Helper::upload_image($request->file('gallery_image'));

        }else{
            $imageName = NULL ;
        }

        if(isset($request['youtube_url'])){
            $youtubeUrl = $request['youtube_url'];
        }else{
            $youtubeUrl = NULL ;
        }       

        $gallery = new Gallery();
        $gallery->title = $request->title;
        $gallery->gallery_image = $imageName;
        $gallery->youtube_url = $youtubeUrl;
        $gallery->save();

        return back()->with('success', 'Record has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $gallery = Gallery::select('id','title','gallery_image','youtube_url')->get();
        return view('admin.gallery.listing', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery, $id)
    {
        $record = $gallery::select('id','title','gallery_image','youtube_url')->whereId($id)->first();
        if($record != false){
            return view('admin.gallery.edit', compact('record'));
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $gallery = Gallery::find($request['id']);
        if(isset($request['gallery_image'])){

            $imageName = Helper::upload_image($request->file('gallery_image'));

            $data = array(
                'gallery_image'        => $imageName,
                'title'                => $request['title'],
            );
            $gallery->update($data);
        }
        if(isset($request['youtube_url'])){
            $data = array(
                'youtube_url'           => $request['youtube_url'],
                'title'                => $request['title'],
            );
            $gallery->update($data);
        }
        return redirect(route('admin.gallery.listing'))->with('success', 'Record has been updated successfully.');
        
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        Gallery::where('id', request()->id )->delete();
        return back()->with('success', 'Record has been deleted successfully.');
    }
}
