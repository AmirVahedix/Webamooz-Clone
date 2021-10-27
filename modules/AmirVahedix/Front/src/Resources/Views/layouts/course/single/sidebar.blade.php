<div class="sidebar-right">
    <div class="sidebar-sticky">
        <div class="product-info-box">
            @auth
                @if($course->teacher->id == auth()->id())
                    <p class="mycourse">شما مدرس این دوره هستید</p>
                @elseif(auth()->user()->can('download', $course))
                    <p class="mycourse">شما دانشجوی این دوره هستید</p>
                @else
                    @if($course->getDiscountPercent())
                        <div class="discountBadge">
                            <p>{{ $course->getDiscountPercent() }}%</p>
                            تخفیف
                        </div>
                    @endif
                    <div class="sell_course">
                        <strong>قیمت :</strong>
                        @if($course->getDiscountAmount())
                            <del class="discount-Price">{{ number_format($course->price) }}</del>
                        @endif
                        <p class="price">
                        <span class="woocommerce-Price-amount amount">{{ number_format($course->getFinalPrice()) }}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                        </p>
                    </div>
                    <button class="btn buy btn-buy">خرید دوره</button>
                @endif
            @endauth

            @guest
                <div class="discountBadge">
                    <p>{{ $course->getDiscountPercent() }}%</p>
                    تخفیف
                </div>
                <div class="sell_course">
                    <strong>قیمت :</strong>
                    <del class="discount-Price">{{ number_format($course->price) }}</del>
                    <p class="price">
                    <span class="woocommerce-Price-amount amount">{{ number_format($course->getFinalPrice()) }}
                        <span class="woocommerce-Price-currencySymbol">تومان</span>
                    </span>
                    </p>
                </div>
                <a href="{{ route('login') }}" class="btn btn--login width-100" style="color: white !important">ورود به
                    سایت</a>
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
                <a href="{{ route('tutor.show', $course->teacher->username ?: $course->teacher->email ?: $course->teacher->mobile) }}">
                    <img alt="{{ $course->teacher->name }}" class="img-fluid lazyloaded"
                         src="{{ $course->teacher->user_avatar ?? asset('panel/img/profile.jpg') }}" loading="lazy">
                    <noscript>
                        <img class="img-fluid"
                             src="{{ $course->teacher->user_avatar ?? asset('panel/img/profile.jpg') }}"
                             alt="{{ $course->teacher->name }}"></noscript>
                </a>

                <div class="name">
                    <a href="{{ route('tutor.show', $course->teacher->username ?: $course->teacher->email ?: $course->teacher->mobile) }}"
                       class="btn-link">
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

    {{-- Buy Modal --}}
    <div id="ModalBuy" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <p>خرید دوره {{ $course->title }}</p>
                <div class="close">&times;</div>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('courses.buy', $course->id) }}">
                    @csrf

                    <div class="">
                        <div>
                            <p>کد تخفیف</p>
                            <input type="text" name="code" id="discount_code" class="txt"
                                   placeholder="کد تخفیف را وارد کنید">
                            <p id="discount_response" class="text-success"></p>
                        </div>
                        <div class="d-flex" style="align-items: center">
                            <button type="button" class="btn i-t"
                                    onclick="checkDiscountCode('{{ route('discounts.check', ['code', $course->id]) }}')">
                                اعمال
                            </button>
                            <span class="sk-circle d-none" id="discount_loading">
                                <span class="sk-circle1 sk-child"></span>
                                <span class="sk-circle2 sk-child"></span>
                                <span class="sk-circle3 sk-child"></span>
                                <span class="sk-circle4 sk-child"></span>
                                <span class="sk-circle5 sk-child"></span>
                                <span class="sk-circle6 sk-child"></span>
                                <span class="sk-circle7 sk-child"></span>
                                <span class="sk-circle8 sk-child"></span>
                                <span class="sk-circle9 sk-child"></span>
                                <span class="sk-circle10 sk-child"></span>
                                <span class="sk-circle11 sk-child"></span>
                                <span class="sk-circle12 sk-child"></span>
                            </span>
                        </div>

                    </div>


                    <table class="table text-center table-bordered table-striped">
                        <tbody>
                        <tr>
                            <th>قیمت کل دوره</th>
                            <td>{{ number_format($course->price) }} تومان</td>
                        </tr>
                        <tr>
                            <th>درصد تخفیف</th>
                            <td>
                                <span id="discountPercent">0</span>%
                            </td>
                        </tr>
                        <tr>
                            <th> مبلغ تخفیف</th>
                            <td class="text-red">
                                <span id="discountAmount">0</span>
                                تومان
                            </td>
                        </tr>
                        <tr>
                            <th> قابل پرداخت</th>
                            <td class="text-primary">
                                <span id="payableAmount">{{ number_format($course->price) }}</span>
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
