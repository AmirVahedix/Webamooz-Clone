@extends('Dashboard::master')

@section('title', 'دسته‌بندی ها')

@section('content')
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام</th>
                            <th>اسلاگ</th>
                            <th>دسته پدر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr role="row" class="">
                                <td>{{ $category->id }}</td>
                                <td><a href="">{{ $category->title }}</a></td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->parent->title ?? 'دسته اصلی' }}</td>
                                <td>
                                    <a href="" class="item-delete mlg-15" title="حذف"></a>
                                    <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 bg-white">
                @include('Category::create')
            </div>
        </div>
    </div>
@endsection
