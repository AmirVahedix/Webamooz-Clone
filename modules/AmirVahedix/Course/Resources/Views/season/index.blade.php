<div class="col-12 bg-white margin-bottom-15 border-radius-3">
    <p class="box__title">سرفصل ها</p>
    <form action="{{ route('admin.seasons.store', $course->id) }}" method="POST" class="padding-30">
        @csrf
        <x-input name="title" placeholder="عنوان سرفصل" class="text"/>
        <x-input name="number" placeholder="شماره سرفصل" class="text"/>
        <button type="submit" class="btn btn-webamooz_net mt-2">اضافه کردن</button>
    </form>
    <div class="table__box padding-30">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th class="p-r-90">ردیف</th>
                <th>عنوان فصل</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($course->seasons as $season)
                <tr role="row" class="">
                    <td><a href="">{{ $season->number }}</a></td>
                    <td><a href="">{{ $season->title }}</a></td>
                    <td>
                        <a href="" class="item-delete mlg-15" title="حذف"></a>
                        <a href="" class="item-reject mlg-15" title="رد"></a>
                        <a href="" class="item-confirm mlg-15" title="تایید"></a>
                        <a href="" class="item-edit " title="ویرای÷ش"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
