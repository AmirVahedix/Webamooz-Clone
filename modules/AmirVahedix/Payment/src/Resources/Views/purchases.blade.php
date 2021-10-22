@extends("Dashboard::master")

@section("title", "تراکنش ها")

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="">تراکنش ها</a></li>
@endsection


@section("content")
    <div class="main-content">
        <div class="table__box">
            <table class="table">
                <thead>
                <tr class="title-row">
                    <th>عنوان دوره</th>
                    <th>تاریخ پرداخت</th>
                    <th>مقدار پرداختی</th>
                    <th>وضعیت پرداخت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->paymentable->title }}</td>
                        <td>{{ jdate($payment->created_at)->format('Y/m/d') }}</td>
                        <td>{{ number_format($payment->amount) }} تومان</td>
                        <td class="successful">{{ __($payment->status) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination">
        </div>
    </div>
@endsection
