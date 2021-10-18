<header class="t-header">
    <div class="campaign">
        <div class="container">
            <a class="message">تخفیف «۳۰٪» همه دوره‌ها فقط تا</a>
            <div id="count-down-timer" data-countdown="2021-07-8 00:00:00" class="count-down-timer"></div>
        </div>
    </div>
    <div class="container">
        <div class="t-header-row">
            <div class="t-header-right">
                <div class="t-header-logo"><a href="{{ route('index') }}"></a></div>
                @include("Front::layouts.header.search-box")
            </div>
            <div class="t-header-left">
                <div class="icons">
                    <div class="search-icon"></div>
                    <div class="menu-icon"></div>
                </div>

                <div class="join-teachers">
                    <a href="become-a-teacher.html">تدریس در وب آموز</a>
                </div>
                @auth
                    <div class="user-menu-account">
                        <div class="user-image">
                            <img src="{{ auth()->user()->user_avatar ?? asset('panel/img/pro.jpg') }}" alt="{{ auth()->user()->name }}">
                        </div>
                        <span>پروفایل کاربری من</span>

                        <div class="user-menu-account-dropdown">
                            <ul>
                                <li><a href="{{ route('users.profile.show') }}">مشاهده پروفایل</a></li>
                                <li><a href="">خرید های من</a></li>
                                <li><a href="{{ route('dashboard.index') }}">داشبورد</a></li>
                                <li x-data>
                                    <a x-on:click="$refs.logoutForm.submit()">خروج</a>
                                    <form action="{{ route('logout') }}" method="POST" x-ref="logoutForm">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endauth

                @guest
                    <div class="login-register-btn ">
                        <div><a class="btn-login" href="{{ route('login') }}">ورود</a></div>
                        <div><a class="btn-register" href="{{ route('register') }}">ثبت نام</a></div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
    @include('Front::layouts.header.navbar')
</header>

