<p class="box__title">ایجاد دسته‌بندی جدید</p>
<form action="{{ route('admin.categories.store') }}" method="post" class="padding-30">
    <x-input name="title" placeholder="نام دسته‌بندی" class="text" required />
    <x-input name="slug" placeholder="نام انگلیسی دسته‌بندی" class="text" ltr requierd />
    <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
    <select name="parent_id" id="parent_id">
        <option value="">بدون دسته پدر</option>
        <option value="1">برنامه نویسی</option>
        <option value="2">برنامه نویسی</option>
        <option value="3">برنامه نویسی</option>
    </select>
    <button class="btn btn-webamooz_net">اضافه کردن</button>
</form>
