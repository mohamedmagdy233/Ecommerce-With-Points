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
                            <th scope="col" class="text-center">الحالة</th>
                            <th scope="col" class="text-center">التاريخ</th>
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
                                <td class="text-center">
                                    @switch($myOrder->status)
                                        @case('pending')
                                            <span class="badge badge-pending">معلق</span>
                                            @break

                                        @case('processing')
                                            <span class="badge badge-processing">قيد الإجراء</span>
                                            @break

                                        @case('shipped')
                                            <span class="badge badge-shipped">تم الشحن</span>
                                            @break

                                        @case('delivered')
                                            <span class="badge badge-delivered">تم التوصيل</span>
                                            @break

                                        @case('returned')
                                            <span class="badge badge-returned">تم الإرجاع</span>
                                            @break

                                        @case('canceled')
                                            <span class="badge badge-canceled">ملغي</span>
                                            @break

                                        @default
                                            <span class="badge badge-unknown">غير معروف</span> <!-- For any unhandled statuses -->
                                    @endswitch
                                </td>
                                <td class="text-center">{{ $myOrder->created_at->format('Y-m-d') }}</td>

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
{{--                                <td class="text-center" colspan="3">لا يوجد طلبات</td>--}}
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
<style>
    .badge-pending {
        background-color: #FFC107; /* Amber for pending */
        color: #fff;
    }

    .badge-processing {
        background-color: #17A2B8; /* Cyan for processing */
        color: #fff;
    }

    .badge-shipped {
        background-color: #007BFF; /* Blue for shipped */
        color: #fff;
    }

    .badge-delivered {
        background-color: #28A745; /* Green for delivered */
        color: #fff;
    }

    .badge-returned {
        background-color: #6C757D; /* Grey for returned */
        color: #fff;
    }

    .badge-canceled {
        background-color: #DC3545; /* Red for canceled */
        color: #fff;
    }

    .badge-unknown {
        background-color: #F8F9FA; /* Light for unknown */
        color: #000;
    }

</style>

</html>
