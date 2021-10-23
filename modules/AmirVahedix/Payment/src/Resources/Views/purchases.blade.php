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
                        <td>
                            @if($payment->status === \AmirVahedix\Payment\Models\Payment::STATUS_SUCCESS)
                                <span class="text-success">{{ __($payment->status) }}</span>
                            @else
                                <span class="text-error">{{ __($payment->status) }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $payments->links() }}

        </div>
        <div class="pagination">
        </div>
    </div>
@endsection
