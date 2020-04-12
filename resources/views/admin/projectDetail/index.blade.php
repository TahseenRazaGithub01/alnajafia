@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ url('assets/css/datepicker.css') }}">
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
                    <a href="{{ route('admin.project_detail.listing') }}" class="btn btn-danger btn-block">View Project Detail</a>
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
                    <form method="post" action="{{ route('admin.project_detail.store') }}" enctype="multipart/form-data" class="email-compose-body">
                      @csrf
                      <h4 class="c-grey-900 mB-20">Add New Project</h4>
                      <div class="send-header">
                        <div class="form-group">
                          <input type="text" required="required" class='form-control' id="project_name" name="project_name_en" placeholder="Name">
                        </div>

                        <div class="form-group">
                          <input type="file" class="form-control" id="project_banner_image" name="project_banner_image"
                            aria-describedby="inputGroupFileAddon01">
                          <label class="custom-file-label" for="inputGroupFile01">Upload Banner Image</label>
                        </div>

                        <div class="form-group">
                          <input type="file" class="form-control" id="project_image" name="project_image"
                            aria-describedby="inputGroupFileAddon01">
                          <label class="custom-file-label" for="inputGroupFile01">Upload Image</label>
                        </div>
                        <div class="form-group">
                          <textarea name="project_description" class="form-control" placeholder="Description..." rows='10'></textarea>
                        </div>
                      </div>
                      <div id="compose-area"></div>

                      <!-- ckEditor -->
                      <div class="form-group">
                          <textarea name="project_description_second" class="form-control" placeholder="Description..." rows='10'></textarea>
                        </div>
                      <!-- ckEditor -->

                      <input class="subcategory_options" type="checkbox" name="subcategory_options" value="1" onchange="valueChanged()"/> Caculator Options


                      <div class="check_box_area" style="display:none;">
                          <br/>
                          <input type="checkbox" id="wheel_chair" name="wheel_chair" value="1" /> Wheel Chair

                          <br/>
                          <input type="checkbox" id="general_fund" name="general_fund" value="1" /> General Fund (MC)

                          <br/>
                          <input type="checkbox" id="education_phd" name="education_phd" value="1" /> PhD (2.5 Years)

                          <br/>
                          <input type="checkbox" id="education_master" name="education_master" value="1" /> Masters (2 Years)

                          <br/>
                          <input type="checkbox" id="cart" name="cart" value="1" /> Cart

                          <br/>
                          <input type="checkbox" id="eye_cataract" name="eye_cataract" value="1" /> Eye cataract

                          <br/>
                          <input type="checkbox" id="aun" name="aun" value="1" /> Aun
                        

                      </div> <!-- class div hide and show box -->

                      <hr>
                      <h4>Donation Process</h4>
                      <br>

                      <input class="subcategory_options2" type="checkbox" name="donation_process" value="1" onchange="valueChanged2()"/> Donation Process

                      <div class="check_box_area2" style="display:none;">
                          <br/>
                          <input type="text" maxlength="10" id="min_amount" name="min_amount" /> Min Amount

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
                      <input class="subcategory_options4" type="checkbox" name="fixed_amount" value="1" onchange="valueChanged4()"/> Fixed Amount

                      <div class="check_box_area4" style="display:none;">
                          <br/>
                          <input type="text" maxlength="10" id="fixed_amount_value" name="fixed_amount_value" /> Fixed Amount Value

                      </div> <!-- Donation Process class div hide and show box -->

                      <br/>
                      <input class="subcategory_options5" type="checkbox" name="duration" value="1" onchange="valueChanged5()"/> Duration

                      <div class="check_box_area5" style="display:none;">

                          <br/>
                          <!-- <div class="jquery-datepicker">
                            <input type="text" class="jquery-datepicker__input" id="start_duration_date" name="start_duration_date"> Start Date
                          </div> -->

                          <input type="date" id="start_duration_date" name="start_duration_date"> Start Date
                          

                          <br/>
                          <input type="date" class="jquery-datepicker__input" id="end_duration_date" name="end_duration_date"> End Date

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
                      <h4> Seo Section </h4>

                      <div class="form-group">
                        <input type="text" class='form-control' name="meta_title" placeholder="Meta Title">
                      </div>
                      <div class="form-group">
                        <input type="text" class='form-control' name="meta_keyword" placeholder="Meta Keyword">
                      </div>
                      <div class="form-group">
                        <input type="text" class='form-control' name="meta_description" placeholder="Meta Description">
                      </div>

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
<script src="{{ url('assets/js/jquery-datepicker.js') }}"></script>

<script src="http://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'project_description', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>

<script type="text/javascript">
  function valueChanged(){
        if($('.subcategory_options').is(":checked"))   
            $(".check_box_area").show();
        else
            $(".check_box_area").hide();
  }

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

  $('.jquery-datepicker').datepicker();



</script>

@endsection
