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
                <div class="sidebar-right">
                    <div class="sidebar-sticky">
                        <div class="product-info-box">
                            <div class="discountBadge d-none">
                                <p>45%</p>
                                تخفیف
                            </div>
                            <div class="sell_course d-none">
                                <strong>قیمت :</strong>
                                <del class="discount-Price">900,000</del>
                                <p class="price">
                        <span class="woocommerce-Price-amount amount">495,000
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                </p>
                            </div>

                            @if(auth()->check() && $course->teacher->id == auth()->id())
                                <p class="mycourse">شما مدرس این دوره هستید</p>
                            @elseif(auth()->check() && auth()->user()->hasAccessToCourse($course->id))
                                <p class="mycourse">شما دانشجوی این دوره هستید</p>
                            @else
                                <button class="btn buy">خرید دوره</button>
                            @endif

                            <div class="average-rating-sidebar">
                                <div class="rating-stars">
                                    <div class="slider-rating">
                                        <span class="slider-rating-span slider-rating-span-100" data-value="100%" data-title="خیلی خوب"></span>
                                        <span class="slider-rating-span slider-rating-span-80" data-value="80%" data-title="خوب"></span>
                                        <span class="slider-rating-span slider-rating-span-60" data-value="60%" data-title="معمولی"></span>
                                        <span class="slider-rating-span slider-rating-span-40" data-value="40%" data-title="بد"></span>
                                        <span class="slider-rating-span slider-rating-span-20" data-value="20%" data-title="خیلی بد"></span>
                                        <div class="star-fill"></div>
                                    </div>
                                </div>

                                <div class="average-rating-number">
                                    <span class="title-rate title-rate1">امتیاز</span>
                                    <div class="schema-stars">
                                        <span class="value-rate text-message"> 4 </span>
                                        <span class="title-rate">از</span>
                                        <span class="value-rate"> 555 </span>
                                        <span class="title-rate">رأی</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-info-box">
                            <div class="product-meta-info-list">
                                <div class="total_sales">
                                    تعداد دانشجو : <span>246</span>
                                </div>
                                <div class="meta-info-unit one">
                                    <span class="title">تعداد جلسات منتشر شده :  </span>
                                    <span class="vlaue">{{ $course->lessons_count }}</span>
                                </div>
                                @if($course->status == \AmirVahedix\Course\Models\Course::STATUS_PENDING)
                                    <div class="meta-info-unit two">
                                        <span class="title">مدت زمان دوره تا الان: </span>
                                        <span class="vlaue">{{ $course->formatted_duration }}</span>
                                    </div>
                                @endif
                                @if($course->status == \AmirVahedix\Course\Models\Course::STATUS_COMPLETED)
                                    <div class="meta-info-unit three">
                                        <span class="title">مدت زمان دوره: </span>
                                        <span class="vlaue">{{ $course->formatted_duration }}</span>
                                    </div>
                                @endif
                                <div class="meta-info-unit four">
                                    <span class="title">مدرس دوره: </span>
                                    <span class="vlaue">{{ $course->teacher->name }}</span>
                                </div>
                                <div class="meta-info-unit five">
                                    <span class="title">وضعیت دوره: </span>
                                    <span class="vlaue">{{ __($course->status) }}</span>
                                </div>
                                <div class="meta-info-unit six">
                                    <span class="title">پشتیبانی: </span>
                                    <span class="vlaue">دارد</span>
                                </div>
                            </div>
                        </div>
                        <div class="course-teacher-details">
                            <div class="top-part">
                                <a href="https://webamooz.net/tutor/mohammadnikoo/">
                                    <img alt="{{ $course->teacher->name }}" class="img-fluid lazyloaded"
                                         src="{{ $course->teacher->user_avatar ?? asset('panel/img/profile.jpg') }}" loading="lazy">
                                    <noscript>
                                        <img class="img-fluid" src="{{ $course->teacher->user_avatar ?? asset('panel/img/profile.jpg') }}" alt="{{ $course->teacher->name }}"></noscript>
                                </a>
                                <div class="name">
                                    <a href="https://webamooz.net/tutor/mohammadnikoo/" class="btn-link">
                                        <h6>{{ $course->teacher->name }}</h6>
                                    </a>
                                    <span class="job-title">{{ $course->teacher->headline }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="short-link">
                            <div class="">
                                <span>لینک کوتاه</span>
                                <input class="short--link" value="{{ route('courses.link.short', $course->id) }}">
                                <a href="" class="short-link-a" data-link="{{ route('courses.link.short', $course->id) }}"></a>
                            </div>
                        </div>
                        @include("Front::layouts.sidebar.ads")
                    </div>
                </div>
                <div class="content-left">
                    <div class="preview">
                        <video width="100%" controls>
                            <source src="intro.mp4" type="video/mp4">
                        </video>
                    </div>
                    <a href="#" class="episode-download">دانلود این قسمت (قسمت 1)</a>
                    <div class="course-description">
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
                    <div class="episodes-list">
                        <div class="episodes-list--title">فهرست جلسات</div>
                        <div class="episodes-list-section">
                            <div class="episodes-list-item ">
                                <div class="section-right">
                                    <span class="episodes-list-number">۱</span>
                                    <div class="episodes-list-title">
                                        <a href="php-ep-1.html">php چیست</a>
                                    </div>
                                </div>
                                <div class="section-left">
                                    <div class="episodes-list-details">
                                        <div class="episodes-list-details">
                                            <span class="detail-type">رایگان</span>
                                            <span class="detail-time">44:44</span>
                                            <a class="detail-download">
                                                <i class="icon-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="episodes-list-item">
                                <div class="section-right">
                                    <span class="episodes-list-number">2</span>
                                    <div class="episodes-list-title">
                                        <a href="php-ep-2.html">نصب و راه اندازی</a>
                                    </div>
                                </div>
                                <div class="section-left">
                                    <div class="episodes-list-details">
                                        <div class="episodes-list-details">
                                            <span class="detail-type">رایگان</span>
                                            <span class="detail-time">44:44</span>
                                            <a class="detail-download">
                                                <i class="icon-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="episodes-list-item lock">
                                <div class="section-right">
                                    <span class="episodes-list-number">3</span>
                                    <div class="episodes-list-title">
                                        <a href="#">اضافه کردن متد های جدید به router - از فصل اول بخش اخر</a>
                                    </div>
                                </div>
                                <div class="section-left">
                                    <div class="episodes-list-details">
                                        <div class="episodes-list-details">
                                            <!--                                            <span class="detail-type">نقدی</span>-->
                                            <span class="detail-time">44:44</span>
                                            <a class="detail-download">
                                                <i class="icon-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="episodes-list-item lock">
                                <div class="section-right">
                                    <span class="episodes-list-number">-</span>
                                    <div class="episodes-list-title">
                                        <a href="#">دانلود فایل</a>
                                    </div>
                                </div>
                                <div class="section-left">
                                    <div class="episodes-list-details">
                                        <div class="episodes-list-details">
                                            <!--                                            <span class="detail-type">نقدی</span>-->
                                            <span class="detail-time"></span>
                                            <a class="detail-download">
                                                <i class="icon-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
