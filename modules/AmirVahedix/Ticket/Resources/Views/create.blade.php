@extends('Dashboard::master')

@section('title', 'تیکت ها')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('dashboard.tickets.index') }}">تیکت ها</a></li>
    <li><a href="#">ایجاد تیکت</a></li>
@endsection

@section('content')
    <div class="main-content padding-30">
        <p class="box__title">ایجاد تیکت جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="" class="padding-30">
                    <x-input name="title" class="text" placeholder="عنوان تیکت" />
                    <x-textarea name="body" label="متن تیکت" class="text" />
                    <x-file name="media" label="انتخاب فایل پیوست" />

                    <button class="btn btn-webamooz_net">ایجاد مقاله</button>
                </form>
            </div>
        </div>
    </div>
@endsection
