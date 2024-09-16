@extends('admin/layouts/master')

@section('title')
    {{ config()->get('app.name') }} | {{ trns('admins') }}
@endsection

@section('page_name')
    {{ trns('admins') }}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> {{ trns('admins') }} {{ config()->get('app.name') }}</h3>
                    @can('add_admin')
                        <div class="">
                            <button class="btn btn-secondary btn-icon text-white addBtn">
                            <span>
                                <i class="fe fe-plus"></i>
                            </span> {{ trns('add new admin') }}
                            </button>
                            <!-- Button to delete selected items -->
                            <button class="btn btn-danger text-white" id="delete-selected">
                                <i class="fe fe-trash"></i> حذف المحدد
                            </button>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-bordered text-nowrap w-100" id="dataTable">
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="min-w-25px">
                                    <!-- "Select All" checkbox -->
                                    <input type="checkbox" id="select-all">
                                </th>
                                <th class="min-w-50px">{{ trns('name') }}</th>
                                <th class="min-w-50px">{{ trns('code') }}</th>
                                <th class="min-w-125px">{{ trns('email') }}</th>
                                <th class="min-w-125px">{{ trns('phone') }}</th>
                                <th class="min-w-125px">{{ trns('permissions') }}</th>
                                <th class="min-w-50px rounded-end">{{ trns('actions') }}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete MODAL -->
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trns('delete') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="delete_id" name="id" type="hidden">
                        <p>{{ trns('are_you_sure_you_want_to_delete_this_obj') }} <span id="title" class="text-danger"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal" id="dismiss_delete_modal">
                            {{ trns('close') }}
                        </button>
                        <button type="button" class="btn btn-danger" id="delete_btn">{{ trns('delete') }} !</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL CLOSED -->

        <!-- Create Or Edit Modal -->
        <div class="modal fade" id="editOrCreate" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example-Modal3">{{ trns('object_details') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">

                    </div>
                </div>
            </div>
        </div>
        <!-- Create Or Edit Modal -->
    </div>

    @include('admin/layouts/myAjaxHelper')

@endsection

@section('ajaxCalls')
    <script>
        $(document).ready(function () {
            // Initialize DataTable only if not already initialized
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admins.index') }}',
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        render: function (data, type, row) {
                            return `<input type="checkbox" class="row-checkbox" value="${data}">`;
                        },
                        orderable: false,
                        searchable: false
                    },
                    { data: 'name', name: 'name' },
                    { data: 'code', name: 'code' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'permissions', name: 'permissions' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // Set up the delete script for deleting items
            deleteScript('{{ route('admins.destroy', ':id') }}');

            // Set up modal for adding a new admin
            showAddModal('{{ route('admins.create') }}');
            addScript();

            // Set up modal for editing an admin
            showEditModal('{{ route('admins.edit', ':id') }}');
            editScript();

            // Select All Checkboxes
            $('#select-all').on('click', function () {
                var rows = table.rows({ 'search': 'applied' }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            // Handle individual row checkbox selection
            $('#dataTable tbody').on('change', '.row-checkbox', function () {
                if (!this.checked) {
                    $('#select-all').prop('checked', false);
                }
                if ($('.row-checkbox:checked').length === $('.row-checkbox').length) {
                    $('#select-all').prop('checked', true);
                }
            });

            // Handle deletion of selected rows
            $('#delete-selected').on('click', function () {
                var selectedIds = [];
                $('.row-checkbox:checked').each(function () {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length > 0) {
                    if (confirm('هل أنت متأكد من الحذف')) {
                        $.ajax({
                            url: '{{ route('massDelete') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: selectedIds
                            },
                            success: function (response) {
                                toastr.error('تم الحذف بنجاح');
                                table.ajax.reload();
                            },
                            error: function (xhr) {
                                toastr.error('حدث خطأ');
                            }
                        });
                    }
                } else {
                    alert('يرجى تحديد عنصر واحد على الاقل');
                }
            });
        });
    </script>
@endsection
