<p class="box__title">ایجاد نقش کاربری جدید</p>
<form action="{{ route('admin.authorization.store') }}" method="post" class="padding-30">
    @csrf

    <x-input name="name" placeholder="عنوان نقش" class="text" required />

    @foreach($permissions as $permission)
        <x-checkbox title="{{ __($permission->name) }}" name="permissions[]" value="{{ $permission->id }}"  />
    @endforeach

    @error('permissions')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span><br>
    @enderror

    <button class="btn btn-webamooz_net" style="margin-top: 16px;">اضافه کردن</button>
</form>
