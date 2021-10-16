@extends('Dashboard::master')

@section('title', 'ویرایش دوره')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('admin.courses.index') }}">دوره ها</a></li>
    <li><a href="{{ route('admin.courses.details', $season->course->id) }}">جزئیات دوره</a></li>
    <li><a href="#">سرفصل ها</a></li>
    <li><a href="#">ویرایش سرفصل</a></li>
@endsection

@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ویرایش سرفصل</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">

                <form action="{{ route('admin.seasons.update', $season->id) }}" method="POST" class="padding-30">
                    @csrf
                    @method('PATCH')

                    <x-input name="title" value="{{ $season->title }}" class="text" placeholder="عنوان سرفصل" />
                    <x-input name="number" value="{{ $season->number }}" class="text" placeholder="شماره سرفصل" />

                    <button class="btn btn-webamooz_net mt-2">ثبت تغییرات</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('panel/js/tagsInput.js') }}"></script>
@endsection
