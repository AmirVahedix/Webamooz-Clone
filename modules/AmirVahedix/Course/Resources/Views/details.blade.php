@extends('Dashboard::master')

@section('title', 'جزئیات دوره')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('admin.courses.index') }}">دوره ها</a></li>
    <li><a href="#">{{ $course->title }}</a></li>
@endsection

@section('content')
    <div class="main-content course__detial">
        <div class="row no-gutters  ">
            <div class="col-8 bg-white padding-30 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="margin-bottom-30 align-items-center flex-wrap font-size-14 d-flex bg-white padding-0">
                    <p class="mlg-15">دوره مقدماتی تا پیشرفته لاراول</p>
                    <a class="btn btn-webamooz_net" href="{{ route('admin.lessons.create', $course->id) }}">آپلود جلسه
                        جدید</a>
                </div>
                <div class="d-flex item-center flex-wrap margin-bottom-15 operations__btns">
                    <form action="{{ route('admin.lessons.acceptAll', $course->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn all-confirm-btn">تایید همه جلسات</button>
                    </form>
                    <button id="accept-multiple" class="btn confirm-btn" style="margin-right: 8px;">تایید جلسات</button>
                    <form action="{{ route('admin.lessons.accept.multiple', $course->id) }}"
                          id="acceptMultipleLessonsForm" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="acceptMultipleLessonsInput" name="lessons" value="">
                    </form>
                    <button id="reject-multiple" class="btn reject-btn">رد جلسات</button>
                    <form action="{{ route('admin.lessons.reject.multiple', $course->id) }}"
                          id="rejectMultipleLessonsForm" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="rejectMultipleLessonsInput" name="lessons" value="">
                    </form>
                    <button class="btn delete-btn">حذف جلسات</button>
                    <form action="{{ route('admin.lessons.delete.multiple', $course->id) }}"
                          id="deleteMultipleLessonsForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deleteMultipleLessonsInput" name="lessons" value="">
                    </form>
                </div>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th style="padding: 13px 30px;">
                                <label class="ui-checkbox">
                                    <input type="checkbox" class="checkedAll">
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                            <th>ردیف</th>
                            <th>عنوان جلسه</th>
                            <th>عنوان فصل</th>
                            <th>مدت زمان جلسه</th>
                            <th>وضعیت تایید</th>
                            <th>سطح دسترسی</th>
                            <th>عملیات</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lessons as $lesson)
                            <tr role="row" class="" data-row-id="{{ $lesson->id }}" x-data="{delete_modal:false}">
                                <td>
                                    <label class="ui-checkbox">
                                        <input type="checkbox" class="sub-checkbox" data-id="{{ $lesson->id }}">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>{{ $lesson->number }}</td>
                                <td>{{ $lesson->title }}</td>
                                <td>{{ $lesson->season->title ?? '' }}</td>
                                <td>{{ $lesson->duration }} دقیقه</td>
                                <td>{{ __($lesson->confirmation_status) }}</td>
                                <td>{{ $lesson->free ? 'همه' : 'شرکت کنندگان' }}</td>
                                <td>
                                    <a x-on:click="delete_modal=true" class="item-delete mlg-15 cursor-pointer"
                                       title="حذف"></a>
                                    @unless($lesson->confirmation_status == \AmirVahedix\Course\Models\Lesson::CONFIRMATION_ACCEPTED)
                                        <a href="{{ route('admin.lessons.accept', [$course->id, $lesson->id]) }}" class="item-confirm mlg-15" title="تایید"></a>
                                    @endunless
                                    @unless($lesson->confirmation_status == \AmirVahedix\Course\Models\Lesson::CONFIRMATION_REJECTED)
                                        <a href="{{ route('admin.lessons.reject', [$course->id, $lesson->id]) }}" class="item-reject mlg-15" title="رد"></a>
                                    @endunless
                                    <a href="{{ route('admin.lessons.edit', [$course->id, $lesson->id]) }}" class="item-edit " title="ویرایش"></a>
                                </td>
                                <td>
                                    <div class="modal hidden" x-init="$el.classList.remove('hidden')"
                                         x-show="delete_modal" x-transition.opacity>
                                        <div class="modal-content" x-on:click.outside="delete_modal=false">
                                            <h3>آیا از حذف این جلسه اطمینان دارید؟</h3>
                                            <p>با کلیک بر روی حذف، این جلسه و فایل های مربوط به آن حذف میشود.</p>
                                            <div class="modal-actions">
                                                <button class="btn margin-left-10" x-on:click="delete_modal=false">
                                                    انصراف
                                                </button>
                                                <form
                                                    action="{{ route('admin.lessons.destroy', [$lesson->course->id, $lesson->id]) }}"
                                                    method="POST">
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
            <div class="col-4">
                @include('Course::season.index')
                <div class="col-12 bg-white margin-bottom-15 border-radius-3">
                    <p class="box__title">اضافه کردن دانشجو به دوره</p>
                    <form action="" method="post" class="padding-30">
                        <select name="" id="">
                            <option value="0">انتخاب کاربر</option>
                            <option value="1">mohammadniko3@gmail.com</option>
                            <option value="2">sayad@gamil.com</option>
                        </select>
                        <input type="text" placeholder="مبلغ دوره" class="text">
                        <p class="box__title">کارمزد مدرس ثبت شود ؟</p>
                        <div class="notificationGroup">
                            <input id="course-detial-field-1" name="course-detial-field" type="radio" checked/>
                            <label for="course-detial-field-1">بله</label>
                        </div>
                        <div class="notificationGroup">
                            <input id="course-detial-field-2" name="course-detial-field" type="radio"/>
                            <label for="course-detial-field-2">خیر</label>
                        </div>
                        <button class="btn btn-webamooz_net">اضافه کردن</button>
                    </form>
                    <div class="table__box padding-30">
                        <table class="table">
                            <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th class="p-r-90">شناسه</th>
                                <th>نام و نام خانوادگی</th>
                                <th>ایمیل</th>
                                <th>مبلغ (تومان)</th>
                                <th>درامد شما</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="">
                                <td><a href="">1</a></td>
                                <td><a href="">توفیق حمزه ای</a></td>
                                <td><a href="">Mohammadniko3@gmail.com</a></td>
                                <td><a href="">40000</a></td>
                                <td><a href="">20000</a></td>
                                <td>
                                    <a href="" class="item-delete mlg-15" title="حذف"></a>
                                    <a href="" class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
