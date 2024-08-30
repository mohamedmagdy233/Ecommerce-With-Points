@extends('admin/layouts/master')

@section('title')
    {{ config()->get('app.name') }} | {{ trns('products') }}
@endsection

@section('page_name')
    {{ trns('products') }}
@endsection

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{$route}}">
        @csrf
        <div class="row">
            <!-- Dynamic container for products, quantity, and price inputs -->
            <div id="product-quantity-container" class="col-12">
                <div class="row mb-2">
                    <div class="col-3">
                        <label for="product_ids[]" class="form-control-label">{{ trns('product') }}</label>
                        <select name="product_ids[]" class="form-control product-select">
                            <option value="" disabled selected>{{ trns('choose') }}</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}"
                                        data-award_points="{{ $product->award_points }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- New input field to display price per unit -->
                    <div class="col-2">
                        <label for="price_per_unit" class="form-control-label">{{ trns('price_per_unit') }}</label>
                        <input type="text" class="form-control price-per-unit" name="price_per_unit" readonly>
                    </div>

                    <!-- New input field to display points -->
                    <div class="col-2">
                        <label for="award_points" class="form-control-label">{{ trns('award_points') }}</label>
                        <input type="text" class="form-control award-points" name="award_points" readonly>
                    </div>

                    <div class="col-2">
                        <label for="quantity[]" class="form-control-label">{{ trns('quantity') }}</label>
                        <input type="number" class="form-control quantity-input" name="quantity[]" min="1"
                               placeholder="{{ trns('Enter quantity') }}" value="1">
                    </div>

                    <div class="col-2">
                        <label for="price" class="form-control-label">{{ trns('price') }}</label>
                        <input type="text" class="form-control price-input" name="prices[]" readonly>
                    </div>

                    <div class="col-1 d-flex align-items-end">
                        <button type="button" class="btn btn-success add-product-button">+</button>
                    </div>
                </div>
            </div>

            <!-- Total Award Points Display -->
            <div class="col-6">
                <label for="total_award_points" class="form-control-label">{{ trns('total_award_points') }}</label>
                <input type="text" id="total_award_points" name="total_award_points" class="form-control" readonly>
            </div>

            <!-- Delivery Type Selection -->
            <div class="col-6">
                <label for="delivery_type" class="form-control-label">{{ trns('delivery_type') }}</label>
                <select name="delivery_type" id="delivery_type" class="form-control">
                    <option value="" disabled selected>{{ trns('choose') }}</option>
                    <option value="1"> الاستلام في المحل</option>
                    <option value="2"> التوصيل للمنزل</option>
                </select>
            </div>

            <!-- Address Input (Initially Hidden) -->
            <div class="col-6" id="address-container" style="display: none;">
                <label for="address" class="form-control-label">{{ trns('address') }}</label>
                <input type="text" id="address" name="address" class="form-control" placeholder="من فضلك ادخل العنوان">
            </div>

            <!-- Customer Selection -->
            <div class="col-6">
                <label for="to_customer" class="form-control-label">{{ trns('customer') }}</label>
                <select name="customer_id" id="to_customer" class="form-control">
                    <option value="" disabled selected>{{ trns('choose') }}</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}"
                                data-points="{{ $customer->points }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Display customer points -->
            <div class="col-6">
                <label for="customer_points" class="form-control-label">{{ trns('points') }}</label>
                <input type="number" id="customer_points" class="form-control" readonly>
            </div>

            <!-- Input for points to use -->
            <div class="col-6">
                <label for="use_points" class="form-control-label">{{ trns('points to use') }}</label>
                <input type="number" id="use_points" name="use_points" class="form-control" min="0"     value="0" >
            </div>

            <!-- Total price display -->
            <div class="col-6">
                <label for="total_price" class="form-control-label">{{ trns('Total Price') }}</label>
                <input type="text" id="total_price" name="total_price" class="form-control" readonly>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="addButton">{{ trns('save') }}</button>
        </div>
    </form>
    @include('admin/layouts/myAjaxHelper')
@endsection

