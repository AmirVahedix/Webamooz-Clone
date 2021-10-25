@extends('Dashboard::master')

@section('title', 'تخفیف ها')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="#">تخفیف ها</a></li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/persianDatePicker.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="main-content discounts">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <div class="table-box">
                        <table class="table">
                            <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>کد</th>
                                <th>درصد</th>
                                <th>محدودیت تعداد</th>
                                <th>محدودیت زمانی</th>
                                <th>توضیحات</th>
                                <th>تعداد استفاده</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($discounts as $discount)
                                <tr role="row" class="" x-data="{delete_modal: false}">
                                    <td>{{ $discount->code }}</td>
                                    <td>
                                        <span>{{ $discount->percent }}%</span>
                                        <span>{{ __($discount->type) }}</span>
                                    </td>
                                    <td>{{ $discount->limit }}</td>
                                    <td>{{ $discount->expires_at ? jdate($discount->expires_at)->ago() : 'ندارد'}}</td>
                                    <td>{{ $discount->description }}</td>
                                    <td>{{ $discount->uses }} نفر</td>
                                    <td>
                                        <a href="#" x-on:click="delete_modal=true" class="item-delete mlg-15" title="حذف"></a>
                                        <a href="edit-discount.html" class="item-edit " title="ویرایش"></a>
                                    </td>
                                    <td class="padding-0">
                                        <div class="modal hidden" x-init="$el.classList.remove('hidden')" x-show="delete_modal"
                                             x-transition.opacity>
                                            <div class="modal-content" x-on:click.outside="delete_modal=false">
                                                <h3>آیا از حذف این کد تایید اطمینان دارید؟</h3>
                                                <p>با حذف این کد تایید دیگر کاربران امکان استفاده از آن را نخواهند داشت.</p>
                                                <div class="modal-actions">
                                                    <button class="btn margin-left-10" x-on:click="delete_modal=false">انصراف
                                                    </button>
                                                    <form action="{{ route('admin.discounts.destroy', $discount) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-webamooz_net">حذف کد تایید</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                            {{ $discounts->links() }}
                        </table>
                    </div>
                </div>
            </div>
            @include("Discount::create")
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/persianDatePicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#expires_at, #expires_at_span").persianDatepicker({
                formatDate: "YYYY/0M/0D hh:mm"
            });
        });

        $(document).ready(function() {
            $('.courseSelect').select2({
                "placeholrder": "یک یا چند دوره را انتخاب کنید..."
            });
        });
    </script>
@endsection
