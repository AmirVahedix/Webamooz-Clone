<div class="bg-white padding-20">
    <div class="t-header-search">
        <form action="{{ route('dashboard.comments.index') }}">
            <div class="t-header-searchbox font-size-13">
                <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی در نظرات">
                <div class="t-header-search-content ">
                    <x-input name="body" class="text" value="{{ request('body') }}" placeholder="قسمتی از متن" />
                    <x-input name="email" class="text" value="{{ request('email') }}" placeholder="ایمیل" />
                    <x-input name="name" class="text" value="{{ request('name') }}" placeholder="نام و نام خانوادگی" />
                    <button class="btn btn-webamooz_net mt-2">جستجو</button>
                </div>
            </div>
        </form>
    </div>
</div>
