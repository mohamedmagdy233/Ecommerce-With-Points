<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{$route}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$waste->id}}" name="id">

        <div class="row">

            <div class="col-6">
                <div class="form-group">
                    <label for="name" class="form-control-label">{{ trns('name') }}</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$waste->name}}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="description" class="form-control-label">{{ trns('description') }}</label>
                    <textarea class="form-control" name="description" id="description"> {{$waste->description}}</textarea>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="value_in_points_per_unit"
                           class="form-control-label">{{ trns('value_in_points_per_unit') }}</label>
                    <input type="number" class="form-control"
                           id="value_in_points_per_unit" value="{{$waste->value_in_points/$waste->quantity}}" step="0.01">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="quantity" class="form-control-label">{{ trns('quantity') }}</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="{{$waste->quantity}}">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="value_in_points" class="form-control-label">{{ trns('value_in_points') }}</label>
                    <input type="number" class="form-control" name="value_in_points" id="value_in_points" value="{{$waste->value_in_points}}" readonly>
                </div>
            </div>

            <div class="col-6">
                <label for="customer" class="form-control-label">{{ trns('customer') }}</label>
                <select name="customer_id" class="form-control">
                    <option value="" disabled selected>{{ trns('choose') }}</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @if($waste->customer_id == $customer->id) selected @endif>{{ $customer->name }}</option>
                    @endforeach
                </select>
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
    $(document).ready(function () {
        $('#value_in_points_per_unit, #quantity').on('input', function () {
            var valueInPointsPerUnit = parseFloat($('#value_in_points_per_unit').val()) || 0;
            var quantity = parseFloat($('#quantity').val()) || 0;

            var valueInPoints = valueInPointsPerUnit * quantity;

            $('#value_in_points').val(valueInPoints);
        });
    });
</script>
