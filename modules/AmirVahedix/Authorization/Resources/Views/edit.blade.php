@extends('Dashboard::master')

@section('title', 'ویرایش دسته‌بندی')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('admin.categories.index') }}">دسته‌بندی ها</a></li>
    <li><a href="#">ویرایش دسته‌بندی</a></li>
@endsection

@section('content')
    <div class="row no-gutters padding-30 margin-bottom-20">
        <div class="col-12">
            <p class="box__title">ویرایش دسته‌بندی</p>
            <form action="{{ route('admin.categories.update', $category->id) }}" method="post" class="padding-30 bg-white">
                @csrf
                @method('PATCH')

                <x-input name="title" value="{{ $category->title }}" placeholder="نام دسته‌بندی" class="text" required/>
                <x-input name="slug" value="{{ $category->slug }}" placeholder="نام انگلیسی دسته‌بندی" class="text" ltr requierd/>

                <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                <select class="custom-select" name="parent_id" id="parent_id">
                    <option value="">بدون دسته پدر</option>
                    @foreach($categories as $cate)
                        @continue($cate->id == $category->id)

                        <option value="{{ $cate->id }}" {{ $category->parent_id == $cate->id ? 'selected' : '' }}>
                            {{ $cate->title }}
                        </option>
                    @endforeach
                </select>

                <button class="btn btn-webamooz_net">ثبت تغییرات</button>
            </form>
        </div>
    </div>
 @endsection
