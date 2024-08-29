<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{$route}}">
        @csrf
        <div class="row">
            <!-- Customer Selection -->
            <div class="col-6">
                <label for="to_customer" class="form-control-label">{{ trns('customer') }}</label>
                <select name="customer_id" id="to_customer" class="form-control">
                    <option value="" disabled selected>{{ trns('choose') }}</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" data-points="{{ $customer->points }}">{{ $customer->name }}</option>
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
                <input type="number" id="use_points" name="use_points" class="form-control" min="0" placeholder="{{ trns('Enter points to use') }}">
            </div>

            <!-- Dynamic container for products, quantity, and price inputs -->
            <div id="product-quantity-container" class="col-12">
                <div class="row mb-2">
                    <div class="col-4">
                        <label for="product_ids[]" class="form-control-label">{{ trns('products') }}</label>
                        <select name="product_ids[]" class="form-control product-select">
                            <option value="" disabled selected>{{ trns('choose') }}</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="quantity[]" class="form-control-label">{{ trns('quantity') }}</label>
                        <input type="number" class="form-control quantity-input" name="quantity[]" min="1" placeholder="{{ trns('Enter quantity') }}" value="1">
                    </div>

                    <div class="col-3">
                        <label for="price" class="form-control-label">{{ trns('price') }}</label>
                        <input type="text" class="form-control price-input" name="prices[]" readonly>
                    </div>

                    <div class="col-2 d-flex align-items-end">
                        <button type="button" class="btn btn-success add-product-button">+</button>
                    </div>
                </div>
            </div>

            <!-- Total price display -->
            <div class="col-6">
                <label for="total_price" class="form-control-label">{{ trns('Total Price') }}</label>
                <input type="text" id="total_price" name="total_price" class="form-control" readonly>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trns('close') }}</button>
            <button type="submit" class="btn btn-primary" id="addButton">{{ trns('save') }}</button>
        </div>
    </form>
</div>
<script>

    $(document).ready(function() {
        // Fetch the price per point from your settings
        var pricePerPoint = {{ $setting->price_of_point }};

        // Function to calculate and display price for each product
        function calculatePrice(row) {
            var pricePerUnit = parseFloat(row.find('.product-select option:selected').data('price')) || 0;
            var quantity = parseInt(row.find('.quantity-input').val()) || 0;
            var totalPrice = pricePerUnit * quantity;
            row.find('.price-input').val(totalPrice.toFixed(2));

            calculateTotalPrice(); // Recalculate total price whenever a single price changes
        }

        // Function to calculate and display total price of all selected products
        function calculateTotalPrice() {
            var sum = 0;

            $('.price-input').each(function() {
                sum += parseFloat($(this).val()) || 0;
            });

            var points = parseInt($('#use_points').val()) || 0;
            var discount = pricePerPoint * points;
            var finalPrice = sum - discount;

            if (finalPrice < 0) finalPrice = 0;
            $('#total_price').val(finalPrice.toFixed(2));
        }

        $('#to_customer').on('change', function() {
            var points = $(this).find('option:selected').data('points') || 0;
            $('#customer_points').val(points);
            $('#use_points').attr('max', points); // Set max points for use to the customer's available points
            calculateTotalPrice(); // Recalculate the total price based on the new points value
        });

        $('#use_points').on('input', function() {
            var maxPoints = parseInt($('#customer_points').val()) || 0;
            var pointsToUse = parseInt($(this).val()) || 0;

            if (pointsToUse > maxPoints) {
                $(this).val(maxPoints);
            }

            calculateTotalPrice();
        });

        // Event listener for add product button
        $('.add-product-button').on('click', function() {
            var newProductQuantityInput = `
            <div class="row mb-2">
                <div class="col-4">
                    <select name="product_ids[]" class="form-control product-select">
                        <option value="" disabled selected>{{ trns('choose') }}</option>
                        @foreach($products as $product)
            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                        @endforeach
            </select>
        </div>
        <div class="col-3">
            <input type="number" class="form-control quantity-input" name="quantity[]" min="1" placeholder="{{ trns('Enter quantity') }}" value="1">
                </div>
                <div class="col-3">
                    <input type="text" class="form-control price-input" name="prices[]" readonly>
                </div>
                <div class="col-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-product-button">-</button>
                </div>
            </div>
        `;
            $('#product-quantity-container').append(newProductQuantityInput);
        });

        $(document).on('click', '.remove-product-button', function() {
            $(this).closest('.row').remove();
            calculateTotalPrice(); // Recalculate total price when a product is removed
        });

        $(document).on('change', '.product-select, .quantity-input', function() {
            var row = $(this).closest('.row');
            calculatePrice(row);
        });

        // Initial calculation of total prices on page load
        $('.product-select').each(function() {
            calculatePrice($(this).closest('.row'));
        });
    });

</script>
