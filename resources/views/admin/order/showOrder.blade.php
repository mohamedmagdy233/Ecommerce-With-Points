@extends('admin/layouts/master')

@section('title')
    {{ config()->get('app.name') }} | {{ trns('show_order') }}
@endsection
@section('page_name') {{ trns('show_order') }} @endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> {{ trns('show_order') }} {{ config()->get('app.name') }}</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-bordered text-nowrap w-100" id="dataTable">
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="min-w-25px">#</th>
                                <th class="min-w-50px">{{ trns('customer') }}</th>
                                <th class="min-w-125px">{{ trns('products') }}</th>
                                <th class="min-w-50px">{{ trns('status') }}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <!-- Create Or Edit Modal -->
        <div class="modal fade" id="editOrCreate" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example-Modal3">{{  trns('object_details')}}</h5>
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
            {data: 'id', name: 'id'},
            {data: 'customer_id', name: 'customer_id'},
            {data: 'products', name: 'products', orderable: false, searchable: false},
            {data: 'status', name: 'status'},
        ]
        showData('{{route('orders.showOrder')}}', columns);
        // Delete Using Ajax
        deleteScript('{{route('orders.destroy',':id')}}');
        // Add Using Ajax
        showEditModal('{{route('changeOrderStatus',':id')}}');
        editScript();
    </script>

    <script>
        $(document).on('change', '.status-select', function() {
            var orderId = $(this).data('order-id');
            var status = $(this).val();

            $.ajax({
                url: '{{ route('orders.updateStatus') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: orderId,
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    toastr.error('حدث خطأ أثناء تحديث الحالة.');
                }
            });
        });
    </script>
    </script>
@endsection


