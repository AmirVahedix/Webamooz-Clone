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
                                <th>شناسه</th>
                                <th>درصد</th>
                                <th>محدودیت زمانی</th>
                                <th>توضیحات</th>
                                <th>استفاده شده</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="">
                                <td><a href="">1</a></td>
                                <td><a href="">50%</a></td>
                                <td>2 ساعت دیگر</td>
                                <td>مناسبت عید نوروز</td>
                                <td>0 نفر</td>
                                <td>
                                    <a href="" class="item-delete mlg-15"></a>
                                    <a href="edit-discount.html" class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>

                            </tbody>
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
