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
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($course->seasons as $season)
                <tr role="row" class="" x-data="{delete_modal: false}">
                    <td><a href="">{{ $season->number }}</a></td>
                    <td><a href="">{{ $season->title }}</a></td>
                    <td><a href="">{{ __($season->confirmation_status) }}</a></td>
                    <td>
                        <a class="item-delete mlg-15 cursor-pointer" x-on:click="delete_modal=true"></a>
                        <div class="modal hidden" x-init="$el.classList.remove('hidden')" x-show="delete_modal" x-transition.opacity>
                            <div class="modal-content" x-on:click.outside="delete_modal=false">
                                <h3>آیا از حذف این سرفصل اطمینان دارید؟</h3>
                                <p>با کلیک بر روی حذف، این سرفصل حذف میشود ولی جلسات آن باقی می‌ماند.</p>
                                <div class="modal-actions">
                                    <button class="btn margin-left-10" x-on:click="delete_modal=false">انصراف</button>
                                    <form action="{{ route('admin.seasons.destroy', $season->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-webamooz_net">حذف</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @can(\AmirVahedix\Authorization\Models\Permission::PERMISSION_MANAGE_COURSES)
                            @unless($season->confirmation_status == \AmirVahedix\Course\Models\Season::CONFIRMATION_REJECTED)
                                <a href="{{ route('admin.seasons.reject', $season->id) }}" class="item-reject mlg-15" title="رد"></a>
                            @endunless
                            @unless($season->confirmation_status == \AmirVahedix\Course\Models\Season::CONFIRMATION_ACCEPTED)
                                <a href="{{ route('admin.seasons.accept', $season->id) }}" class="item-confirm mlg-15" title="تایید"></a>
                            @endunless
                        @endcan
                        <a href="{{ route('admin.seasons.edit', $season->id) }}" class="item-edit " title="ویرایش"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
