@extends('Dashboard::master')

@section('title', 'ایجاد دوره جدید')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="#">دوره ها</a></li>
@endsection

@section('content')
    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="courses.html">لیست دوره ها</a>
                <a class="tab__item" href="approved.html">دوره های تایید شده</a>
                <a class="tab__item" href="new-course.html">دوره های تایید نشده</a>
                <a class="tab__item" href="{{ route('admin.courses.create') }}">ایجاد دوره جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی دوره">
                        <div class="t-header-search-content ">
                            <input type="text" class="text" placeholder="نام دوره">
                            <input type="text" class="text" placeholder="ردیف">
                            <input type="text" class="text" placeholder="قیمت">
                            <input type="text" class="text" placeholder="نام مدرس">
                            <input type="text" class="text margin-bottom-20" placeholder="دسته بندی">
                            <btutton class="btn btn-webamooz_net">جستجو</btutton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table__box">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>ردیف</th>
                    <th>بنر</th>
                    <th>عنوان</th>
                    <th>مدرس دوره</th>
                    <th>قیمت (تومان)</th>
                    <th>درصد مدرس</th>
                    <th>جزئیات</th>
                    <th>تراکنش ها</th>
                    <th>نظرات</th>
                    <th>تعداد دانشجویان</th>
                    <th>تعداد تایید</th>
                    <th>وضعیت دوره</th>
                    <th>عملیات</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr role="row" x-data="{modal: false}">
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->priority }}</td>
                        <td><img src="{{ $course->thumb }}" alt="{{ $course->title }}" width="100"></td>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->teacher->name }}</td>
                        <td>{{ $course->price ? number_format($course->price) : 'رایگان' }}</td>
                        <td>{{ $course->percent }}%</td>
                        <td><a href="course-detail.html" class="color-2b4a83">مشاهده</a></td>
                        <td><a href="course-transaction.html" class="color-2b4a83">مشاهده</a></td>
                        <td><a href="" class="color-2b4a83">مشاهده (10 نظر)</a></td>
                        <td>120</td>
                        <td>تایید شده</td>
                        <td>{{ __($course->status) }}</td>
                        <td>
                            <a href="#" class="item-delete mlg-15" x-on:click="modal=true" title="حذف"></a>
                            <a href="" class="item-reject mlg-15" title="رد"></a>
                            <a href="" class="item-lock mlg-15" title="قفل دوره"></a>
                            <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            <a href="" class="item-confirm mlg-15" title="تایید"></a>
                            <a href="" class="item-edit " title="ویرایش"></a>
                        </td>
                        <td>
                            <div class="modal hidden" x-init="$el.classList.remove('hidden')" x-show="modal" x-transition.opacity>
                                <div class="modal-content" x-on:click.outside="modal=false">
                                    <h3>آیا از حذف این دوره اطمینان دارید؟</h3>
                                    <p>با کلیک بر روی حذف، این دوره، سرفصل ها و تمامی جلسات آن حذف میشود.</p>
                                    <div class="modal-actions">
                                        <button class="btn margin-left-10" x-on:click="modal=false">انصراف</button>
                                        <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST">
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
@endsection
