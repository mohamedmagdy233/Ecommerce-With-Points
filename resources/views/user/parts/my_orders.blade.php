<!doctype html>
<html class="no-js" lang="ar">

@include('user.parts.head')
@include('user.parts.header')

<main class="main-wrapper">
    <!-- Start Wishlist Area  -->
    <div class="axil-wishlist-area axil-section-gap">
        <div class="container">
            <!-- Points from Orders -->
            <div class="tab-pane fade show active">
                <div class="product-table-heading mb-4">
                    <h4 class="title">نقاطي من الطلبات</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center">الطلب</th>
                            <th scope="col" class="text-center">المنتجات</th>
                            <th scope="col" class="text-center">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $totalPointsFromOrders = 0; @endphp
                        @forelse ($myOrders as $myOrder)
                            @php
                                $productDetails = [];
                                foreach($myOrder->products as $product) {
                                    $productDetails[] = $product->name . '  :  عدد العناصر:  ' . $product->pivot->quantity;
                                }
                            @endphp
                            <tr>
                                <td class="text-center fw-bold">رقم الطلب: {{ $myOrder->id }}</td>
                                <td class="text-center">{!! implode('<br> ', $productDetails) !!}</td>
                                @if($myOrder->status == 'pending')
                                    <td class="text-center">
                                        <a href="{{ route('order.delete', $myOrder->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <p  class="btn btn-primary">تم تاكيد الطلب من التاجر </p>
                                    </td>

                                @endif

                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="3">لا يوجد طلبات</td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
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
