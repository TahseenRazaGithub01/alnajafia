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
                    <h4 class="c-grey-900 mB-20">Secretory General</h4>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Banner Image</th>
                            <th>Title</th>
                            <th>Message Image</th>
                            <th>Description</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Banner Image</th>
                            <th>Title</th>
                            <th>Message Image</th>
                            <th>Description</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach($secratoryGeneral as $record)
                          <tr>
                            <td><img src="{{ url('/thumbnail/') }}/{{ $record->banner_image }}" width="150px;" height="50px;"></td>
                            <td>{{ $record->title_en }}</td>
                            <td><img src="{{ url('/thumbnail/') }}/{{ $record->message_image }}" width="50px;" height="50px;"></td>
                            
                            <td>{{ str_limit($record->message_description_en, 100) }}</td>
                            <td><a href="{{ url('admin/secratory_general/edit') }}/{{ $record->id }}" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
