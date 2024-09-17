@extends('admin/layouts/master')

@section('title')
    {{ config()->get('app.name') }} | {{ trns('customers') }}
@endsection
@section('page_name')
    {{ trns('customers') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> {{ trns('customers') }} {{ trns(config()->get('app.name')) }}</h3>
                    @can('add_customer')
                        <div class="d-flex">
                            <button class="btn btn-danger btn-icon text-white mr-2" id="deleteSelectedBtn">
                    <span>
                        <i class="fe fe-trash"></i>
                    </span> {{ trns('delete selected') }}
                            </button>
                            <span class="mr-2"></span>
                            <button class="btn btn-secondary btn-icon text-white addBtn">
                        <span>
                            <i class="fe fe-plus"></i>
                        </span> {{ trns('add new customer') }}
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
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th class="min-w-25px">{{ trns('id') }}</th>
                                <th class="min-w-50px">{{ trns('name') }}</th>
                                <th class="min-w-125px">{{ trns('WhatsApp') }}</th>
                                <th class="min-w-125px">{{ trns('referral_code') }}</th>
                                <th class="min-w-50px">{{ trns('phone') }}</th>
                                <th class="min-w-125px">{{ trns('address') }}</th>
                                <th class="min-w-125px">{{ trns('link') }}</th>
                                <th class="min-w-125px">{{ trns('points') }}</th>
                                <th class="min-w-50px rounded-end">{{ trns('actions') }}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--Delete MODAL -->
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trns('delete') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="delete_id" name="id" type="hidden">
                        <p>{{ trns('are_you_sure_you_want_to_delete_this_obj')}} <span id="title"
                                                                                       class="text-danger"></span>?</p>
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
        var columns = [
            {
                data: 'checkbox',
                name: 'checkbox',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return '<input type="checkbox" class="selectRow" value="' + row.id + '">';
                }
            },
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'WhatsApp', name: 'WhatsApp'},
            {data: 'referral_code', name: 'referral_code'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address'},
            {data: 'link', name: 'link'},
            {data: 'points', name: 'points'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
        showData('{{ route('customers.index') }}', columns);

        // Delete Using Ajax
        deleteScript('{{ route('customers.destroy', ':id') }}');

        // Add Using Ajax
        showAddModal('{{ route('customers.create') }}');
        addScript();

        // Edit Using Ajax
        showEditModal('{{ route('customers.edit', ':id') }}');
        editScript();

        // Select/Deselect All Rows
        $('#selectAll').click(function() {
            $('.selectRow').prop('checked', this.checked);
        });

        // When a single row checkbox is unchecked, uncheck the header checkbox
        $(document).on('click', '.selectRow', function() {
            if (!$(this).prop('checked')) {
                $('#selectAll').prop('checked', false);
            } else {
                // If all checkboxes are checked, check the header checkbox
                if ($('.selectRow:checked').length === $('.selectRow').length) {
                    $('#selectAll').prop('checked', true);
                }
            }
        });

        // Delete Selected Rows Using Ajax
        $('#deleteSelectedBtn').click(function() {
            var selected = [];
            $('.selectRow:checked').each(function() {
                selected.push($(this).val());
            });

            if (selected.length > 0) {
                if (confirm('هل أنت متأكد من الحذف')) {
                    $.ajax({
                        url: '{{ route('customers.deleteSelected') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: selected
                        },
                        success: function (response) {
                            if(response.success) {
                                toastr.success(response.message); // Display success message
                            } else {
                                toastr.error(response.message); // Display error message if any
                            }
                            $('#dataTable').DataTable().ajax.reload(); // Reload the DataTable
                        },
                        error: function (xhr) {
                            toastr.error('{{ trns('error_occurred') }}'); // Generic error message
                        }
                    });
                }
            } else {
                alert('{{ trns('please_select_at_least_one_item') }}');
            }
        });
    </script>
@endsection
