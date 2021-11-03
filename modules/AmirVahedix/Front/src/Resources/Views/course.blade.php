@extends('Front::layouts.master')

@section('title', $course->title." - وب آموز")

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection


@section('content')
    <main id="single" class="mrt-150">
        <div class="content">
            <div class="container">
                <article class="article">
{{--                    <div class="ads mb-10">--}}
{{--                        <a href="" rel="nofollow noopener"><img src="{{ asset("img/ads/1440px/test.jpg") }}" alt=""></a>--}}
{{--                    </div>--}}
                    <div class="h-t">
                        <h1 class="title">{{ $course->title }}</h1>
                        <div class="breadcrumb">
                            <ul>
                                <li><a href="">خانه</a></li>
                                @if(isset($course->category->parent))
                                    <li><a href="">{{ $course->category->parent->title }}</a></li>
                                @endif
                                <li><a href="">{{ $course->category->title }}</a></li>
                            </ul>
                        </div>
                    </div>

                </article>
            </div>

            <div class="main-row container">
                @include("Front::layouts.course.single.sidebar")
                <div class="content-left">
                    <div class="course-description" style="margin-top: 0 !important;">
                        <div class="course-description-title">توضیحات دوره</div>
                        <div>
                            {!! $course->description !!}
                        </div>
                        <div class="tags" style="margin-top: 16px !important">
                            <ul>
                                <li><a href="">ری اکت</a></li>
                                <li><a href="">reactjs</a></li>
                                <li><a href="">جاوااسکریپت</a></li>
                                <li><a href="">javascript</a></li>
                                <li><a href="">reactjs چیست</a></li>
                            </ul>
                        </div>
                    </div>
                    @include("Front::layouts.course.single.lessons")
                </div>
            </div>
            @include('Front::layouts.comments.index', ["commentable" => $course])
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection

