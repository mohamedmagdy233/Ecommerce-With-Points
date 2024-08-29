<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{$route}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$invite->id}}" name="id">

        <div class="row">
            <!-- Customer Selection -->
            <div class="col-6">
                <label for="to_customer" class="form-control-label">{{ trns('customer') }}</label>
                <select name="customer_id" id="to_customer" class="form-control">
                    <option value="" disabled selected>{{ trns('choose') }}</option>
                    @foreach($customers as $customer)
                        <option disabled value="{{ $customer->id }}" data-referral-code="{{ $customer->referral_code }}" {{ $customer->id == $invite->customer_id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>


            <!-- Input for Referral Link -->
            <div class="col-12 mt-3" id="referral-link-container">
                <label for="referral_link" class="form-control-label">{{ trns('Referral Link') }}</label>
                <input type="text" id="referral_link"  name="link" class="form-control" readonly value="{{$invite->link}}">
            </div>



            <!-- Input for points to use -->
            <div class="col-6">
                <label for="points_awarded" class="form-control-label">{{ trns('points_awarded') }}</label>
                <input type="number" id="points_awarded" name="points_awarded" class="form-control" min="0" placeholder="{{ trns('Enter points to points_awarded') }}" value="{{$invite->points_awarded}}">
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trns('close') }}</button>
            <button type="submit" class="btn btn-success" id="updateButton">{{ trns('update') }}</button>
        </div>
    </form>
</div>
<script>
    $('.dropify').dropify()
</script>

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
