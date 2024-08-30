<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{$route}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$category->id}}" name="id">

        <div class="row">

            <div class="form-group">
                <label for="name" class="form-control-label">الصورة</label>
                <input type="file" class="dropify" name="image"
                       data-default-file="{{isset($category->image) ? asset('storage/'.$category->image) : asset('assets/uploads/avatar.png') }}"
                       accept="image/png,image/webp , image/gif, image/jpeg,image/jpg" />

            </div>


            <div class="col-12">
                <div class="form-group">
                    <label for="name" class="form-control-label">{{ trns('name') }}</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}">
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
