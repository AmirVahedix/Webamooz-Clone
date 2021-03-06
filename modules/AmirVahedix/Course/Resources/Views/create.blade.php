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

                <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" class="padding-30">
                    @csrf

                    <x-input name="title" class="text" placeholder="عنوان دوره" required />
                    <x-input name="slug" class="text" placeholder="نام انگلیسی دوره" ltr required />

                    <div class="d-flex multi-text">
                        <x-input name="priority" class="text text-left mlg-15" placeholder="ردیف دوره" />
                        <x-input name="price" placeholder="مبلغ دوره" class="text-left text mlg-15" required />
                        <x-input name="percent" placeholder="درصد مدرس" class="text-left text" required />
                    </div>

                    <x-select name="teacher_id" >
                        <option value="">انتخاب مدرس دوره</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ $teacher->id == old('teacher_id') ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </x-select>

                    <ul class="tags" style="margin-top: 8px">
                        <li class="tagAdd taglist">
                            <input name="tags" type="text" id="search-field" placeholder="برچسب ها" />
                        </li>
                    </ul>

                    <x-select name="type" >
                        <option value="">نوع دوره</option>
                        @foreach(\AmirVahedix\Course\Models\Course::types as $type)
                            <option value="{{ $type }}" {{ $type == old('type') ? 'selected' : '' }}>
                                {{ __($type) }}
                            </option>
                        @endforeach
                    </x-select>

                    <x-select name="status" >
                        <option value="">وضعیت دوره</option>
                        @foreach(\AmirVahedix\Course\Models\Course::statuses as $status)
                            <option value="{{ $status }}" {{ $status == old('status') ? 'selected' : '' }}>
                                {{ __($status) }}
                            </option>
                        @endforeach
                    </x-select>

                    <x-select name="category_id" >
                        <option value="">دسته بندی</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </x-select>

                    <x-file name="banner" label="بنر دوره" />

                    <x-textarea name="description" label="توضیحات دوره"/>

                    <button class="btn btn-webamooz_net">ایجاد دوره</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('panel/js/tagsInput.js') }}"></script>
@endsection
