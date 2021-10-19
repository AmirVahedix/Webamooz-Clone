@extends('Front::layouts.master')

@section('title', $course->title." - وب آموز")

@section('content')
    <main id="single" class="mrt-150">
        <div class="content">
            <div class="container">
                <article class="article">
                    <div class="ads mb-10">
                        <a href="" rel="nofollow noopener"><img src="{{ asset("img/ads/1440px/test.jpg") }}" alt=""></a>
                    </div>
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
{{--                    <div class="preview">--}}
{{--                        <video width="100%" controls>--}}
{{--                            <source src="intro.mp4" type="video/mp4">--}}
{{--                        </video>--}}
{{--                    </div>--}}
{{--                    <a href="#" class="episode-download">دانلود این قسمت (قسمت 1)</a>--}}
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
            <div class="container">
                <div class="comments">
                    <div class="comment-main">
                        <div class="ct-header">
                            <h3>نظرات ( 180 )</h3>
                            <p>نظر خود را در مورد این مقاله مطرح کنید</p>
                        </div>
                        <form action="" method="post">
                            <div class="ct-row">
                                <div class="ct-textarea">
                                    <textarea class="txt ct-textarea-field"></textarea>
                                </div>
                            </div>
                            <div class="ct-row">
                                <div class="send-comment">
                                    <button class="btn i-t">ثبت نظر</button>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="comments-list">
                        <div id="Modal2" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p>ارسال پاسخ</p>
                                    <div class="close">&times;</div>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="">
                                        <textarea class="txt hi-220px" placeholder="متن دیدگاه"></textarea>
                                        <button class="btn i-t">ثبت پاسخ</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <ul class="comment-list-ul">
                            <div class="div-btn-answer">
                                <button class="btn-answer">پاسخ به دیدگاه</button>
                            </div>
                            <li class="is-comment">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/profile.jpg">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">کاربر : گوگل گوگل گوگل گوگل</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                    </p>
                                </div>
                            </li>
                            <li class="is-answer">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/laravel-pic.png">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">مدیر سایت : محمد نیکو</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                    </p>
                                </div>
                            </li>
                            <li class="is-comment">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/profile.jpg">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">کاربر : گوگل</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                    </p>
                                </div>
                            </li>

                        </ul>
                        <ul class="comment-list-ul">
                            <div class="div-btn-answer">
                                <button class="btn-answer">پاسخ به دیدگاه</button>
                            </div>
                            <li class="is-comment">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/profile.jpg">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">کاربر : گوگل</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                    </p>
                                </div>
                            </li>
                            <li class="is-answer">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/laravel-pic.png">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">مدیر سایت : محمد نیکو</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                    </p>
                                </div>
                            </li>

                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
