@extends('Dashboard::master')

@section('title', 'دسته‌بندی ها')

@section('styles')
    <link rel="stylesheet" href="{{ asset('panel/css/style.css') }}">
@endsection

@section('content')
    <div class="main-content padding-0 categories">
        <div class="row no-gutters">
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
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr role="row" class="" x-data="{modal: false}">
                                <td>{{ $category->id }}</td>
                                <td><a href="">{{ $category->title }}</a></td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->parent->title ?? 'دسته اصلی' }}</td>
                                <td>
                                    <a href="#" class="item-delete mlg-15" title="حذف" x-on:click="modal=true; deleteId=3"></a>
                                    <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="item-edit " title="ویرایش"></a>
                                </td>
                                <td>
                                    <div class="modal hidden" x-init="$el.classList.remove('hidden')" x-show="modal" x-transition.opacity>
                                        <div class="modal-content" x-on:click.outside="modal=false">
                                            <h3>آیا از حذف این دسته‌بندی اطمینان دارید؟</h3>
                                            <p>با کلیک بر روی حذف، این دسته‌بندی حذف خواهد شد ولی دسته‌های فرزند آن حذف نمیشود.</p>
                                            <div class="modal-actions">
                                                <button class="btn margin-left-10" x-on:click="modal=false">انصراف</button>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-webamooz_net">حذف</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
