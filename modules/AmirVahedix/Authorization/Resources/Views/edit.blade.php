@extends('Dashboard::master')

@section('title', 'ویرایش نقش کاربری')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('admin.authorization.index') }}">نقش‌های کاربری</a></li>
    <li><a href="#">ویرایش نقش کاربری</a></li>
@endsection

@section('content')
    <div class="row no-gutters padding-30 margin-bottom-20">
        <div class="col-12">
            <p class="box__title">ویرایش نقش کاربری</p>
            <form action="{{ route('admin.authorization.update', $role->id) }}" method="post" class="padding-30 bg-white">
                @csrf
                @method('PATCH')

                <x-input name="name" value="{{ $role->name }}" placeholder="نام نقش کاربری" class="text" required/>

                @foreach($permissions as $permission)
                    <label class="ui-checkbox">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                            {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <span class="checkbox__label">{{ __($permission->name) }}</span>
                        <span class="checkmark"></span>
                    </label>
                @endforeach

                @error('permissions')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span><br>
                @enderror

                <button class="btn btn-webamooz_net">ثبت تغییرات</button>
            </form>
        </div>
    </div>
 @endsection
