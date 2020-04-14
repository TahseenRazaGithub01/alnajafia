<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrphanStudent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrphanStudentRequest;
use App\Http\Requests\OrphanStudentUpdateRequest;
use Illuminate\Support\Str;
use Image;
use App\Helpers\helper as Helper;

class OrphanStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.orphanStudent.index');
    }
	
	/**
     * Display the specified resource.
     *
     * @param  \App\OrphanStudent  $orphanStudent
     * @return \Illuminate\Http\Response
     */
    public function show(OrphanStudent $orphanStudent)
    {
        $orphanStudent = OrphanStudent::select('id','name_en','gender','orphan_type','cast','orphan_profile_picture','student_status')->get();
        return view('admin.orphanStudent.listing', compact('orphanStudent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrphanStudentRequest $request)
    {

        if(isset($request['student_status'])){

            if($request['student_status'] == "on"){

                $request['student_status'] = 1 ;

            }

        }else{

            $request['student_status'] = 0 ;
        } 

        if(isset($request['gender'])){
            if($request['gender'] == "male"){
                $gender = "male";
            }else{
                $gender = "female";
            }
        }

        if(isset($request['orphan_type'])){
            if($request['orphan_type'] == "basic"){
                $orphan_type = "basic";
            }else{
                $orphan_type = "zehra";
            }
        }

        if(isset($request['cast'])){
            if($request['cast'] == "syed"){
                $cast = "syed";
            }else{
                $cast = "non-syed";
            }
        }

        if(isset($request['date_of_birth'])){
            $date_of_birth = $request['date_of_birth'] ;              
        }else{
            $date_of_birth = NULL;
        }

        if(isset($request['orphan_profile_picture'])){

            $orphan_profile_picture = Helper::upload_image($request->file('orphan_profile_picture'));

        }else{
            $orphan_profile_picture = NULL ;
        }

        $orphanStudent = new OrphanStudent();

        $orphanStudent->name_en = $request->name;
        $orphanStudent->gender = $gender;
        $orphanStudent->orphan_type = $orphan_type;
        $orphanStudent->cast = $cast;
        $orphanStudent->date_of_birth = $date_of_birth;
        $orphanStudent->orphan_profile_id = $request->orp_profile_id;
        $orphanStudent->city = $request->city;
        $orphanStudent->mother_name = $request->mother_name;
        $orphanStudent->orphan_profile_picture = $orphan_profile_picture;
        $orphanStudent->student_status = $request->student_status;
        
        $orphanStudent->save();

        return back()->with('success', 'Record has been added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrphanStudent  $orphanStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(OrphanStudent $orphanStudent, $id)
    {
        $record = $orphanStudent::whereId($id)->first();
        if($record != false){
            return view('admin.orphanStudent.edit', compact('record'));
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrphanStudent  $orphanStudent
     * @return \Illuminate\Http\Response
     */
    public function update(OrphanStudentUpdateRequest $request, OrphanStudent $orphanStudent)
    {
        $OrphanStudent = OrphanStudent::find($request['id']);

        if(isset($request['orphan_profile_picture'])){

            $orphan_profile_picture = Helper::upload_image($request->file('orphan_profile_picture'));

            $data = array(
                'orphan_profile_picture'        => $orphan_profile_picture,
            );
            $OrphanStudent->update($data);

        }

        if(isset($request['student_status'])){

            if($request['student_status'] == "on"){

                $request['student_status'] = 1 ;

            }

        }else{

            $request['student_status'] = 0 ;
        }

        if(isset($request['gender'])){
            if($request['gender'] == "male"){
                $gender = "male";
            }else{
                $gender = "female";
            }
        }

        if(isset($request['orphan_type'])){
            if($request['orphan_type'] == "basic"){
                $orphan_type = "basic";
            }else{
                $orphan_type = "zehra";
            }
        }

        if(isset($request['cast'])){
            if($request['cast'] == "syed"){
                $cast = "syed";
            }else{
                $cast = "non-syed";
            }
        }

        if(isset($request['date_of_birth'])){

            $date_of_birth = $request['date_of_birth'] ;   

        }

        $data = array(
            'name_en'                           => $request['name'],
            'gender'                            => $gender,
            'orphan_type'                       => $orphan_type,
            'cast'                              => $cast,
            'date_of_birth'                     => $date_of_birth,
            'orphan_profile_id'                 => $request['orp_profile_id'],
            'city'                              => $request['city'],
            'mother_name'                       => $request['mother_name'],
            'student_status'                    => $request['student_status'],
        );
        
        $OrphanStudent->update($data);
        return redirect(route('admin.orphan.student.listing'))->with('success', 'Record has been updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrphanStudent  $orphanStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrphanStudent $orphanStudent)
    {
        OrphanStudent::where('id', request()->id )->delete();
        return back()->with('success', 'Record has been deleted successfully.');
    }
}
