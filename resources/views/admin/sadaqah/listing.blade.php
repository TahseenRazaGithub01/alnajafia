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
                    <h4 class="c-grey-900 mB-20">Sadaqah Pages Table</h4>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach($sadaqah as $detail)
                          <tr>
                            <td>{{ $detail['detail_name_en'] }}</td>
							<td><img src="{{ url('/thumbnail/') }}/{{ $detail['detail_page_image'] }}" width="60px;" height="60px;"></td>
                            <?php $status = (isset($detail['page_status']) && $detail['page_status'] == 1 ) ? "Active" : "Inactive" ; ?>
							<td>{{ $status }}</td>
                            <td><a href="{{ url('admin/sadaqah/edit') }}/{{ $detail['id'] }}" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a> |
                            	<a href="{{ url('admin/sadaqah/delete') }}/{{ $detail['id'] }}" title="Remove" onclick="return confirm('you want to delete?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
