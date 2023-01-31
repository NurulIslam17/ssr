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
                    <th scope="col" class="text-center"> SL </th>
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


<!-- Modal -->
<div class="modal fade editUser" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-body">
                    <form id="update_form">
                        @csrf
                        @method('post')
                        <input type="hidden" name="update_by_id" id="update_by_id">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="up_name"
                                placeholder="Enter name" autocomplete="on">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="up_email"
                                placeholder="Enter email" autocomplete="on">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Password</label>
                            <input type="password" class="form-control" name="password" id="up_password"
                                placeholder="Enter password" autocomplete="on">
                        </div>
                        <button type="submit" id="save_update_btn" class="btn btn-sm btn-primary">Update</button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@push('js')
    <script type="text/javascript">
        /////////////////////////////////////  Display all data in datatable /////////////////////////////
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

        // ///////////////////////////////////////////Delete record /////////////////////////////////////
        $('.yajra-datatable').on('click', '.deleteUser', function() {
            // alert('ok');
            var id = $(this).data('id');
            // alert(id);
            var deleteConfirm = confirm("Are you sure?");

            if (deleteConfirm == true) {
                $.ajax({
                    url: "{{ route('student_delete') }}",
                    method: 'POST',
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

        ///////////////////////////////////  Edit record        /////////////////////////////////////////
        $('.yajra-datatable').on('click', '.editUser', function() {

            $(".modal").modal('show');
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var password = $(this).data('password');
            // alert(id);

            $('#update_by_id').val(id);
            $('#up_name').val(name);
            $('#up_email').val(email);
            $('#up_password').val(password);

        });

        $("#close").click(function() {
            $(".modal").modal('hide');
        });

        /////////////////////////////////////        status Change       //////////////////////////////// 

        $('.yajra-datatable').on('click', '#status_changehange_btn', function() {
            // alert('Ok');
            var id = $(this).data('id');
            var changeConfirm = confirm("Want to change the status?");
            if (changeConfirm == true) {
                $.ajax({
                    url: " {{route('status_change')}} ",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        alert('Status Changed Successfully!');
                        window.location.href = "/student";
                    }
                });
            }
        });
        /////////////////////////////////////        save_update_ info        //////////////////////////////// 

        $("#save_update_btn").click(function() {

            let id = $('#update_by_id').val();
            let name = $('#up_name').val();
            let email = $('#up_email').val();
            let password = $('#up_password').val();

            $.ajax({
                url: "{{ route('update_data') }}",
                type: "POST",
                data: {
                    id: id,
                    name: name,
                    email: email,
                    password: password,
                },
                success: function(response) {
                    if (response.status == 1) {
                        $(".modal").modal('hide');
                        $('#update_form')[0].reset();
                        window.location.href = "/student";
                    }
                }
            });

        });
    </script>
@endpush
