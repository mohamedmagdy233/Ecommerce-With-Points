<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{$route}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$waste->id}}" name="id">

        <div class="row">
            <div class="col-6">
                <label for="waste_section" class="form-control-label">{{ trns('section') }}</label>
                <select name="waste_section_id" class="form-control">
                    <option value="" disabled selected>{{ trns('choose') }}</option>
                    @foreach($wasteSections as $wasteSection)
                        <option value="{{ $wasteSection->id }}" data-point_per_one="{{ $wasteSection->point_per_one }}" @if($wasteSection->id == $waste->waste_section_id) selected @endif>{{ $wasteSection->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <label for="customer" class="form-control-label">{{ trns('customer') }}</label>
                <select name="customer_id" class="form-control">
                    <option value="" disabled selected>{{ trns('choose') }}</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @if($customer->id == $waste->customer_id) selected @endif>{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="quantity" class="form-control-label">{{ trns('quantity') }}</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="{{$waste->quantity}}">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="points_transferred" class="form-control-label">{{ trns('points_transferred') }}</label>
                    <input type="number" class="form-control" name="points_transferred" id="points_transferred" readonly value="{{$waste->points_transferred}}">
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
        // Function to calculate points transferred
        function calculatePoints() {
            var pointPerOne = parseFloat($('select[name="waste_section_id"] option:selected').data('point_per_one')) || 0;
            var quantity = parseInt($('#quantity').val()) || 0;
            var totalPoints = pointPerOne * quantity;

            $('#points_transferred').val(totalPoints); // Set calculated points to the input field
        }

        // Trigger calculation when waste section or quantity changes
        $('select[name="waste_section_id"]').on('change', calculatePoints);
        $('#quantity').on('input', calculatePoints);
    });

    $('.dropify').dropify();
</script>
