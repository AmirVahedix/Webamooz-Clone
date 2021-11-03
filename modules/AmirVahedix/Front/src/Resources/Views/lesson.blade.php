@extends('Front::layouts.master')

@section('title', $lesson->title)

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
                    @if($lesson->media && $lesson->media->type == "video")
                        <div class="preview">
                            <video width="100%" controls>
                                <source src="{{ $lesson->downloadLink() }}" type="video/mp4">
                            </video>
                        </div>
                    @endif
                    <a href="{{ $lesson->downloadLink() }}" class="episode-download">دانلود قسمت {{ $lesson->number }}</a>
                    <div class="course-description">
                        <div class="course-description-title">توضیحات جلسه</div>
                        <div class="mt-2">
                            {!! $lesson->description !!}
                        </div>
                    </div>
                    @include("Front::layouts.course.single.lessons")
                </div>
            </div>
            {{-- comments --}}
            @include("Front::layouts.comments.index")
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection
