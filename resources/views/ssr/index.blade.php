@extends('ssr.master')


@section('main')

    <div class="row mb-2">
      <div class="col-md-12 bg-light align-items-center py-4 mb-2">
        <div class="d-flex justify-content-between">
          <h5>
           <i class="fa fa-server"></i> Server Side Rendering
          </h5>
          <p>{{ Session::get('msg')}}</p>
          <button class="btn btn-sm btn-success rounded-0"> <i class="fa fa-plus pe-1"></i>Create</button>
        </div>
      </div>
    </div>
    
    <div class="mb-5">
        <table class="yajra-datatable table table-bordered table-striped">

            <thead class="bg-info">
                <tr class="">
                    <th scope="col" class="text-center"> ID </th>
                    <th scope="col" class="text-center"> Name </th>
                    <th scope="col" class="text-center"> Email </th>
                    <th scope="col" class="text-center"> Status </th>
                    <th scope="col" class="text-center"> Action </th>
                </tr>
            </thead>

            <tbody>
            </tbody>

        </table>
    </div>
@endsection

@push('js')
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url : "/student"
        },
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'status', name: 'status'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });
</script>
  
@endpush
