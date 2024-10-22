<!doctype html>
<html class="no-js" lang="ar">

@include('user.parts.head')

@include('user.parts.header')

<style>
    body {
        font-size: 18px; /* increase font size to 18px */
    }
</style>

<main class="main-wrapper">
    <!-- Start Wishlist Area  -->
    <div class="axil-wishlist-area axil-section-gap">
        <div class="container">
            <div class="product-table-heading">
                <h4 class="title">  النقاط المحوله</h4>
            </div>
            <form class="account-details-form" method="post" action="{{route('storeTransferPoints')}}">
                @csrf

                <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>من </label>
                            <input type="text" style="font-weight: bold; " class="form-control" name="from_id" value="{{ auth()->user()->name }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>نقاطي </label>
                            <input type="text" style="font-weight: bold; " class="form-control"  value="{{ auth()->user()->points }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>الي </label>
                            <select class="form-control" name="to_id" required style="font-size: 16px ; font-weight: bold;">
                                <option value="" selected disabled>اختر العميل</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>عدد النقاط المراد تحويلها</label>
                            <input type="text" class="form-control" name="points">
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <input type="submit" class="axil-btn btn-primary form-control" value="تحويل">
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">من</th>
                        <th scope="col" class="text-center">إلى </th>
                        <th scope="col" class="text-center">النقاط</th>
                        <th scope="col" class="text-center">التاريخ</th>
{{--                        <th scope="col" class="text-center">العمليات</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($transferPoints as $transferPoint)
                        <tr id="product-row-{{ $transferPoint->id }}">
                            <td class="text-center">{{ $transferPoint->fromCustomer->name }}</td>
                            <td class="text-center">{{ $transferPoint->toCustomer->name }}</td>
                            <td class="text-center">{{ $transferPoint->points }}</td>
                            <td class="text-center">{{ $transferPoint->created_at->format('Y-m-d') }}</td>
{{--                            <td class="text-center">--}}
{{--                                <!-- Delete button -->--}}
{{--                                <a  class="btn btn-danger btn-sm" href="{{ route('deleteTransferPoints', $transferPoint->id) }}">--}}
{{--                                    <i class="fa fa-trash"></i>--}}
{{--                                </a>--}}
{{--                            </td>--}}
                        </tr>
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        هل متأكد من أنك تريد الحذف؟
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                        <form id="delete-form" method="post" action="">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger" value="حذف" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- نافذة التأكيد للحذف (Modal) -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>هل متأكد من أنك تريد الحذف؟</p>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                        <form id="delete-form" method="post" action="">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger" value="حذف" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty

                        <tr>
{{--                            <td colspan="4" class="text-center">لا يوجد نفايات</td>--}}
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- End Wishlist Area  -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @include('user.parts.footer')
    @include('user.layouts.js')
    @include('user.parts.cart')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // الحصول على جميع الأزرار للحذف
            const deleteButtons = document.querySelectorAll('.delete-button');

            // إضافة حدث "click" لكل زر
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // الحصول على ID للعنصر المراد حذفه
                    const id = this.getAttribute('data-id');

                    // تعيين رابط الحذف في النموذج داخل النافذة المنبثقة
                    const deleteForm = document.getElementById('delete-form');
                    deleteForm.action = `/delete/${id}`; // تأكد من تعديل رابط الحذف ليتناسب مع مسارك
                });
            });
        });
    </script>

</html>
