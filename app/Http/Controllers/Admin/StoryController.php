<?php

namespace App\Http\Controllers\Admin;

use App\Models\Story;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoryRequest;
use App\Http\Requests\StoryUpdateRequest;
use Illuminate\Support\Str;
use Image;
use App\Helpers\helper as Helper;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.story.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        $stories = Story::select('id','name_en','description_en','story_image')->get();
        return view('admin.story.listing', compact('stories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
        $slug = Str::slug($request->name, '-');

        if(isset($request['story_image'])){

            $story_image = Helper::upload_image($request->file('story_image'));

        }else{
            $story_image = NULL ;
        }

        $story = new Story();
        if(isset($request['our_story'])){
            $story->our_story = 1 ;
        }else{
            $story->our_story = 0 ;
        }
        if(isset($request['success_story'])){
            $story->success_story = 1 ;
        }
        if(isset($request['news'])){
            $story->news = 1 ;
        }

        $story->story_image = $story_image;
        $story->name_en = $request->name;
        $story->slug = $slug;
        $story->description_en = $request->description;
        $story->meta_title = $request->meta_title;
        $story->meta_keyword = $request->meta_keyword;
        $story->meta_description = $request->meta_description;
        $story->save();

        return back()->with('success', 'Record has been added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story, $id)
    {   
        $record = $story::select('id','name_en','description_en','story_image','our_story','success_story','news','meta_title','meta_keyword','meta_description')->whereId($id)->first();
        if($record != false){
            return view('admin.story.edit', compact('record'));
        }else{
            abort(404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(StoryUpdateRequest $request, Story $story)
    {
        $story = Story::find($request['id']);
        $slug = Str::slug($request->name, '-');

        if(isset($request['our_story'])){
            $our_story = 1 ;
        }else{
            $our_story = 0 ;
        }
        if(isset($request['success_story'])){
            $success_story = 1 ;
        }else{
            $success_story = 0 ;
        }
        if(isset($request['news'])){
            $news = 1 ;
        }else{
            $news = 0 ;
        }

        if(isset($request['story_image'])){

            $story_image = Helper::upload_image($request->file('story_image'));

            $data = array(
                'name_en'               => $request['name'],
                'slug'               => $slug,
                'story_image'        => $story_image,
                'description_en'        => $request['description'],
                'our_story'          => $our_story,
                'success_story'      => $success_story,
                'news'               => $news,
                'meta_title'         => $request['meta_title'],
                'meta_keyword'       => $request['meta_keyword'],
                'meta_description'   => $request['meta_description'],
            );

        }else{
            $data = array(
                'name_en'               => $request['name'],
                'slug'               => $slug,
                'description_en'        => $request['description'],
                'our_story'          => $our_story,
                'success_story'      => $success_story,
                'news'               => $news,
                'meta_title'         => $request['meta_title'],
                'meta_keyword'       => $request['meta_keyword'],
                'meta_description'   => $request['meta_description'],
            );

        }

        $story->update($data);
        return redirect(route('admin.story.listing'))->with('success', 'Record has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        Story::where('id', request()->id )->delete();
        return back()->with('success', 'Record has been deleted successfully.');
    }
}
