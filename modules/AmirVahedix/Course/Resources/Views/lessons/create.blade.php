@extends('Dashboard::master')

@section('title', 'ایجاد درس جدید')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('admin.courses.index') }}">دوره ها</a></li>
    <li><a href="{{ route('admin.courses.details', $course->id) }}">{{ $course->title }}</a></li>
    <li><a href="#">ایجاد جلسه جدید</a></li>
@endsection

@section('content')
    <div class="main-content padding-0">
        @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
        <p class="box__title">ایجاد جلسه جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{ route('admin.lessons.store', $course->id) }}" method="POST" class="padding-30" enctype="multipart/form-data">
                    @csrf

                    <x-input name="title" class="text" placeholder="عنوان درس *" />
                    <x-input name="slug" class="text text-left " placeholder="نام انگلیسی درس (اختیاری)" />
                    <x-input type="number" name="duration" class="text text-left " placeholder="مدت زمان جلسه *" />
                    <x-input type="number" name="number" class="text text-left " placeholder="شماره جلسه (اختیاری)" />

                    @if(count($seasons))
                        <x-select name="season">
                            <option value="">انتخاب سرفصل</option>
                            @foreach($seasons as $season)
                                <option value="{{ $season->id }}">{{ $season->title }}</option>
                            @endforeach
                        </x-select>
                    @endif

                    <p class="mt-2">آیا این درس رایگان است ؟ *</p>
                    <div class="w-50">
                        <div class="notificationGroup">
                            <input id="lesson-upload-field-1" name="free" value="0" type="radio" checked/>
                            <label for="lesson-upload-field-1">خیر</label>
                        </div>
                        <div class="notificationGroup">
                            <input id="lesson-upload-field-2" name="free" value="1" type="radio"/>
                            <label for="lesson-upload-field-2">بله</label>
                        </div>
                    </div>

                    <x-file name="file" label="آپلود درس *" />

                    <x-textarea name="description" label="توضیحات درس" class="text h"></x-textarea>
                    <button class="btn btn-webamooz_net">آپلود جلسه</button>
                </form>
            </div>
        </div>
    </div>
@endsection
