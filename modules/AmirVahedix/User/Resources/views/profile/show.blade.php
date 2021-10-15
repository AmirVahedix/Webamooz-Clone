@extends('Dashboard::master')

@section('title', 'اطلاعات کاربری')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="#">اطلاعات کاربری</a></li>
@endsection

@section('content')
    <div class="main-content padding-0">

        <p class="box__title">اطلاعات کاربری</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">

                <form action="{{ route('users.profile.update') }}" method="POST" enctype="multipart/form-data"
                      class="padding-30">
                    @csrf
                    @method('PATCH')

                    <x-input name="name" value="{{ auth()->user()->name }}" class="text" placeholder="نام کاربر"/>
                    <x-input name="email" value="{{ auth()->user()->email }}" class="text" placeholder="ایمیل" ltr readonly/>
                    <x-input name="phone" value="{{ auth()->user()->phone }}" class="text" placeholder="شماره تلفن" ltr
                             readonly/>
                    <x-input name="username" value="{{ auth()->user()->username }}" class="text" placeholder="نام کاربری" ltr/>
                    <span>https://webamooz.net/toturs/{{ auth()->user()->username ?? 'username' }}</span>
                    <x-input name="headline" value="{{ auth()->user()->headline }}" class="text" placeholder="عنوان"/>
                    <x-textarea label="درباره من" name="bio" value="{{ auth()->user()->bio }}" class="text" placeholder="درباره"/>
                    <x-input name="website" value="{{ auth()->user()->website }}" class="text" placeholder="وبسایت"/>
                    <x-input name="linkedin" value="{{ auth()->user()->linkedin }}" class="text" placeholder="لینکداین"/>
                    <x-input name="facebook" value="{{ auth()->user()->facebook }}" class="text" placeholder="فیسبوک"/>
                    <x-input name="twitter" value="{{ auth()->user()->twitter }}" class="text" placeholder="توییتر"/>
                    <x-input name="instagram" value="{{ auth()->user()->instagram }}" class="text" placeholder="اینستاگرام"/>
                    <x-input name="youtube" value="{{ auth()->user()->youtube }}" class="text" placeholder="یوتیوب"/>
                    <x-input name="telegram" value="{{ auth()->user()->telegram }}" class="text" placeholder="تلگرام"/>

                    <span>تغییر رمز عبور</span>
                    <x-input type="password" name="password" class="text" placeholder="رمزعبور جدید"/>

                    <button class="btn btn-webamooz_net" style="margin-top: 28px">ثبت تغییرات</button>
                </form>
            </div>
        </div>
    </div>


@endsection


@section('scripts')
    <script src="{{ asset('panel/js/tagsInput.js') }}"></script>
@endsection
