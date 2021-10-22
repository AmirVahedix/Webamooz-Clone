@extends("Dashboard::master")

@section("title", "تراکنش ها")

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="">تراکنش ها</a></li>
@endsection


@section("content")
    <div class="main-content font-size-13">
        <div class="row no-gutters  margin-bottom-10">
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p>کل فروش ۳۰ روز گذشته سایت </p>
                <p>{{ number_format($last30DaysTotal) }} تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p>درامد خالص ۳۰ روز گذشته سایت</p>
                <p>{{ number_format($last30DaysSiteBenefit) }} تومان</p>
            </div>

            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p>کل فروش سایت</p>
                <p>{{ number_format($allSiteTotal) }} تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
                <p> کل درآمد خالص سایت</p>
                <p>{{ number_format($allSiteBenefit) }} تومان</p>
            </div>
        </div>
        <div class="row no-gutters border-radius-3 font-size-13">
            <div class="col-12 bg-white padding-30 margin-bottom-20">
                <div id="payment_chart"></div>
            </div>
        </div>
        <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
            <h2 class="margin-bottom-15">همه تراکنش ها</h2>
            <div class="t-header-search">
                <form action="">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی تراکنش">
                        <div class="t-header-search-content ">
                            <input type="text" name="email" value="{{ request('email') }}" class="text" placeholder="ایمیل">
                            <input type="text" name="mobile" value="{{ request('mobile') }}" class="text" placeholder="شماره تلفن">
                            <input type="text" name="amount" value="{{ request('amount') }}" class="text" placeholder="مبلغ به تومان">
                            <input type="text" name="invoice_id" value="{{ request('invoice_id') }}" class="text" placeholder="شناسه تراکنش">
                            <input type="text" name="start_date" value="{{ request('start_date') }}" class="text" placeholder="از تاریخ : 1399/10/11">
                            <input type="text" name="end_date" value="{{ request('end_date') }}" class="text margin-bottom-20" placeholder="تا تاریخ : 1399/10/12">
                            <button type="submit" class="btn btn-webamooz_net mt-2">جستجو</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table__box">
            <table width="100%" class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه تراکنش</th>
                    <th>نام و نام خانوادگی</th>
                    <th>ایمیل</th>
                    <th>شماره موبایل</th>
                    <th>شماره موبایل</th>
                    <th>مبلغ (تومان)</th>
                    <th>درامد مدرس</th>
                    <th>درامد سایت</th>
                    <th>نام دوره</th>
                    <th>تاریخ و ساعت</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr role="row">
                        <td>{{ $payment->invoice_id }}</td>
                        <td>{{ $payment->buyer->name ?? '' }}</td>
                        <td>{{ $payment->buyer->email }}</td>
                        <td>{{ $payment->buyer->mobile }}</td>
                        <td>{{ number_format($payment->amount) }} تومان</td>
                        <td>{{ number_format($payment->seller_share) }} تومان</td>
                        <td>{{ number_format($payment->site_share) }} تومان</td>
                        <td>{{ $payment->paymentable->title }}</td>
                        <td>{{ jdate($payment->created_at) }}</td>
                        <td>{{ __($payment->status) }}</td>
                        <td>
                            <a href="" class="item-delete mlg-15"></a>
                            <a href="edit-transaction.html" class="item-edit"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $payments->links() }}
    </div>
@endsection

@section("scripts")
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        {{--console.log(@foreach($dates as $day => $value) "{{ $day }}", @endforeach)--}}
        Highcharts.chart('payment_chart', {
            title: {
                text: 'نمودار فروش 30 روز گذشته'
            },
            xAxis: {
                categories: [@foreach($dates as $day => $value) "{{ jdate($day)->format('Y-m-d') }}", @endforeach]
            },
            yAxis: {
                title: {
                    text: "مبلغ"
                },
                labels: {
                    formatter: function () {
                        return this.value + "تومان"
                    }
                }
            },
            tooltip: {
                formatter: function () {
                    return "فروش: " + this.y
                }
            },
            labels: {
                items: [{
                    html: 'درصد مدرس و سایت',
                    style: {
                        left: '50px',
                        top: '18px',
                        color: ( // theme
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || 'black'
                    }
                }]
            },
            series: [{
                type: 'column',
                name: 'تراکنش موفق',
                data: [@foreach($dates as $date => $value) @if($day = $summary->where('date', $date)->first()) {{ $day->totalAmount }}, @else 0, @endif @endforeach]
            }, {
                type: 'column',
                name: 'درصد سایت',
                data: [@foreach($dates as $date => $value) @if($day = $summary->where('date', $date)->first()) {{ $day->totalSiteShare }}, @else 0, @endif @endforeach]
            }, {
                type: 'column',
                name: 'درصد مدرس',
                data: [@foreach($dates as $date => $value) @if($day = $summary->where('date', $date)->first()) {{ $day->totalSellerShare }}, @else 0, @endif @endforeach]
            }, {
                type: 'spline',
                name: 'فروش',
                data: [@foreach($dates as $date => $value) @if($day = $summary->where('date', $date)->first()) {{ $day->totalAmount }}, @else 0, @endif @endforeach],
                marker: {
                    lineWidth: 2,
                    lineColor: Highcharts.getOptions().colors[3],
                    fillColor: 'white'
                }
            }, {
                type: 'pie',
                name: 'Total consumption',
                data: [{
                    name: 'درامد مدرس',
                    y: {{ $last30DaysTotal - $last30DaysSiteBenefit }},
                    color: Highcharts.getOptions().colors[0]
                }, {
                    name: 'درامد سایت',
                    y: {{ $last30DaysSiteBenefit }},
                    color: Highcharts.getOptions().colors[1]
                }],
                center: [100, 80],
                size: 100,
                showInLegend: false,
                dataLabels: {
                    enabled: false
                }
            }]
        });
    </script>
@endsection
