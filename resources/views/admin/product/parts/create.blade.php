<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{$route}}">
        @csrf
        <div class="row">

            <div class="form-group">
                <label for="name" class="form-control-label">الصورة</label>
                <input type="file" class="dropify" name="image"
                       data-default-file="{{ asset('assets/uploads/avatar.png') }}"
                       accept="image/png,image/webp , image/gif, image/jpeg,image/jpg" />

            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="name" class="form-control-label">{{ trns('name') }}</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="description" class="form-control-label">{{ trns('description') }}</label>
                    <textarea  class="form-control" name="description" id="description"></textarea>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="quantity" class="form-control-label">{{  trns('quantity')}}</label>
                    <input type="number" class="form-control" name="quantity" id="quantity">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="price" class="form-control-label">{{  trns('price')}}</label>
                    <input type="number" class="form-control" name="price" id="price" step="0.01">
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
    $('.dropify').dropify();
</script>
