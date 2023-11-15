@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="feedback_table" class="table-striped table-bordered table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr #</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Feedbacks</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="add_edit_product_modal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark py-2">
                    <h5 class="h5 modal-title font-weight-bold text-white" id="add_edit_modal_title"></h5>
                </div>
                <div class="modal-body">
                    <form class="form row" role="form" id="add_update_product_form">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title">
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between py-1">
                    <button type="button" class="btn-outline-secondary btn btn-sm modal_close">Close</button>
                    <button type="submit" name="submit" class="btn-outline-dark btn btn-sm" id="create_update_btn">
                        <span class="spinner-border spinner-border-sm d-none" id="add_btn_spinner"></span>
                        <span id="add_btn"></span>
                    </button>
                </div>
            </div>
        </div>
    </div> --}}
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
                // "preventDuplicates": true,
            }
            var feedback_table = $("#feedback_table");
            fetchAllFeedbacks();
            // var add_edit_form = $('#add_update_product_form');
            // var delete_restore_modal = $('#delete_restore_modal');


            // $('#add_product').on('click', function() {
            //     // RELACING MODAL TITLE & BUTTON TEXT ON CREATE
            //     $('#add_edit_modal_title').html('Add New Product');
            //     $('#create_update_btn').find('#add_btn').html('Create');
            // });

            // $(document).on('click', '.edit_product', function(e) {
            //     e.preventDefault();
            //     var edit_btn = $(this);

            //     add_edit_form.find('#product_id').val(edit_btn.data('id'));
            //     add_edit_form.find('#title').val(edit_btn.data('title'));
            //     add_edit_form.find('#description').val(edit_btn.data('description'));

            //     $('#add_edit_modal_title').html('Edit Product');
            //     $('#create_update_btn').find('#add_btn').html('Update');
            // });

            // $(document).on('click', '#create_update_btn', function() {
            //     var add_btn = $(this);
            //     add_btn.find('#add_btn_spinner').removeClass('d-none');
            //     add_btn.attr("disabled", true);
            //     let type = 'POST';
            //     let url = '';
            //     let product_id = $('#product_id').val();
            //     let data = new FormData(add_edit_form[0]);
            //     if (add_btn.find('#add_btn').text() == 'Create') {
            //     } else {
            //         data.append('_method', 'PATCH');
            //     }

            //     SendAjaxRequestToServer(type, url, data, '', createUpdateProductResponse);

            //     function createUpdateProductResponse(response) {
            //         if (response.status != 200) {
            //             add_edit_form.find('span').removeClass('d-block').html('');
            //             $('#create_update_btn').removeAttr("disabled");
            //             $('#create_update_btn').find('#add_btn_spinner').addClass('d-none');
            //             $.each(response.responseJSON.errors, function(key, value) {
            //                 add_edit_form.find('#' + key).addClass('is-invalid');
            //                 add_edit_form.find('#' + key).siblings('span').addClass('d-block').html(
            //                     value[
            //                         0]);
            //             });
            //         } else {
            //             feedback_table.DataTable().ajax.reload();
            //             modalFormControl();
            //             toastr[response.state](response.message);

            //         }
            //     }
            // });

            // $('.modal_close').click(modalFormControl);

            // function modalFormControl() {
            //     add_edit_form.find('.is-invalid').removeClass("is-invalid");
            //     add_edit_form.find('.invalid-feedback').text('');
            //     add_edit_form.trigger('reset');
            //     $('#create_update_btn').removeAttr("disabled");
            //     $('#create_update_btn').find('#add_btn_spinner').addClass('d-none');
            //     add_edit_form.parents('.modal').modal('hide');
            // }

            function fetchAllFeedbacks() {
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
                    "ajax": "{{ route('feedback.getAllFeedbacksData') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'title',
                            name: 'title',
                            orderable: true,
                            searchable: true
                        },

                        {
                            data: 'description',
                            name: 'description',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'feedbacks',
                            name: 'feedbacks',
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
                            data: 'updated_at',
                            name: 'updated_at',
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
                var url = "{{ route('feedback.destroyOrRestore') }}";
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
        });
    </script>
@endpush
