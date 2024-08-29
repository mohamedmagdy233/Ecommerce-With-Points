@extends('admin/layouts/master')
@section('title')
    {{ config()->get('app.name') }} | {{ trns('dashboard') }}
@endsection
@section('page_name')
    {{ trns('dashboard') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary-gradient img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white"><h2 class="mb-0 number-font">{{ \App\Models\Admin::count() }}</h2>
                            <p class="text-white mb-0"> {{ trns('admins_count') }}</p></div>
                        <div class="mr-auto">
                            <i class="fe fe-user-check text-white fs-30 ml-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary-gradient img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white"><h2 class="mb-0 number-font">{{ \App\Models\Customer::count() }}</h2>
                            <p class="text-white mb-0"> {{ trns('customers_count') }}</p></div>
                        <div class="mr-auto">
                            <i class="fe fe-camera text-white fs-30 ml-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary-gradient img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white"><h2 class="mb-0 number-font">{{ \App\Models\Product::count() }}</h2>
                            <p class="text-white mb-0"> {{ trns('products_count') }}</p></div>
                        <div class="mr-auto">
                            <i class="fe fe-box text-white fs-30 ml-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary-gradient img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white"><h2 class="mb-0 number-font">{{ \App\Models\Waste::count() }}</h2>
                            <p class="text-white mb-0"> {{ trns('waste_count') }}</p></div>
                        <div class="mr-auto">
                            <i class="fe fe-archive text-white fs-30 ml-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary-gradient img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white"><h2 class="mb-0 number-font">{{ \App\Models\TransferPoints::count() }}</h2>
                            <p class="text-white mb-0"> {{ trns('transfer_points_count') }}</p></div>
                        <div class="mr-auto">
                            <i class="fe fe-triangle text-white fs-30 ml-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary-gradient img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white"><h2 class="mb-0 number-font">{{ \App\Models\Order::count() }}</h2>
                            <p class="text-white mb-0"> {{ trns('order_count') }}</p></div>
                        <div class="mr-auto">
                            <i class="fe fa-jedi-order text-white fs-30 ml-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>


@endsection
@section('js')

@endsection

