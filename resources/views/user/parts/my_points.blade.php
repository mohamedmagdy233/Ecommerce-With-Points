<!doctype html>
<html class="no-js" lang="ar">

@include('user.parts.head')
@include('user.parts.header')

<main class="main-wrapper">
    <!-- Start Wishlist Area  -->
    <div class="axil-wishlist-area axil-section-gap">
        <div class="container">
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="pointsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="points-from-orders-tab" data-bs-toggle="tab" href="#points-from-orders" role="tab" aria-controls="points-from-orders" aria-selected="false">نقاطي من الطلبات</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="points-from-sub-customers-tab" data-bs-toggle="tab" href="#points-from-sub-customers" role="tab" aria-controls="points-from-sub-customers" aria-selected="false">نقاطي من طلبات العملاء المرتبطين</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="points-from-transfers-tab" data-bs-toggle="tab" href="#points-from-transfers" role="tab" aria-controls="points-from-transfers" aria-selected="false">نقاطي من التحويلات</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link " id="points-from-waste-tab" data-bs-toggle="tab" href="#points-from-waste" role="tab" aria-controls="points-from-waste" aria-selected="true">نقاطي من النفايات</a>
                </li>



            </ul>


{{--            tesr--}}
            <!-- Tab Content -->
            <div class="tab-content" id="pointsTabContent">
                <!-- Points from Waste -->
                <div class="tab-pane fade  " id="points-from-waste" role="tabpanel" aria-labelledby="points-from-waste-tab">
                    <div class="product-table-heading">
                        <h4 class="title">نقاطي من النفايات </h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">النقاط</th>
                                <th scope="col" class="text-center">تحولت لي بسبب</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $totalPointsFromWaste = 0; @endphp
                            @forelse($pointsFromWaste as $pointFromWaste)
                                <tr id="product-row-{{ $pointFromWaste->id }}">
                                    <td class="text-center">{{ $pointFromWaste->points_transferred }}</td>
                                    <td class="text-center">   بسبب تحول عدد {{ $pointFromWaste->quantity }} من النفايات</td>
                                </tr>
                                @php $totalPointsFromWaste += $pointFromWaste->points_transferred; @endphp
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="3">لا يوجد نقاط</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="text-center">المجموع</th>
                                <th class="text-center">{{ $totalPointsFromWaste }}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Points from Transfers -->
                <div class="tab-pane fade" id="points-from-transfers" role="tabpanel" aria-labelledby="points-from-transfers-tab">
                    <div class="product-table-heading">
                        <h4 class="title">نقاطي من التحويلات </h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">النقاط</th>
                                <th scope="col" class="text-center">تحولت لي بسبب</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $totalPointsFromTransfer = 0; @endphp
                            @forelse($pointsFromTransferPoints as $pointFromTransferPoints)
                                <tr id="product-row-{{ $pointFromTransferPoints->id }}">
                                    <td class="text-center">{{ $pointFromTransferPoints->points }}</td>
                                    <td class="text-center">قام "{{ $pointFromTransferPoints->fromCustomer->name }}"  بتحويل النقاط لك </td>
                                </tr>
                                @php $totalPointsFromTransfer += $pointFromTransferPoints->points; @endphp
                            @empty
                                <tr>
                                    <td class="text-center" colspan="3">لا يوجد نقاط</td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="text-center">المجموع</th>
                                <th class="text-center">{{ $totalPointsFromTransfer }}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Points from Orders -->
                <div class="tab-pane fade show active" id="points-from-orders" role="tabpanel" aria-labelledby="points-from-orders-tab">
                    <div class="product-table-heading">
                        <h4 class="title">نقاطي من الطلبات </h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">النقاط</th>
                                <th scope="col" class="text-center">تحولت لي بسبب</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $totalPointsFromOrders = 0; @endphp
                            @forelse($myOrders as $myOrder)
                                @foreach($myOrder->products as $product)
                                    <tr>
                                        <td class="text-center">{{  $product->award_points }}</td>
                                        <td class="text-center">تم اضافه النقاط لحسابك بسبب شراء منتج :  {{ $product->name }}</td>
                                    </tr>
                                    @php $totalPointsFromOrders += $product->award_points; @endphp
                                @endforeach
                            @empty
                                <tr>
                                    <td class="text-center" colspan="3">لا يوجد نقاط</td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="text-center">المجموع</th>
                                <th class="text-center">{{ $totalPointsFromOrders }}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Points from Sub-Customer Orders -->
                <div class="tab-pane fade" id="points-from-sub-customers" role="tabpanel" aria-labelledby="points-from-sub-customers-tab">
                    <div class="product-table-heading">
                        <h4 class="title">نقاطي من طلبات  العملاء المرتبطين </h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">النقاط</th>
                                <th scope="col" class="text-center">تحولت لي بسبب</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $totalPointsFromSubCustomers = 0; @endphp
                            @forelse($orderFromSubCustomer as $myOrder)
                                @foreach($myOrder->products as $product)
                                    <tr>
                                        <td class="text-center">{{  $product->award_points }}</td>
                                        <td class="text-center"> قام "{{ $myOrder->customer->name }}" بشراء منتج :  {{ $product->name }} </td>
                                    </tr>
                                    @php $totalPointsFromSubCustomers += $product->award_points; @endphp
                                @endforeach
                            @empty
                                <tr>
                                    <td class="text-center" colspan="3">لا يوجد نقاط</td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="text-center">المجموع</th>
                                <th class="text-center">{{ $totalPointsFromSubCustomers }}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Wishlist Area  -->
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@include('user.parts.footer')
@include('user.layouts.js')
@include('user.parts.cart')

</html>
