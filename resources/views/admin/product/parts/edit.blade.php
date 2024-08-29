<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{$route}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$product->id}}" name="id">

        <div class="row">

            <div class="form-group">
                <label for="name" class="form-control-label">الصورة</label>
                <input type="file" class="dropify" name="image"
                       data-default-file="{{isset($product->image) ? asset('storage/'.$product->image) : asset('assets/uploads/avatar.png') }}"
                       accept="image/png,image/webp , image/gif, image/jpeg,image/jpg" />

            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="name" class="form-control-label">{{ trns('name') }}</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$product->name}}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="description" class="form-control-label">{{ trns('description') }}</label>
                    <textarea  class="form-control" name="description" id="description"> {{$product->description}}</textarea>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="quantity" class="form-control-label">{{  trns('quantity')}}</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="{{$product->quantity}}">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="price" class="form-control-label">{{  trns('price')}}</label>
                    <input type="number" class="form-control" name="price" id="price" step="0.01" value="{{$product->price}}">
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
