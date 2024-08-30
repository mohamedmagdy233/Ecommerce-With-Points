<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{$route}}">
        @csrf
        <div class="row">
            <div class="col-6">
                <label for="waste_section" class="form-control-label">{{ trns('section') }}</label>
                <select name="waste_section_id" class="form-control">
                    <option value="" disabled selected>{{ trns('choose') }}</option>
                    @foreach($wasteSections as $wasteSection)
                        <option value="{{ $wasteSection->id }}" data-point_per_one="{{ $wasteSection->point_per_one }}">{{ $wasteSection->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <label for="customer" class="form-control-label">{{ trns('customer') }}</label>
                <select name="customer_id" class="form-control">
                    <option value="" disabled selected>{{ trns('choose') }}</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="quantity" class="form-control-label">{{ trns('quantity') }}</label>
                    <input type="number" class="form-control" name="quantity" id="quantity">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="points_transferred" class="form-control-label">{{ trns('points_transferred') }}</label>
                    <input type="number" class="form-control" name="points_transferred" id="points_transferred" readonly>
                </div>
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
