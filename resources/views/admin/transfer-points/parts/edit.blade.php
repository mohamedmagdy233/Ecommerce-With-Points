<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{$route}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$transferPoints->id}}" name="id">

        <div class="row">

            <div class="col-6">
                <label for="from_customer" class="form-control-label">{{ trns('from') }}</label>
                <select name="from_id" id="from_customer" class="form-control">
                    <option value="" disabled selected>{{ trns('choose') }}</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" data-points="{{ $customer->points }}" {{ $transferPoints->from_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
                <!-- Hint element for "from_customer" -->
                <small id="fromHint" class="form-text text-muted" style="display: none; color: red;"></small>
            </div>

            <div class="col-6">
                <label for="to_customer" class="form-control-label">{{ trns('to') }}</label>
                <select name="to_id" id="to_customer" class="form-control">
                    <option value="" disabled selected>{{ trns('choose') }}</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $transferPoints->to_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="points" class="form-control-label">{{ trns('points') }}</label>
                    <input type="number" class="form-control" name="points" id="points" min="0" value="{{$transferPoints->points}}">
                </div>
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
        $('#from_customer').on('change', function() {
            var selectedFromId = $(this).val();
            var selectedFromPoints = $(this).find('option:selected').data('points'); // Get points data attribute

            // Reset to_customer options
            $('#to_customer option').prop('disabled', false).css('color', '');

            if (selectedFromId) {
                // Disable selected from customer in to_customer dropdown
                $('#to_customer option[value="' + selectedFromId + '"]').prop('disabled', true).css('color', 'red');

                // Show hint for available points
                $('#fromHint').text('{{ trns('this_customer_has') }} ' + selectedFromPoints + ' {{ trns('points') }}').show();

                // Set max attribute for points input and reset input value
                $('#points').attr('max', selectedFromPoints).val('');

                // Hide the points hint initially
                $('#pointsHint').hide();
            } else {
                // Hide all hints and reset max attribute when no customer is selected
                $('#fromHint').hide();
                $('#points').removeAttr('max');
                $('#pointsHint').hide();
            }
        });

        $('#points').on('input', function() {
            var maxPoints = $(this).attr('max');
            var enteredPoints = $(this).val();

            if (enteredPoints > maxPoints) {
                $('#pointsHint').text('{{ trns('points_exceed') }} ' + maxPoints + ' {{ trns('available_points') }}').show();
            } else {
                $('#pointsHint').hide();
            }
        });

    });

</script>
