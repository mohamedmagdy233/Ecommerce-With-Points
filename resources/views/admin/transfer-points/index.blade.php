@extends('admin/layouts/master')

@section('title')
    {{ config()->get('app.name') }} | {{ trns('transfer_points') }}
@endsection
@section('page_name') {{ trns('transfer_points') }} @endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> {{ trns('transfer_points') }} {{ config()->get('app.name') }}</h3>
                    <div class="">
                        <button class="btn btn-secondary btn-icon text-white addBtn">
									<span>
										<i class="fe fe-plus"></i>
									</span> {{ trns('add new transfer') }}
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-bordered text-nowrap w-100" id="dataTable">
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="min-w-25px">#</th>
                                <th class="min-w-50px">{{ trns('from') }}</th>
                                <th class="min-w-50px">{{ trns('points_of_sender') }}</th>
                                <th class="min-w-125px">{{ trns('to') }}</th>
                                <th class="min-w-50px">{{ trns('points_of_receiver') }}</th>
                                <th class="min-w-50px">{{ trns('points') }}</th>
                                <th class="min-w-50px">{{ trns('added_by') }}</th>
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
                        <p>{{  trns('are_you_sure_you_want_to_delete_this_obj')}} <span id="title" class="text-danger"></span>?</p>
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
            {data: 'from_id', name: 'from_id'},
            {data: 'points_of_from', name: 'points_of_from'},
            {data: 'to_id', name: 'to_id'},
            {data: 'points_of_to', name: 'points_of_to'},
            {data: 'points', name: 'points'},
            {data: 'admin_id', name: 'admin_id'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        showData('{{route('transfer_points.index')}}', columns);
        // Delete Using Ajax
        deleteScript('{{route('transfer_points.destroy',':id')}}');
        // Add Using Ajax
        showAddModal('{{route('transfer_points.create')}}');
        addScript();
        // Add Using Ajax
        showEditModal('{{route('transfer_points.edit',':id')}}');
        editScript();
    </script>
@endsection


