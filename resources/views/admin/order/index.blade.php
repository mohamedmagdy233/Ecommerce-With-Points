@extends('admin/layouts/master')

@section('title')
    {{ config()->get('app.name') }} | الطلبات
@endsection
@section('page_name') الطلبات @endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> الطلبات {{ config()->get('app.name') }}</h3>
                    @can('add_order')
                        <div class="d-flex">
                            <a href="{{route('orders.create')}}" style="margin:0 0 0 5px;" class="btn btn-secondary btn-icon text-white mr-2">
                        <span>
                            <i class="fe fe-plus"></i>
                        </span> إضافة طلب جديد


                            </a>
                            <button class="btn btn-danger btn-icon text-white" id="delete-selected">
                        <span>
                            <i class="fe fe-trash"></i>
                        </span> حذف المحدد
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
                                    <input type="checkbox" id="select-all" onclick="selectAllCheckboxes(this)">
                                </th>
                                <th class="min-w-50px">العميل</th>
                                <th class="min-w-125px">المنتجات</th>
                                <th class="min-w-50px">نقاط العميل</th>
                                <th class="min-w-50px">الحالة</th>
                                <th class="min-w-125px">الإجمالي</th>
                                <th class="min-w-50px rounded-end">الإجراءات</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--Delete MODAL -->
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="delete_id" name="id" type="hidden">
                        <p>هل أنت متأكد أنك تريد حذف هذا العنصر؟ <span id="title" class="text-danger"></span>؟</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal" id="dismiss_delete_modal">
                            إغلاق
                        </button>
                        <button type="button" class="btn btn-danger" id="delete_btn">حذف!</button>
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
                        <h5 class="modal-title" id="example-Modal3">تفاصيل العنصر</h5>
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
                data: 'id',
                name: 'id',
                render: function (data, type, row) {
                    return `<input type="checkbox" class="row-checkbox" value="${data}">`;
                },
                orderable: false,
                searchable: false
            },
            {data: 'customer_id', name: 'customer_id'},
            {data: 'products', name: 'products', orderable: false, searchable: false},
            {data: 'points', name: 'points'},
            {data: 'status', name: 'status'},
            {data: 'total', name: 'total'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
        showData('{{ route('orders.index') }}', columns);

        // Delete Using Ajax
        deleteScript('{{ route('orders.destroy', ':id') }}');

        // Add Using Ajax
        showAddModal('{{ route('orders.create') }}');
        addScript();

        // Edit Using Ajax
        showEditModal('{{ route('orders.edit', ':id') }}');
        editScript();

        // Handle deletion of selected rows
        $('#delete-selected').on('click', function () {
            var selectedIds = [];
            $('.row-checkbox:checked').each(function () {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length > 0) {
                if (confirm('هل أنت متأكد أنك تريد حذف العناصر المحددة؟')) {
                    // Send an AJAX request to delete selected rows
                    $.ajax({
                        url: '{{ route('massDeleteOrders') }}', // Ensure you have a route for this
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: selectedIds
                        },
                        success: function (response) {
                            toastr.success('تم الحذف بنجاح');
                            $('#dataTable').DataTable().ajax.reload();
                        },
                        error: function (xhr) {
                            toastr.error('حدث خطأ');
                        }
                    });
                }
            } else {
                alert('يرجى تحديد عنصر واحد على الأقل');
            }
        });

        // Select all checkboxes
        function selectAllCheckboxes(selectAllCheckbox) {
            $('.row-checkbox').prop('checked', selectAllCheckbox.checked);
        }

        // Handle unchecking the "Select All" checkbox if any row checkbox is unchecked
        $(document).on('click', '.row-checkbox', function () {
            if (!$(this).prop('checked')) {
                $('#select-all').prop('checked', false);
            } else {
                if ($('.row-checkbox:checked').length === $('.row-checkbox').length) {
                    $('#select-all').prop('checked', true);
                }
            }
        });
    </script>
@endsection
