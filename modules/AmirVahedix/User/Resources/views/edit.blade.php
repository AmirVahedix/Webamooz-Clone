@extends('Dashboard::master')

@section('title', 'ویرایش کاربر')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('admin.courses.index') }}">کاربر ها</a></li>
    <li><a href="#">ویرایش کاربر</a></li>
@endsection

@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ویرایش کاربر</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="padding-30">
                    @csrf
                    @method('PATCH')

                    <x-input name="name" value="{{ $user->name }}" class="text" placeholder="نام کاربر" />
                    <x-input name="email" value="{{ $user->email }}" class="text" placeholder="ایمیل" ltr readonly />
                    <x-input name="phone" value="{{ $user->phone }}" class="text" placeholder="شماره تلفن" ltr readonly />
                    <x-input name="username" value="{{ $user->username }}" class="text" placeholder="نام کاربری" ltr />
                    <x-input name="headline" value="{{ $user->headline }}" class="text" placeholder="عنوان" />
                    <x-input name="bio" value="{{ $user->bio }}" class="text" placeholder="درباره" />
                    <x-input name="website" value="{{ $user->website }}" class="text" placeholder="وبسایت" />
                    <x-input name="linkedin" value="{{ $user->linkedin }}" class="text" placeholder="لینکداین" />
                    <x-input name="facebook" value="{{ $user->facebook }}" class="text" placeholder="فیسبوک" />
                    <x-input name="twitter" value="{{ $user->twitter }}" class="text" placeholder="توییتر" />
                    <x-input name="instagram" value="{{ $user->instagram }}" class="text" placeholder="اینستاگرام" />
                    <x-input name="youtube" value="{{ $user->youtube }}" class="text" placeholder="یوتیوب" />
                    <x-input name="telegram" value="{{ $user->telegram }}" class="text" placeholder="تلگرام" />

                    <div style="margin-top: 10px">
                        <span>وضعیت ایمیل:</span>
                        <span>{{ $user->email_verified_at ? 'تایید شده' : 'تایید نشده' }}</span>
                    </div>
                    <div style="margin-top: 10px">
                        <span>وضعیت حساب:</span>
                        <span>{{ __($user->status) }}</span>
                        <a class="btn btn-webamooz_net">بن</a>
                    </div>
                    <div style="margin-top: 10px">
                        <span>تاریخ عضویت:</span>
                        <span>{{ jdate($user->created_at) }}</span>
                    </div>

                    <button class="btn btn-webamooz_net" style="margin-top: 28px">ثبت تغییرات</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('panel/js/tagsInput.js') }}"></script>
@endsection
