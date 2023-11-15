@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="feedback_table" class="table-striped table-bordered table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr #</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
    @include('admin.partials._delete_modal')
@endsection
@push('javascript')
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "showDuration": 300,
                "timeOut": 2000,
                "hideDuration": 1000,
                "preventDuplicates": true,
            }
            var feedback_table = $("#feedback_table");
            var delete_restore_modal = $('#delete_restore_modal');

            fetchAllUsers();

            function fetchAllUsers() {
                feedback_table.DataTable({
                    "pagingType": 'numbers',
                    "orderable": true,
                    'pageLength': 10,
                    "lengthMenu": [
                        [10, 15, 20, 25, 50, -1],
                        [10, 15, 20, 25, 50, 'All'],
                    ],
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": true,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('getAllUsers') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name',
                            orderable: false,
                            searchable: false
                        },

                        {
                            data: 'email',
                            name: 'email',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'type',
                            name: 'type',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            }

            $(document).on('click', '#delete_restore_modal_btn', function() {
                // var action_btn = $(this);
                var confirm_btn = $(this);
                confirm_btn.find('#delete_btn_spinner').removeClass('d-none');
                confirm_btn.addClass('disabled');
                let dalate_restore_form = $('#delete_restore_form');
                var url = "{{ route('deleteUser') }}";
                var data = new FormData(dalate_restore_form[0]);

                SendAjaxRequestToServer('POST', url, data, 'json', deleteRestoreResponse);
            });

            function deleteRestoreResponse(response) {
                if (response.status == 200) {
                    feedback_table.DataTable().ajax.reload();
                    deleteRestoreModalReset();
                    toastr[response.state](response.message);
                } else {
                    toastr[response.state](response.message);
                }
            }

            $('.delete_restore_close').click(deleteRestoreModalReset);

            function deleteRestoreModalReset() {
                delete_restore_modal.find('#delete_restore_form #id').removeAttr('value');
                delete_restore_modal.find('#delete_restore_modal_btn').removeAttr(
                    "data-action");
                delete_restore_modal.find('#delete_restore_modal_heading').removeClass(
                    'bg-gradient-success, bg-gradient-danger');
                delete_restore_modal.find('#delete_restore_modal_btn').removeClass(
                    'bg-gradient-success, bg-gradient-danger disabled');
                $('#delete_restore_modal_btn').find('#delete_btn_spinner').addClass('d-none');
                delete_restore_modal.modal('hide');
            }

            // SHOW/HIDE FIRMWARE
            $(document).on('click', '#status_update', function(e) {
                if ($(this).prop('checked')) {
                    $(this).addClass('bg-primary border-2');
                } else {
                    $(this).removeClass('bg-primary');
                }
                var data = JSON.stringify({
                    id: $(this).data('id'),
                    comments: $(this).prop('checked') == true ? 1 : 0,
                });
                var url = "{{ route('feedback.changeComments') }}";

                SendAjaxRequestToServer('POST', url, data, 'json', updatedStatus);
            });

            function updatedStatus(response) {
                feedback_table.DataTable().ajax.reload();

                toastr[response.state](response.message);
            }
        });
    </script>
@endpush
