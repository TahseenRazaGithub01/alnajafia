@extends('layouts.admin')

@section('css')
<!-- <link rel="stylesheet" href="{{ url('assets/css/datepicker.css') }}"> -->
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #f44336;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection

@section('content')
		<!-- ### $App Screen Content ### -->
		<main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="full-container">
              <div class="email-app">
              <div class="email-side-nav remain-height ov-h">
                <div class="h-100 layers">
                  <div class="p-20 bgc-grey-100 layer w-100">
                    <a href="{{ route('admin.islamic_detail.listing') }}" class="btn btn-danger btn-block">View Islamic Pages</a>
                  </div>
                  <div class="scrollable pos-r bdT layer w-100 fxg-1">
                    <ul class="p-20 nav flex-column">
                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link c-grey-800 cH-blue-500 actived">
                          <div class="peers ai-c jc-sb">
                            <div class="peer peer-greed">
                              <i class="mR-10 ti-email"></i>
                              <span>Go Back</span>
                            </div>
                            <div class="peer">
                              <span class="badge badge-pill bgc-deep-purple-50 c-deep-purple-700">+99</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Add Msg Here -->
              @if(session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div> 
              @endif
              @if (count($errors) > 0)
              <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              <!-- Close Msg Here -->
              <div class="email-wrapper row remain-height pos-r scrollable bgc-white">
                <div class="email-content open no-inbox-view">
                  <div class="email-compose">
                    <div class="d-n@md+ p-20">
                      <a class="email-side-toggle c-grey-900 cH-blue-500 td-n" href="javascript:void(0)">
                        <i class="ti-menu"></i>
                      </a>
                    </div>
                    <form method="post" action="{{ route('admin.islamic_detail.store') }}" enctype="multipart/form-data" class="email-compose-body">
                      @csrf
                      <h4 class="c-grey-900 mB-20">Add Islamic Page</h4>
                      <div class="send-header">
                        <div class="form-group">
                          <input type="text" required="required" class='form-control' name="detail_name_en" placeholder="Name">
                        </div>
						
						<div class="form-group">
							<label for="inputState">Category</label>
							<select id="inputState" name="category_id" class="form-control">
							@foreach($categories as $id => $category)
								<option value="{{ $id }}">{{ $category }}</option>
							@endforeach
							</select>
						</div>
                        
                        
                      </div>
                      <div id="compose-area"></div>

                      <!-- ckEditor -->
                      <div class="form-group">
                          <textarea name="description_en" class="form-control" placeholder="Description..." rows='10'></textarea>
                        </div>
                      <!-- ckEditor -->
					  
					  <div class="form-group">
						  <input type="file" required="required" class="form-control" id="page_image" name="page_image"
							aria-describedby="inputGroupFileAddon01">
						  <label class="custom-file-label" for="inputGroupFile01">Upload Image</label>
					  </div>
					  
					  <br>
					  <div class="form-group">
						  <input type="file" required="required" class="form-control" id="banner_image" name="banner_image"
							aria-describedby="inputGroupFileAddon01">
						  <label class="custom-file-label" for="inputGroupFile01">Upload Banner Image</label>
					  </div>

					  <hr>
                      <h4>Donation Process</h4>
                      <br>
					  
					  <input class="subcategory_options2" type="checkbox" name="min_amount" value="1" onchange="valueChanged2()"/> Amount

                      <div class="check_box_area2" style="display:none;">
                          <br/>
                          <input type="text" maxlength="10" id="min_value" name="min_value" /> Min Amount Value

                      </div> <!-- Donation Process class div hide and show box -->
					  
					  <br/>
                      <input class="subcategory_options3" type="checkbox" name="recurring" value="1" onchange="valueChanged3()"/> Recurring

                      <div class="check_box_area3" style="display:none;">
                          <br/>
                          <input type="checkbox" id="monthly" name="monthly" value="1" /> Monthly

                          <br/>
                          <input type="checkbox" id="quarterly" name="quarterly" value="1" /> Quarterly

                          <br/>
                          <input type="checkbox" id="half_yearly" name="half_yearly" value="1" /> Half Yearly

                          <br/>
                          <input type="checkbox" id="yearly" name="yearly" value="1" /> Yearly

                      </div> <!-- Donation Process class div hide and show box -->
					  
					  <br/>
                      <input type="checkbox" name="year_around" value="1" /> Year Around
					  
					  <br/>
                      <input type="checkbox" name="marhomeen" value="1" /> Marhomeen
					  
					  <br/>
                      <input type="checkbox" name="calender" value="1" /> Calendar
					  
					  <br/>
                      <input type="checkbox" name="syed" value="1" /> Syed
					  
					  <br/>
                      <input class="subcategory_options4" type="checkbox" name="fixed_amount" value="1" onchange="valueChanged4()"/> Fixed Amount

                      <div class="check_box_area4" style="display:none;">
                          <br/>
                          <input type="text" maxlength="10" id="fixed_amount_value" name="fixed_amount_value" /> Fixed Amount Value

                      </div> <!-- Donation Process class div hide and show box -->
					  
					  <br/>
                      <input class="subcategory_options5" type="checkbox" name="duration" value="1" onchange="valueChanged5()"/> Duration					  
					  
					  <div class="check_box_area5" style="display:none;">

                          <br/>
                          <input type="date" id="start_duration_date" name="start_duration_date"> Start Date
                          

                          <br/>
                          <input type="date" id="end_duration_date" name="end_duration_date"> End Date

                      </div> <!-- Donation Process class div hide and show box -->
					  
					  <br/>
                      <input class="subcategory_options6" type="checkbox" name="count_number" value="1" onchange="valueChanged6()"/> Count

                      <div class="check_box_area6" style="display:none;">
                          <br/>
                          <input type="text" id="min_count" name="min_count" /> Min

                          <br/>
                          <input type="text" id="max_count" name="max_count" /> Max

                      </div> <!-- Donation Process class div hide and show box -->
					  
					  
                      
                      <hr>
                      <h3> Seo Section </h3>

                      <div class="form-group">
                        <input type="text" class='form-control' name="meta_title" placeholder="Meta Title">
                      </div>
                      <div class="form-group">
                        <input type="text" class='form-control' name="meta_keyword" placeholder="Meta Keyword">
                      </div>
                      <div class="form-group">
                        <input type="text" class='form-control' name="meta_description" placeholder="Meta Description">
                      </div>
					  
					  <label class="switch">
                          <input type="checkbox" name="page_status" checked >
                          <span class="slider round"></span>
                      </label>
						

                      <div class="text-right mrg-top-30">
                        <button type="submit" class="btn btn-danger">Save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </main>

@endsection

@section('js')

<script src="{{ url('assets/js/jquery-min.js') }}" type="text/javascript"></script>
<!-- <script src="{{ url('assets/js/jquery-datepicker.js') }}"></script> -->

<script src="http://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'description_en', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
	
	function valueChanged2(){
			if($('.subcategory_options2').is(":checked"))   
				$(".check_box_area2").show();
			else
				$(".check_box_area2").hide();
	  }
	  
	function valueChanged3(){
		if($('.subcategory_options3').is(":checked"))   
			$(".check_box_area3").show();
		else
			$(".check_box_area3").hide();
	}
	function valueChanged4(){
        if($('.subcategory_options4').is(":checked"))   
            $(".check_box_area4").show();
        else
            $(".check_box_area4").hide();
    }
	  function valueChanged5(){
			if($('.subcategory_options5').is(":checked"))   
				$(".check_box_area5").show();
			else
				$(".check_box_area5").hide();
	  }

	  function valueChanged6(){
			if($('.subcategory_options6').is(":checked"))   
				$(".check_box_area6").show();
			else
				$(".check_box_area6").hide();
	  }
  
</script>

@endsection
