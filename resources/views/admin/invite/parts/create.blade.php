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
                        <option value="{{ $customer->id }}" data-referral-code="{{ $customer->referral_code }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>


            <!-- Input for Referral Link -->
            <div class="col-12 mt-3" id="referral-link-container" style="display: none;">
                <label for="referral_link" class="form-control-label">{{ trns('Referral Link') }}</label>
                <input type="text" id="referral_link"  name="link" class="form-control" readonly>
            </div>



            <!-- Input for points to use -->
            <div class="col-6">
                <label for="points_awarded" class="form-control-label">{{ trns('points_awarded') }}</label>
                <input type="number" id="points_awarded" name="points_awarded" class="form-control" min="0" placeholder="{{ trns('Enter points to points_awarded') }}">
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
        var baseUrl = "{{ url('/') }}"; // Base URL of your application

        $('#to_customer').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var customerId = selectedOption.val();
            var referralCode = selectedOption.data('referral-code'); // Assuming you pass referral code in data attribute
            var referralLink = baseUrl + "/register/" + referralCode; // Construct the referral link

            // Show the referral link container and set the referral link value
            $('#referral-link-container').show();
            $('#referral_link').val(referralLink);
        });
    });

</script>
