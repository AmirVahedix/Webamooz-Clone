@extends('Dashboard::master')

@section('title', 'ویرایش درس')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('admin.courses.index') }}">دوره ها</a></li>
    <li><a href="{{ route('admin.courses.details', $course->id) }}">{{ $course->title }}</a></li>
    <li><a href="#">{{ $lesson->title }}</a></li>
@endsection

@section('content')
    <div class="main-content padding-0">
        @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
            <p class="box__title">ویرایش درس</p>
            <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{ route('admin.lessons.update', [$course->id, $lesson->id]) }}" method="POST" class="padding-30" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <x-input name="title" value="{{ $lesson->title }}" class="text" placeholder="عنوان درس *" />
                    <x-input name="slug" value="{{ $lesson->slug }}" class="text text-left " placeholder="نام انگلیسی درس (اختیاری)" />
                    <x-input type="number" value="{{ $lesson->duration }}" name="duration" class="text text-left " placeholder="مدت زمان جلسه *" />
                    <x-input type="number" value="{{ $lesson->number }}" name="number" class="text text-left " placeholder="شماره جلسه (اختیاری)" />

                    @if(count($seasons))
                        <x-select name="season">
                            <option value="">انتخاب سرفصل</option>
                            @foreach($seasons as $season)
                                <option value="{{ $season->id }}" {{ $season->id == $lesson->season->id ? 'selected' : '' }}>{{ $season->title }}</option>
                            @endforeach
                        </x-select>
                    @endif

                    <p class="mt-2">آیا این درس رایگان است ؟ *</p>
                    <div class="w-50">
                        <div class="notificationGroup">
                            <input id="lesson-upload-field-1" name="free" value="0" type="radio" {{ $lesson->free ? '' : 'checked' }}/>
                            <label for="lesson-upload-field-1">خیر</label>
                        </div>
                        <div class="notificationGroup">
                            <input id="lesson-upload-field-2" name="free" value="1" type="radio" {{ $lesson->free ? 'checked' : '' }}/>
                            <label for="lesson-upload-field-2">بله</label>
                        </div>
                    </div>

                    <span>{{ $lesson->media->filename }}</span>
                    <x-file name="file" label="آپلود درس *" />

                    <x-textarea name="description" value="{{ $lesson->description }}" label="توضیحات درس" class="text h"></x-textarea>
                    <button class="btn btn-webamooz_net">آپلود جلسه</button>
                </form>
            </div>
        </div>
    </div>
@endsection
