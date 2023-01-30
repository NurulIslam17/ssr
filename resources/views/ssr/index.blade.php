@extends('ssr.master')


@section('main')
    <div class="row mb-2">
        <div class="col-md-12 bg-light align-items-center py-4 mb-2">
            <div class="d-flex justify-content-between">
                <h5>
                    <i class="fa fa-server"></i> Server Side Rendering
                </h5>
                <p>{{ Session::get('msg') }}</p>
                <a href="{{ route('student.create') }}" class="btn btn-sm btn-success rounded-0"> <i
                        class="fa fa-plus pe-1"></i>Create</a>
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
        //  Display all data in datatable
        $(function() {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/student"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        });


        // Delete record
        $('.yajra-datatable').on('click', '.deleteUser', function() {
            // alert('ok');
            var id = $(this).data('id');
            // alert(id);
            var deleteConfirm = confirm("Are you sure?");
            if (deleteConfirm == true) {
                $.ajax({
                    url: "{{ route('student_delete') }}",
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.success == 1) {

                            setTimeout(function() {
                                location.reload();
                            }, 10);
                        } else {
                            alert("Invalid ID.");
                        }
                    }
                });
            }
        });



        // Update record
        $('.yajra-datatable').on('click', '.editUser', function() {
            var id = $(this).data('id');
            alert(id);
            $.ajax({
                url: " route('edit_data') ",
                method: "post",
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response.success);
                }
            });

        });
    </script>
@endpush
