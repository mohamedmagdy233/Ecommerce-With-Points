@extends('admin/layouts/master')

@section('title')
    {{ config()->get('app.name') }} | {{ trns('Edit Order') }}
@endsection

@section('page_name')
    {{ trns('Edit Order') }}
@endsection

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ $route }}">
        @csrf
        @method('PUT')

        <div class="row">


            <div class="col-6">
                <label for="order_status" class="form-control-label">{{ trns('order_status') }}</label>
                <select name="status" id="order_status" class="form-control">
                    <option value="" disabled selected>{{ trns('choose') }}</option>
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>معلق</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>قيد الإجراء</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>تم الشحن</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>تم التسليم</option>
                    <option value="returned" {{ $order->status == 'returned' ? 'selected' : '' }}>تم الإرجاع</option>
                    <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>ملغى</option>
                </select>
            </div>




        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="addButton">{{ trns('save') }}</button>
        </div>
    </form>
    @include('admin/layouts/myAjaxHelper')
@endsection

@section('ajaxCalls')

@endsection
