<div class="sidebar-right">
    <div class="sidebar-sticky">
        <div class="product-info-box">
            @auth
                @if($course->teacher->id == auth()->id())
                    <p class="mycourse">شما مدرس این دوره هستید</p>
                @elseif(auth()->user()->hasAccessToCourse($course))
                    <p class="mycourse">شما دانشجوی این دوره هستید</p>
                @else
                    <div class="discountBadge">
                        <p>45%</p>
                        تخفیف
                    </div>
                    <div class="sell_course">
                        <strong>قیمت :</strong>
                        <del class="discount-Price">{{ number_format($course->price) }}</del>
                        <p class="price">
                        <span class="woocommerce-Price-amount amount">250,000
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                        </p>
                    </div>
                    <button class="btn buy btn-buy">خرید دوره</button>
                @endif
            @endauth

            @guest
                <div class="discountBadge">
                    <p>45%</p>
                    تخفیف
                </div>
                <div class="sell_course">
                    <strong>قیمت :</strong>
                    <del class="discount-Price">{{ number_format($course->price) }}</del>
                    <p class="price">
                    <span class="woocommerce-Price-amount amount">250,000
                        <span class="woocommerce-Price-currencySymbol">تومان</span>
                    </span>
                    </p>
                </div>
                <a href="{{ route('login') }}" class="btn btn--login width-100" style="color: white !important">ورود به سایت</a>
            @endguest

            <div class="average-rating-sidebar">
                <div class="rating-stars">
                    <div class="slider-rating">
                        <span class="slider-rating-span slider-rating-span-100" data-value="100%"
                              data-title="خیلی خوب"></span>
                        <span class="slider-rating-span slider-rating-span-80" data-value="80%" data-title="خوب"></span>
                        <span class="slider-rating-span slider-rating-span-60" data-value="60%"
                              data-title="معمولی"></span>
                        <span class="slider-rating-span slider-rating-span-40" data-value="40%" data-title="بد"></span>
                        <span class="slider-rating-span slider-rating-span-20" data-value="20%"
                              data-title="خیلی بد"></span>
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
                <a href="{{ route('tutor.show', $course->teacher->username) }}">
                    <img alt="{{ $course->teacher->name }}" class="img-fluid lazyloaded"
                         src="{{ $course->teacher->user_avatar ?? asset('panel/img/profile.jpg') }}" loading="lazy">
                    <noscript>
                        <img class="img-fluid"
                             src="{{ $course->teacher->user_avatar ?? asset('panel/img/profile.jpg') }}"
                             alt="{{ $course->teacher->name }}"></noscript>
                </a>
                <div class="name">
                    <a href="{{ route('tutor.show', $course->teacher->username) }}" class="btn-link">
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

    <div id="ModalBuy" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <p>خرید دوره {{ $course->title }}</p>
                <div class="close">&times;</div>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('courses.buy', $course->id) }}">
                    @csrf
                    <div>
                        <p>کد تخفیف</p>
                        <input type="text" name="code" id="code" class="txt" placeholder="کد تخفیف را وارد کنید">
                        <p id="response"></p>
                    </div>
                    <button type="button" class="btn i-t " >اعمال
                        <img src="/img/loading.gif" alt="" id="loading" class="loading d-none">
                    </button>

                    <table class="table text-center table-bordered table-striped">
                        <tbody>
                        <tr>
                            <th>قیمت کل دوره</th>
                            <td>{{ number_format($course->price) }} تومان</td>
                        </tr>
                        <tr>
                            <th>درصد تخفیف</th>
                            <td>
                                <span id="discountPercent" data-value="">0</span>%
                            </td>
                        </tr>
                        <tr>
                            <th> مبلغ تخفیف</th>

                            <td class="text-red">
                                <span id="discountAmount" data-value="">0</span>
                                تومان
                            </td>
                        </tr>
                        <tr>
                            <th> قابل پرداخت</th>
                            <td class="text-primary">
                                <span id="payableAmount" data-value="">{{ number_format($course->price) }}</span>
                                تومان
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn i-t">پرداخت آنلاین</button>
                </form>
            </div>
        </div>
    </div>
</div>
