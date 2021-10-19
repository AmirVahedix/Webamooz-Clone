@extends('Front::layouts.master')

@section('title', 'وب آموز - مرجع آموزش برنامه نویسی')

@section('content')
    <article class="container article">
        <main id="index">
            @include("Front::layouts.main.ads")
            <div class="top-info">
                @include("Front::layouts.main.slider")
                @include("Front::layouts.main.banners")
            </div>
            @include("Front::layouts.course.newest")
            @include("Front::layouts.course.popular")
            @include("Front::layouts.articles")
        </main>
    </article>
@endsection