@section('ajaxCalls')
    <script>
        $(document).ready(function () {
            var pricePerPoint = {{ $setting->price_of_point }};

            // Function to display price per unit for selected product
            function showPricePerUnit(row) {
                var pricePerUnit = parseFloat(row.find('.product-select option:selected').data('price')) || 0;
                row.find('.price-per-unit').val(pricePerUnit.toFixed(2)); // Display price per unit
            }

            // Function to display award points for selected product
            function showAwardPoints(row) {
                var awardPoints = parseFloat(row.find('.product-select option:selected').data('award_points')) || 0; // Correct data attribute
                row.find('.award-points').val(awardPoints.toFixed(2)); // Display award points
            }

            // Function to calculate and display price for each product
            function calculatePrice(row) {
                var pricePerUnit = parseFloat(row.find('.product-select option:selected').data('price')) || 0;
                var quantity = parseInt(row.find('.quantity-input').val()) || 0;
                var totalPrice = pricePerUnit * quantity;
                row.find('.price-input').val(totalPrice.toFixed(2));

                calculateTotalPrice(); // Recalculate total price whenever a single price changes
                calculateTotalAwardPoints(); // Recalculate total award points whenever a single price changes
            }

            // Function to calculate and display total price of all selected products
            function calculateTotalPrice() {
                var sum = 0;

                $('.price-input').each(function () {
                    sum += parseFloat($(this).val()) || 0;
                });

                var points = parseInt($('#use_points').val()) || 0;
                var discount = pricePerPoint * points;
                var finalPrice = sum - discount;

                if (finalPrice < 0) finalPrice = 0;
                $('#total_price').val(finalPrice.toFixed(2));
            }

            // Function to calculate and display total award points of all selected products
            // Function to calculate and display total award points of all selected products
            function calculateTotalAwardPoints() {
                var totalAwardPoints = 0;

                $('#product-quantity-container .row').each(function () {
                    var awardPoints = parseFloat($(this).find('.award-points').val()) || 0;
                    var quantity = parseInt($(this).find('.quantity-input').val()) || 0;
                    totalAwardPoints += awardPoints * quantity; // Multiply award points by quantity
                });

                $('#total_award_points').val(totalAwardPoints.toFixed(2)); // Display the total award points
            }


            $('#to_customer').on('change', function () {
                var points = $(this).find('option:selected').data('points') || 0;
                $('#customer_points').val(points);
                $('#use_points').attr('max', points);
                calculateTotalPrice();
                calculateTotalAwardPoints();
            });

            $('#use_points').on('input', function () {
                var maxPoints = parseInt($('#customer_points').val()) || 0;
                var pointsToUse = parseInt($(this).val()) || 0;

                if (pointsToUse > maxPoints) {
                    $(this).val(maxPoints);
                }

                calculateTotalPrice();
            });

            // Event listener for delivery type change
            $('#delivery_type').on('change', function () {
                if ($(this).val() == '2') { // Show address input if "التوصيل للمنزل" is selected
                    $('#address-container').show();
                } else {
                    $('#address-container').hide();
                }
            });

            // Event listener for add product button
            $('.add-product-button').on('click', function () {
                var newProductQuantityInput = `
                <div class="row mb-2">
                    <div class="col-3">
                        <select name="product_ids[]" class="form-control product-select">
                            <option value="" disabled selected>{{ trns('choose') }}</option>
                            @foreach($products as $product)
                <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-award_points="{{ $product->award_points }}">{{ $product->name }}</option>
                            @endforeach
                </select>
            </div>
            <div class="col-2">
                <input type="text" class="form-control price-per-unit" readonly>
            </div>
            <div class="col-2">
                <input type="text" class="form-control award-points" readonly>
            </div>
            <div class="col-2">
                <input type="number" class="form-control quantity-input" name="quantity[]" min="1" placeholder="{{ trns('Enter quantity') }}" value="1">
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control price-input" name="prices[]" readonly>
                    </div>
                    <div class="col-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-product-button">-</button>
                    </div>
                </div>
            `;
                $('#product-quantity-container').append(newProductQuantityInput);
            });

            $(document).on('click', '.remove-product-button', function () {
                $(this).closest('.row').remove();
                calculateTotalPrice(); // Recalculate total price when a product is removed
                calculateTotalAwardPoints(); // Recalculate total award points when a product is removed
            });

            $(document).on('change', '.product-select', function () {
                var row = $(this).closest('.row');
                showPricePerUnit(row);  // Show price per unit when product changes
                showAwardPoints(row);   // Show award points when product changes
                calculatePrice(row);    // Calculate price based on quantity and unit price
            });

            $(document).on('input', '.quantity-input', function () {
                var row = $(this).closest('.row');
                calculatePrice(row);
            });

            // Initial calculation of total prices and award points on page load
            $('.product-select').each(function () {
                var row = $(this).closest('.row');
                showPricePerUnit(row);  // Show price per unit initially
                showAwardPoints(row);   // Show award points initially
                calculatePrice(row);
            });
        });
    </script>
@endsection
