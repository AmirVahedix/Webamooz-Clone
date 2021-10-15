@extends('Dashboard::master')

@section('title', 'ویرایش کاربر')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('admin.users.index') }}">کاربر ها</a></li>
    <li><a href="#">ویرایش کاربر</a></li>
@endsection

@section('content')
    <div class="main-content padding-0">

        <p class="box__title">ویرایش کاربر</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                      class="padding-30">
                    @csrf
                    @method('PATCH')

                    <x-input name="name" value="{{ $user->name }}" class="text" placeholder="نام کاربر"/>
                    <x-input name="email" value="{{ $user->email }}" class="text" placeholder="ایمیل" ltr readonly/>
                    <x-input name="phone" value="{{ $user->phone }}" class="text" placeholder="شماره تلفن" ltr
                             readonly/>
                    <x-input name="username" value="{{ $user->username }}" class="text" placeholder="نام کاربری" ltr/>
                    <x-input name="headline" value="{{ $user->headline }}" class="text" placeholder="عنوان"/>
                    <x-input name="bio" value="{{ $user->bio }}" class="text" placeholder="درباره"/>
                    <x-input name="website" value="{{ $user->website }}" class="text" placeholder="وبسایت"/>
                    <x-input name="linkedin" value="{{ $user->linkedin }}" class="text" placeholder="لینکداین"/>
                    <x-input name="facebook" value="{{ $user->facebook }}" class="text" placeholder="فیسبوک"/>
                    <x-input name="twitter" value="{{ $user->twitter }}" class="text" placeholder="توییتر"/>
                    <x-input name="instagram" value="{{ $user->instagram }}" class="text" placeholder="اینستاگرام"/>
                    <x-input name="youtube" value="{{ $user->youtube }}" class="text" placeholder="یوتیوب"/>
                    <x-input name="telegram" value="{{ $user->telegram }}" class="text" placeholder="تلگرام"/>

                    <div style="margin-top: 10px">
                        <span>وضعیت ایمیل:</span>
                        <span>{{ $user->email_verified_at ? 'تایید شده' : 'تایید نشده' }}</span>
                    </div>
                    <div style="margin-top: 10px">
                        <span>وضعیت حساب:</span>
                        <span>{{ __($user->status) }}</span>
                        @if($user->status == \AmirVahedix\User\Models\User::STATUS_ACTIVE)
                            <a class="btn btn-webamooz_net"
                               href="{{ route('admin.users.ban.toggle', $user->id) }}">بن</a>
                        @elseif($user->status == \AmirVahedix\User\Models\User::STATUS_BAN)
                            <a class="btn btn-webamooz_net" href="{{ route('admin.users.ban.toggle', $user->id) }}">فعالسازی</a>
                        @endif
                    </div>
                    <div style="margin-top: 10px">
                        <span>تاریخ عضویت:</span>
                        <span>{{ jdate($user->created_at) }}</span>
                    </div>

                    <button class="btn btn-webamooz_net" style="margin-top: 28px">ثبت تغییرات</button>
                </form>
            </div>
        </div>
        <div class="row no-gutters" style="margin-top: 18px">
            <div class="col-6 margin-left-10 margin-bottom-20">
                <p class="box__title">درحال یادگیری</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دوره</th>
                            <th>نام مدرس</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr role="row" class="">
                            <td><a href="">1</a></td>
                            <td><a href="">دوره لاراول</a></td>
                            <td><a href="">صیاد اعظمی</a></td>
                        </tr>
                        <tr role="row" class="">
                            <td><a href="">1</a></td>
                            <td><a href="">دوره لاراول</a></td>
                            <td><a href="">صیاد اعظمی</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6 margin-bottom-20">
                <p class="box__title">دوره های مدرس</p>
                @if($user->hasPermissionTo('teach'))
                    <div class="table__box">
                        <table class="table">
                            <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>شناسه</th>
                                <th>نام دوره</th>
                                <th>نام مدرس</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\AmirVahedix\Course\Models\Course::where('teacher_id', $user->id)->get() as $course)
                                <tr role="row" class="">
                                    <td><a href="">{{ $course->id }}</a></td>
                                    <td><a href="">{{ $course->title }}</a></td>
                                    <td><a href="">{{ $course->teacher->name }}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="table__box" style="text-align: center">
                        <span>کاربر مدرس نیست.</span>
                    </div>
                @endif
            </div>
        </div>

    </div>


@endsection


@section('scripts')
    <script src="{{ asset('panel/js/tagsInput.js') }}"></script>
@endsection
