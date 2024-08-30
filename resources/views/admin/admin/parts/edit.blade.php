<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{route('admins.update',$admin->id)}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$admin->id}}" name="id">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="name" class="form-control-label">{{  trns('name')}}</label>
                    <input type="text" class="form-control" name="name" value="{{$admin->name}}" id="name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="name" class="form-control-label">{{  trns('user_name')}}</label>
                    <input type="text" class="form-control" name="user_name" value="{{$admin->user_name}}" id="user_name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="code" class="form-control-label">{{ trns('code') }}</label>
                    <span class="form-control text-center">{{ $admin->code }}</span>
                    <input hidden type="hidden" class="form-control" name="code" value="{{ $admin->code }}" id="code">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email" class="form-control-label">{{ trns('email') }}</label>
                    <input type="text" class="form-control" name="email" value="{{$admin->email}}" id="email">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="phone" class="form-control-label">{{ trns('phone') }}</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{$admin->phone}}">
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
            <div class="col-12">
                <div class="form-group">
                    <label for="permissions" class="form-control-label">{{ trns('system_permissions') }}</label>
                    <select class="form-control" name="permissions[]" id="permissions" multiple>
                        <option value="">{{ trns('select_permissions') }}</option>
                        @foreach(\App\Enums\RoleEnum::cases() as $permission)
                            <option value="{{ $permission->value }}" {{ in_array($permission->value, old('permissions', $user->permissions ?? [])) ? 'selected' : '' }}>
                                {{ $permission->value }}
                            </option>
                        @endforeach
                    </select>
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
