@extends("Front::layouts.master")

@section('title', 'صفحه مدرس')

@section('content')
    <main id="index">
        <div class="bt-0-top article mr-202"></div>
        <div class="bt-1-top">
            <div class="container">
                <div class="tutor">
                    <div class="tutor-item">
                        <div class="tutor-avatar">
                            <span class="tutor-image" id="tutor-image">

                                <img src="{{ asset($user->user_avatar) }}" alt="{{ $user->name }}" style="border-radius: 50%" >
                            </span>
                            <div class="tutor-author-name">
                                <a id="tutor-author-name" href="" title="{{ $user->name }}">
                                    <h3 class="title"><span class="tutor-author--name">{{ $user->name }}</span></h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tutor-item">
                        <div class="stat">
                            <span class="tutor-number tutor-count-courses">
                                {{ \AmirVahedix\Course\Models\Course::where('teacher_id', $user->id)->count() }}
                            </span>
                            <span class="">تعداد دوره ها</span>
                        </div>
                        <div class="stat">

                            <span class="tutor-number">
                                {{ $user->students_count }}
                            </span>
                            <span class="">تعداد  دانشجویان</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="box-filter">
                <div class="b-head">
                    <h2>دوره های {{ $user->name }}</h2>
                </div>
                <div class="posts">
                    @foreach($user->courses as $course)
                        @include("Front::layouts.course.item")
                    @endforeach
                </div>
            </div>
{{--            <div class="pagination">--}}
{{--                <a href="" class="pg-prev"></a>--}}
{{--                <a href="" class="page current">1</a>--}}
{{--                <a href="" class="page ">2</a>--}}
{{--                <a href="" class="page ">3</a>--}}
{{--                <a href="" class="page ">4</a>--}}
{{--                <a href="" class="page ">5</a>--}}
{{--                <a href="" class="page ">6</a>--}}
{{--                <a href="" class="page ">7</a>--}}
{{--                <a href="" class="page ">...</a>--}}
{{--                <a href="" class="page ">100</a>--}}
{{--                <a href="" class="pg-next"></a>--}}
{{--            </div>--}}
        </div>
    </main>
@endsection
