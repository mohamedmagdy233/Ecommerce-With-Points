<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{$route}}">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="name" class="form-control-label">{{ trns('name') }}</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="phone" class="form-control-label">{{  trns('phone')}}</label>
                    <input type="text" class="form-control" name="phone" id="phone">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="address" class="form-control-label">{{  trns('address')}}</label>
                    <input type="text" class="form-control" name="address" id="address">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="password" class="form-control-label">{{ trns('password') }}</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="password" class="form-control-label">{{ trns('password_confirmation') }}</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password">
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
