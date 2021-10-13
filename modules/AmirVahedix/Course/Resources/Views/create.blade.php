@extends('Dashboard::master')

@section('title', 'ایجاد دوره جدید')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('admin.courses.index') }}">دوره ها</a></li>
    <li><a href="#">ایجاد دوره جدید</a></li>
@endsection

@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ایجاد دوره جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">

                <form action="{{ route('admin.courses.store') }}" method="POST" class="padding-30">
                    @csrf

                    <x-input name="title" class="text" placeholder="عنوان دوره" required />
                    <x-input name="slug" class="text" placeholder="نام انگلیسی دوره" ltr required />

                    <div class="d-flex multi-text">
                        <x-input name="priority" class="text text-left mlg-15" placeholder="ردیف دوره" />
                        <x-input name="price" placeholder="مبلغ دوره" class="text-left text mlg-15" required />
                        <x-input name="percent" placeholder="درصد مدرس" class="text-left text" required />
                    </div>
                    <select name="teacher_id" class="custom-select" required>
                        <option value="0">انتخاب مدرس دوره</option>
                        @foreach($teachers as $teacher)
                            <option value="1">محمد نیکو</option>
                        @endforeach
                    </select>
                    <ul class="tags" style="margin-top: 8px">
                        <li class="tagAdd taglist">
                            <input name="tags" type="text" id="search-field" placeholder="برچسب ها" />
                        </li>
                    </ul>
                    <select class="custom-select" name="type" required>
                        <option value="0">نوع دوره</option>
                        <option value="1">نقدی</option>
                        <option value="2">رایگان</option>
                    </select>
                    <select class="custom-select" name="status" required>
                        <option value="0">وضعیت دوره</option>
                        <option value="1">درحال برگزاری</option>
                        <option value="2">تکمیل</option>
                        <option value="3">قفل شده</option>
                    </select>
                    <select class="custom-select" name="category_id" required>
                        <option value="0">دسته بندی</option>
                        <option value="1">برنامه نویسی</option>
                        <option value="2">گرافیک</option>
                        <option value="3">کسب کار</option>
                    </select>
                    <div class="file-upload">
                        <div class="i-file-upload">
                            <span>آپلود بنر دوره</span>
                            <input name="banner" type="file" class="file-upload" id="files" required/>
                        </div>
                        <span class="filesize"></span>
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    </div>
                    <textarea name="description" placeholder="توضیحات دوره" class="text h" required></textarea>
                    <button class="btn btn-webamooz_net">ایجاد دوره</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('panel/js/tagsInput.js') }}"></script>
@endsection
