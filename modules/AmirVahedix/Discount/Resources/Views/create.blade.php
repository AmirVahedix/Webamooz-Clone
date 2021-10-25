<div class="col-4 bg-white">
    <p class="box__title">ایجاد تخفیف جدید</p>
    <form action="{{ route('admin.discounts.store') }}" method="POST" class="padding-30">
        @csrf

        <x-input name="code" type="text" placeholder="کد تخفیف" class="text" />
        <x-input name="percent" type="number" placeholder="درصد تخفیف" class="text" />
        <x-input name="limit" type="number" placeholder="محدودیت استفاده" class="text" />
        <x-input name="expires_at" type="text" placeholder="تاریخ انقضا" class="text" />
        <span id="expires_at_span"></span>

        <div x-data="{course_select: false}">
            <p class="box__title mt-2">این تخفیف برای</p>

            <div class="notificationGroup">
                <input id="discounts-field-1" class="discounts-field-pn" name="type" value="all" x-on:click="course_select=false" type="radio" checked/>
                <label for="discounts-field-1">همه دوره ها</label>
            </div>

            <div class="notificationGroup">
                <input id="discounts-field-2" class="discounts-field-pn" name="type" value="special" x-on:click="course_select=true" type="radio"/>
                <label for="discounts-field-2">دوره خاص</label>
            </div>

            <div x-show="course_select">
                <select class="courseSelect" name="courses[]" multiple="multiple">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <x-input name="link" type="text" placeholder="لینک اطلاعات بیشتر" class="text" />
        <x-input name="description" type="text" placeholder="توضیحات" class="text margin-bottom-15" />

        <button class="btn btn-webamooz_net mt-2">اضافه کردن</button>
    </form>
</div>
