<p class="box__title">ایجاد دسته‌بندی جدید</p>
<form action="{{ route('admin.categories.store') }}" method="post" class="padding-30">
    @csrf

    <x-input name="title" placeholder="نام دسته‌بندی" class="text" required />
    <x-input name="slug" placeholder="نام انگلیسی دسته‌بندی" class="text" ltr requierd />

    <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
    <select class="custom-select" name="parent_id" id="parent_id">
        <option value="">بدون دسته پدر</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
    </select>

    <button class="btn btn-webamooz_net">اضافه کردن</button>
</form>
