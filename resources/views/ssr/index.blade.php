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
        <table class="myTable table table-bordered table-striped" id="myTable">

            <thead class="bg-info">
                <tr class="">
                    <th scope="col" class="text-center"> SL </th>
                    <th scope="col" class="text-center"> Name </th>
                    <th scope="col" class="text-center"> Email </th>
                    <th scope="col" class="text-center"> Status </th>
                    <th scope="col" class="text-center"> Action </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($students as $student)
                <tr>
                  <th scope="row"> {{ $loop->iteration}}</th>
                  <td> {{ $student->name}}</td>
                  <td> {{ $student->email}} </td>
                  <td> 
          
                    @if ($student->status==1)
                      <span class="text-success">Active</span>
                    @else
                      <span class="text-danger">Inactive</span>
                    @endif

                  </td>

                  <td class="text-center d-flex justify-content-center">
                    <a href="#"> <i class="fa fa-edit me-2 p-2 bg-info"></i></a>
                    <a href="#"> <i class="fa fa-trash me-2 p-2 bg-danger text-light"></i></a>
                    <a href=" {{ route('status_change',['id'=>$student->id])}}" onclick=" return confirm('Want to change the status ?')"> <i class="fa fa-repeat me-2 p-2 bg-secondary text-light"></i></a>
                  </td>
              </tr>
                  
                @endforeach
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
        ajax: "{{ route('student.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'username', name: 'status'},
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
