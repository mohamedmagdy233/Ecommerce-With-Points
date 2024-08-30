<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{$route}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$customer->id}}" name="id">

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="name" class="form-control-label">{{ trns('name') }}</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$customer->name}}">
                </div>
            </div>


            <div class="col-6">
                <div class="form-group">
                    <label for="phone" class="form-control-label">{{  trns('phone')}}</label>
                    <input type="text" class="form-control" name="phone" id="phone"  value="{{$customer->phone}}">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="address" class="form-control-label">{{  trns('address')}}</label>
                    <input type="text" class="form-control" name="address" id="address"  value="{{$customer->address}}">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="points" class="form-control-label">{{  trns('points')}}</label>
                    <input type="text" class="form-control" name="points" id="points"  value="{{$customer->points}}">
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
            <button type="submit" class="btn btn-success" id="updateButton">{{ trns('update') }}</button>
        </div>
    </form>
</div>
<script>
    $('.dropify').dropify()
</script>
