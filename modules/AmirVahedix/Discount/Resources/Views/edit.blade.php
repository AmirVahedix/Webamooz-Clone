@extends('Dashboard::master')

@section('title', 'تخفیف ها')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('admin.discounts.index') }}">تخفیف ها</a></li>
    <li><a href="#">ویرایش کد تخفیف</a></li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/persianDatePicker.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="padding-30">
        <div class="col-4 bg-white">
            <p class="box__title">ویرایش کد تخفیف</p>
            <form action="{{ route('admin.discounts.update', $discount->id) }}" method="POST" class="padding-30">
                @csrf

                <x-input name="code" value="{{ $discount->code }}" type="text" placeholder="کد تخفیف" class="text"/>
                <x-input name="percent" value="{{ $discount->percent }}" type="number" placeholder="درصد تخفیف" class="text"/>
                <x-input name="limit" value="{{ $discount->limit }}" type="number" placeholder="محدودیت استفاده" class="text"/>
                <x-input name="expires_at" value="{{ jdate($discount->expires_at)->format('Y/m/d H:i') }}" type="text" placeholder="تاریخ انقضا" class="text"/>
                <span id="expires_at_span"></span>


                <div x-data="{course_select: {{ $discount->type == \AmirVahedix\Discount\Models\Discount::TYPE_SPECIAL }}}">
                    <p class="box__title mt-2">این تخفیف برای</p>

                    <div class="notificationGroup">
                        <input id="discounts-field-1" class="discounts-field-pn" name="type" value="all"
                               x-on:click="course_select=false" type="radio" {{ $discount->type == \AmirVahedix\Discount\Models\Discount::TYPE_ALL ? 'checked' : '' }}/>
                        <label for="discounts-field-1">همه دوره ها</label>
                    </div>

                    <div class="notificationGroup">
                        <input id="discounts-field-2" class="discounts-field-pn" name="type" value="special"
                               x-on:click="course_select=true" type="radio" {{ $discount->type == \AmirVahedix\Discount\Models\Discount::TYPE_SPECIAL ? 'checked' : '' }}/>
                        <label for="discounts-field-2">دوره خاص</label>
                    </div>

                    <div x-show="course_select">
                        <select class="courseSelect" name="courses[]" multiple="multiple">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $discount->courses->contains($course->id) ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <x-input name="link" value="{{ $discount->link }}" type="text" placeholder="لینک اطلاعات بیشتر" class="text"/>
                <x-input name="description" value="{{ $discount->description }}" type="text" placeholder="توضیحات" class="text margin-bottom-15"/>

                <button class="btn btn-webamooz_net mt-2">اضافه کردن</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/persianDatePicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.courseSelect').select2({
                "placeholrder": "یک یا چند دوره را انتخاب کنید..."
            });
            $("#expires_at, #expires_at_span").persianDatepicker({
                formatDate: "YYYY/0M/0D 0h:0m"
            });
        });
    </script>
@endsection
