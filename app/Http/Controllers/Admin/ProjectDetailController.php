<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProjectDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectDetailRequest;
use App\Http\Requests\ProjectDetailUpdateRequest;
use Illuminate\Support\Str;
use Image;
use App\Helpers\helper as Helper;

class ProjectDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.projectDetail.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectDetailRequest $request)
    {

        $slug = Str::slug($request->project_name_en, '-');

        $subcategory_options = (isset($request->subcategory_options) ? $request->subcategory_options : 0 );
        $wheel_chair = (isset($request->wheel_chair) ? $request->wheel_chair : 0 );
        $general_fund = (isset($request->general_fund) ? $request->general_fund : 0 );
        $education_phd = (isset($request->education_phd) ? $request->education_phd : 0 );
        $education_master = (isset($request->education_master) ? $request->education_master : 0 );
        $cart = (isset($request->cart) ? $request->cart : 0 );
        $eye_cataract = (isset($request->eye_cataract) ? $request->eye_cataract : 0 );
        $aun = (isset($request->aun) ? $request->aun : 0 );
		
        $donation_process = (isset($request->donation_process) ? $request->donation_process : 0 );
        $recurring = (isset($request->recurring) ? $request->recurring : 0 );
        $monthly = (isset($request->monthly) ? $request->monthly : 0 );
        $quarterly = (isset($request->quarterly) ? $request->quarterly : 0 );
        $half_yearly = (isset($request->half_yearly) ? $request->half_yearly : 0 );
        $yearly = (isset($request->yearly) ? $request->yearly : 0 );
        $year_around = (isset($request->year_around) ? $request->year_around : 0 );
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

        $checkSlug = ProjectDetail::select('id','slug')->whereSlug($slug)->first();

        if($checkSlug != false){

            $id = ProjectDetail::select('id')->orderBy('id', 'desc')->first()->toArray();
            $number = $id['id'] + 1 ;
            $slug = $slug.$number;

        }

        if(isset($request['project_image'])){

            $project_image = Helper::upload_image($request->file('project_image'));

        }else{
            $project_image = NULL ;
        }

        if(isset($request['project_banner_image'])){

            $project_banner_image = Helper::upload_image_for_banner($request->file('project_banner_image'));

        }else{
            $project_banner_image = NULL ;
        }

        $projectDetail = new ProjectDetail();

        $projectDetail->project_name_en = $request->project_name_en;
        $projectDetail->slug = $slug;
        $projectDetail->project_description_en = $request->project_description;
        $projectDetail->project_image = $project_image;
        $projectDetail->project_banner_image = $project_banner_image;
        $projectDetail->subcategory_options = $subcategory_options;
        $projectDetail->wheel_chair = $wheel_chair;
        $projectDetail->general_fund = $general_fund;
        $projectDetail->education_phd = $education_phd;
        $projectDetail->education_master = $education_master;
        $projectDetail->cart = $cart;
        $projectDetail->eye_cataract = $eye_cataract;
        $projectDetail->aun = $aun;
		
        $projectDetail->donation_process = $donation_process;
		$projectDetail->min_amount = $request->min_amount;
		$projectDetail->recurring = $recurring;
		$projectDetail->monthly = $monthly;
		$projectDetail->quarterly = $quarterly;
		$projectDetail->half_yearly = $half_yearly;
		$projectDetail->yearly = $yearly;
		$projectDetail->year_around = $year_around;
		$projectDetail->fixed_amount = $fixed_amount;
		$projectDetail->fixed_amount_value = $request->fixed_amount_value;
		$projectDetail->duration = $duration;
		$projectDetail->start_duration_date = $start_duration_date;
		$projectDetail->end_duration_date = $end_duration_date;
		$projectDetail->count_number = $count_number;
		$projectDetail->min_count = $request->min_count;
		$projectDetail->max_count = $request->max_count;
		
        $projectDetail->meta_title = $request->meta_title;
        $projectDetail->meta_keyword = $request->meta_keyword;
        $projectDetail->meta_description = $request->meta_description;
        $projectDetail->save();

        return back()->with('success', 'Record has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectDetail  $projectDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectDetail $projectDetail)
    {
        $projectDetail = ProjectDetail::select('id','project_name_en','project_description_en','project_image','project_status')->get();
        return view('admin.projectDetail.listing', compact('projectDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectDetail  $projectDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectDetail $projectDetail, $id)
    {
        $record = $projectDetail::whereId($id)->first();
        if($record != false){
            return view('admin.projectDetail.edit', compact('record'));
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectDetail  $projectDetail
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectDetailUpdateRequest $request, ProjectDetail $projectDetail)
    {
        $projectDetail = projectDetail::find($request['id']);

        $slug = Str::slug($request->project_name_en, '-');

        $checkSlug = ProjectDetail::select('id','slug')->whereSlug($slug)->where('id', '!=' , $request['id'])->first();

        if($checkSlug != false){

            $slug = $slug.$request['id'];

        }

        $subcategory_options = (isset($request->subcategory_options) ? $request->subcategory_options : 0 );
        $wheel_chair = (isset($request->wheel_chair) ? $request->wheel_chair : 0 );
        $general_fund = (isset($request->general_fund) ? $request->general_fund : 0 );
        $education_phd = (isset($request->education_phd) ? $request->education_phd : 0 );
        $education_master = (isset($request->education_master) ? $request->education_master : 0 );
        $cart = (isset($request->cart) ? $request->cart : 0 );
        $eye_cataract = (isset($request->eye_cataract) ? $request->eye_cataract : 0 );
        $aun = (isset($request->aun) ? $request->aun : 0 );
		
		$donation_process = (isset($request->donation_process) ? $request->donation_process : 0 );
        $recurring = (isset($request->recurring) ? $request->recurring : 0 );
        $monthly = (isset($request->monthly) ? $request->monthly : 0 );
        $quarterly = (isset($request->quarterly) ? $request->quarterly : 0 );
        $half_yearly = (isset($request->half_yearly) ? $request->half_yearly : 0 );
        $yearly = (isset($request->yearly) ? $request->yearly : 0 );
        $year_around = (isset($request->year_around) ? $request->year_around : 0 );
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

        if(isset($request['project_banner_image'])){

            $imageName = Helper::upload_image_for_banner($request->file('project_banner_image'));

            $data = array(
                'project_banner_image'        => $imageName,
            );
            $projectDetail->update($data);
        }

        if(isset($request['project_image'])){

            $imageName = Helper::upload_image($request->file('project_image'));

            $data = array(
                'project_image'        => $imageName,
            );
            $projectDetail->update($data);
        }

        $data = array(
            'project_name_en'                => $request['project_name_en'],
            'slug'                           => $slug,
            'project_description_en'         => $request['project_description'],
            'subcategory_options' => $subcategory_options,
            'wheel_chair' => $wheel_chair,
            'general_fund' => $general_fund,
            'education_phd' => $education_phd,
            'education_master' => $education_master,
            'cart' => $cart,
            'eye_cataract' => $eye_cataract,
            'aun' => $aun,
			
			'donation_process' => $donation_process,
			'min_amount' => $request['min_amount'],
			'recurring' => $recurring,
			'monthly' => $monthly,
			'quarterly' => $quarterly,
			'half_yearly' => $half_yearly,
			'yearly' => $yearly,
			'year_around' => $year_around,
			'fixed_amount' => $fixed_amount,
			'fixed_amount_value' => $request['fixed_amount_value'],
			'duration' => $duration,
			'start_duration_date' => $start_duration_date,
			'end_duration_date' => $end_duration_date,
			'count_number' => $count_number,
			'min_count' => $request['min_count'],
			'max_count' => $request['max_count'],
		
            'meta_title'                     => $request['meta_title'],
            'meta_keyword'                   => $request['meta_keyword'],
            'meta_description'               => $request['meta_description'],
        );
		
        $projectDetail->update($data);
        return redirect(route('admin.project_detail.listing'))->with('success', 'Record has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectDetail  $projectDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectDetail $projectDetail)
    {
        ProjectDetail::where('id', request()->id )->delete();
        return back()->with('success', 'Record has been deleted successfully.');
    }
	public function upload(Request $request){
		if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
      
            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
 
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore); 
            $msg = 'Image successfully uploaded'; 
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
             
            // Render HTML output 
            @header('Content-type: text/html; charset=utf-8'); 
            echo $re;
        }
	}
}
