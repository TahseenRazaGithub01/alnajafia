@extends('layouts.admin')

@section('content')
          <!-- start datatable here -->
          <main class='main-content bgc-grey-100'>
          <div id='mainContent'>

        @if(session('success'))
		      <div class="alert alert-success">
		        {{ session('success') }}
		      </div> 
		    @endif

            <div class="container-fluid">
              <!-- <h4 class="c-grey-900 mT-10 mB-30">Data Tables</h4> -->
              <div class="row">
                <div class="col-md-12">
                  <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20">Gallery</h4>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Youtube Url</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Youtube Url</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach($gallery as $record)
                          <tr>
                            <td>{{ $record->title }}</td>
                            <td>
                              @if($record->gallery_image > 0)
                              <img src="{{ url('/thumbnail/') }}/{{ $record->gallery_image }}" width="50px;" height="50px;">
                              @else
                              &nbsp;
                              @endif
                            </td>
                            <td>{{ str_limit($record->youtube_url, 40) }}</td>
                            <td><a href="{{ url('admin/gallery/edit') }}/{{ $record->id }}" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a> |
                            	<a href="{{ url('admin/gallery/delete') }}/{{ $record->id }}" title="Remove" onclick="return confirm('you want to delete?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>

@endsection
