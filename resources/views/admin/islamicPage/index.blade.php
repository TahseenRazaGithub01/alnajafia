@extends('layouts.admin')

@section('css')
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
                    <a href="{{ route('admin.islamic_page.listing') }}" class="btn btn-danger btn-block">View Islamic Pages</a>
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
                    <form method="post" action="{{ route('admin.islamic_page.store') }}" enctype="multipart/form-data" class="email-compose-body">
                      @csrf
                      <h4 class="c-grey-900 mB-20">Add Islamic Page</h4>
                      <div class="send-header">
                        <div class="form-group">
                          <input type="text" required="required" class='form-control' name="detail_name_en" placeholder="Name">
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
					  
					  <input class="subcategory_options2" type="checkbox" name="khums" value="1" onchange="valueChanged2()"/> Khum's

                      <div class="check_box_area2" style="display:none;">
                          
                          <br/><input type="checkbox" id="sistani" name="sistani" value="1" /> Grand Ayatollah Sayyid Ali al Husseini al Sistani
                          <br/><input type="checkbox" id="khamenei" name="khamenei" value="1" /> Grand Ayatollah Sayyid Ali al Hosseini al Khamenei
                          <br/><input type="checkbox" id="najafy" name="najafy" value="1" /> Grand Ayatollah Sheikh Basheer Hussein al Najafy
                          <br/><input type="checkbox" id="khorasani" name="khorasani" value="1" /> Grand Ayatollah Sheikh Husayn Vahid al Khorasani
                          <br/><input type="checkbox" id="fayyadh" name="fayyadh" value="1" /> Grand Ayatollah Sheikh Mohammad Ishaq al Fayyadh
                          <br/><input type="checkbox" id="hakeem" name="hakeem" value="1" /> Grand Ayatollah Sayyid Mohammed Saeed al Hakeem

                      </div>
					  
					  
					  
					  <br/>
                      <input class="subcategory_options3" type="checkbox" name="niaz" value="1" onchange="valueChanged3()"/> Niaz

                      <div class="check_box_area3" style="display:none;">
                          
						  <br/><input type="checkbox" id="general_niaz" name="general_niaz" value="1" /> General Niyaz
						  <br/><input type="checkbox" id="muharram" name="muharram" value="1" /> Muharram
						  <br/><input type="checkbox" id="ashura" name="ashura" value="1" /> Ashura
						  <br/><input type="checkbox" id="shahadat_imam_hussain_as" name="shahadat_imam_hussain_as" value="1" /> Shahadat of Imam Hassan (as)
						  <br/><input type="checkbox" id="arbaeen" name="arbaeen" value="1" /> Arbaeen
						  <br/><input type="checkbox" id="shahadat_holy_prophet_pbuh" name="shahadat_holy_prophet_pbuh" value="1" /> Shahadat of Holy Prophet (PBUH)
						  <br/><input type="checkbox" id="wiladat_holy_prophet_pbuh" name="wiladat_holy_prophet_pbuh" value="1" /> Wiladat of Holy Prophet (PBUH)
						  <br/><input type="checkbox" id="shahadat_sayyida_fatima_sa" name="shahadat_sayyida_fatima_sa" value="1" /> Shahadat of Sayyida Fatimah (sa)
						  <br/><input type="checkbox" id="wiladat_sayyida_fatima_sa" name="wiladat_sayyida_fatima_sa" value="1" /> Wiladat of Sayyida Fatimah (sa)
						  <br/><input type="checkbox" id="wiladat_imam_ali_as" name="wiladat_imam_ali_as" value="1" /> Wiladat of Imam Ali (as)
						  <br/><input type="checkbox" id="wiladat_imam_hussain_as" name="wiladat_imam_hussain_as" value="1" /> Wiladat of Imam Hussain (as)
						  <br/><input type="checkbox" id="wiladat_abul_fadhl_as" name="wiladat_abul_fadhl_as" value="1" /> Wiladat of Abul Fadhl Al Abbas (as)
						  <br/><input type="checkbox" id="wiladat_imam_mahdi_as" name="wiladat_imam_mahdi_as" value="1" /> Wiladat of Imam al Mahdi (as)
						  <br/><input type="checkbox" id="wiladat_imam_hassan_as" name="wiladat_imam_hassan_as" value="1" /> Wiladat of Imam Hassan (as)
						  <br/><input type="checkbox" id="night_of_injury_imam_ali_as" name="night_of_injury_imam_ali_as" value="1" /> Night of injury of Imam Ali (as)
						  <br/><input type="checkbox" id="shahadat_imam_ali_as" name="shahadat_imam_ali_as" value="1" /> Shahadat of Imam Ali (as)
						  <br/><input type="checkbox" id="night_of_qadr" name="night_of_qadr" value="1" /> Night of Qadr (Destiny)
						  <br/><input type="checkbox" id="eid_al_ghadeer" name="eid_al_ghadeer" value="1" /> Eid Al Ghadeer
						  <br/><input type="checkbox" id="eid_al_mubahilah" name="eid_al_mubahilah" value="1" /> Eid Al Mubahilah
						  <br/><input type="checkbox" id="other" name="other" value="1" /> Other

                      </div>
					  
					  <br/>
                      <input class="subcategory_options4" type="checkbox" name="donation_of_holy_shrines" value="1" onchange="valueChanged4()"/> Donations for Holy Shrines

                      <div class="check_box_area4" style="display:none;">
                          
						  <br/><input type="checkbox" id="shrine_of_imam_ali_as" name="shrine_of_imam_ali_as" value="1" /> Shrine of Imam Ali (as)
						  <br/><input type="checkbox" id="shrine_of_imam_hussain_as" name="shrine_of_imam_hussain_as" value="1" /> Shrine of Imam Hussain (as)
						  <br/><input type="checkbox" id="shrine_of_abul_fadhl_as" name="shrine_of_abul_fadhl_as" value="1" /> Shrine of Abul Fadhl al Abbas (as)
						  <br/><input type="checkbox" id="shrine_of_imam_musa_as" name="shrine_of_imam_musa_as" value="1" /> Shrine of Imam Musa al kadhim (as) & Imam Muhammad al Jawad
						  <br/><input type="checkbox" id="shrine_of_imam_al_hadi_as" name="shrine_of_imam_al_hadi_as" value="1" /> Shrine of Imam al Hadi (as) & Imam al Askari (as)
						  <br/><input type="checkbox" id="shrine_of_sayyid_muhammad" name="shrine_of_sayyid_muhammad" value="1" /> Shrine of Sayyid Muhammad Balad (as)
						  <br/><input type="checkbox" id="masjid_al_kufa" name="masjid_al_kufa" value="1" /> Masjid al Kufa
						  <br/><input type="checkbox" id="masjid_al_sahlah" name="masjid_al_sahlah" value="1" /> Masjid al Sahlah

                      </div>
                      
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
