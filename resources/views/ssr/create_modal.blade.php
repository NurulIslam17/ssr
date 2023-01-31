{{-- store modal --}}

<!-- Modal -->
<div class="modal fade store_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Create</h5>
                <button type="button" class="close bg-danger text-light" id="insert_modal_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-body">
                    <form id="store_form">
                        @csrf
                        @method('post')

                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Enter name" autocomplete="on">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Enter email" autocomplete="on">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Enter password" autocomplete="on">
                        </div>
                        <button type="submit" id="save_btn" class="btn btn-sm btn-success">Create</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@push('js')
    <script>
        $('#store_data').click(function() {
            // alert('Ok');
            $('.store_modal').modal('show');
            $.ajax()
        });

        $('#insert_modal_close').click(function() {
            $('.store_modal').modal('hide');
            $('#store_form')[0].reset();
        });

        $('#save_btn').click(function() {
            // alert('ok');
            let name = $('#name').val();
            let email = $('#email').val();
            let password = $('#password').val();
            // alert(email);

            $.ajax({

                url: "{{ route('student.index') }}",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    password: password,
                },
                success: function(response) {
                    alert('Dta Inserted');
                    $('.store_modal').modal('hide');
                    $('#store_form')[0].reset();
                }

            });
        });
    </script>
@endpush
