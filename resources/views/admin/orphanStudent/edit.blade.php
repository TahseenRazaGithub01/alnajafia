@extends('layouts.admin')

@section('content')
    <!-- ### $App Screen Content ### -->
    <main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="full-container">
              <div class="email-app">
              <div class="email-side-nav remain-height ov-h">
                <div class="h-100 layers">
                  <div class="p-20 bgc-grey-100 layer w-100">
                    <a href="{{ route('admin.orphan.student.listing') }}" class="btn btn-danger btn-block">View Orphan Students</a>
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
                    <form method="post" action="{{ route('admin.orphan.student.update') }}" enctype="multipart/form-data" class="email-compose-body">
                      @csrf

                      <input type="hidden" name="id" value="{{ $record->id }}">
                      <h4 class="c-grey-900 mB-20">Edit Orphan Student</h4>
                      <div class="send-header">
                        <div class="form-group">
                          <input type="text" required="required" class='form-control' name="name" value="{{ $record->name_en }}" placeholder="Name">
                        </div>

                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" <?php if($record->gender == "male"){ echo 'checked'; } ?> name="gender" value="male">Male
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <input type="radio" class="form-check-input" <?php if($record->gender == "female"){ echo 'checked'; } ?> name="gender" value="female">Female
                          </label>
                        </div>

                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" <?php if($record->orphan_type == "basic"){ echo 'checked'; } ?> name="orphan_type" value="basic">Basic Care
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <input type="radio" class="form-check-input" <?php if($record->orphan_type == "zehra"){ echo 'checked'; } ?> name="orphan_type" value="zehra">Dar Al Zehra
                          </label>
                        </div>

                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" <?php if($record->cast == "syed"){ echo 'checked'; } ?> name="cast" value="syed">Syed
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <input type="radio" class="form-check-input" <?php if($record->cast == "non-syed"){ echo 'checked'; } ?> name="cast" value="non-syed">Non Syed
                          </label>
                        </div>

                        <div class="form-group">
                          <input type="date" required="required" class='form-control' name="date_of_birth">
                        </div>

                        <div class="form-group">
                          <input type="text" required="required" class='form-control' value="{{ $record->orphan_profile_id }}" name="orp_profile_id" placeholder="897601">
                        </div>

                        <div class="form-group">
                          <input type="text" class='form-control' value="{{ $record->city }}" name="city" placeholder="City">
                        </div>

                        <div class="form-group">
                          <input type="text" class='form-control' value="{{ $record->mother_name }}" name="mother_name" placeholder="Mother Name">
                        </div>

                        <div class="form-group">
                          <input type="file" class="form-control" id="orphan_profile_picture" name="orphan_profile_picture"
                            aria-describedby="inputGroupFileAddon01">
                          <label class="custom-file-label" for="inputGroupFile01">Orphan Profile Image</label>
                        </div>

                        <div class="form-group">
                          <img src="{{ url('/thumbnail/') }}/{{ $record->orphan_profile_picture }}" width="100px;" height="100px;"></td>
                        </div>
                        
                      </div>
                      
                      <div class="text-right mrg-top-30">
                        <button type="submit" class="btn btn-danger">Update</button>
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
