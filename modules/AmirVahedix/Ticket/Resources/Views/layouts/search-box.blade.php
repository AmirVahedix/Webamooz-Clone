@can(\AmirVahedix\Authorization\Models\Permission::PERMISSION_MANAGE_TICKETS)
    <div class="t-header-search">
        <form action="{{ route('dashboard.tickets.index') }}">
            <div class="t-header-searchbox font-size-13">
                <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی در تیکت ها">
                <div class="t-header-search-content ">
                    <x-input name="email" value="{{ request('email') }}" class="text" placeholder="ایمیل" />
                    <x-input name="mobile" value="{{ request('mobile') }}" class="text" placeholder="شماره تلفن" />
                    <x-input name="name" value="{{ request('name') }}" class="text " placeholder="نام و نام خانوادگی" />
                    <x-input name="date" value="{{ request('date') }}" type="text" placeholder="تاریخ" class="text" />
                    <span id="date_span"></span>

                    <button type="submit" class="btn btn-webamooz_net mt-2">جستجو</button>
                </div>
            </div>
        </form>
    </div>
@endcan
