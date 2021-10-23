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
            data: [@foreach($dates as $date => $value) @if($day = $summary->where('date', $date)->first()) {{ $day->totalAmount }}, @else 0, @endif @endforeach],
        }, {
            type: 'column',
            name: 'درصد سایت',
            data: [@foreach($dates as $date => $value) @if($day = $summary->where('date', $date)->first()) {{ $day->totalSiteShare }}, @else 0, @endif @endforeach],
            color: 'green'
        }, {
            type: 'column',
            name: 'درصد مدرس',
            data: [@foreach($dates as $date => $value) @if($day = $summary->where('date', $date)->first()) {{ $day->totalSellerShare }}, @else 0, @endif @endforeach],
            color: 'pink'
        }, {
            type: 'spline',
            name: 'فروش',
            data: [@foreach($dates as $date => $value) @if($day = $summary->where('date', $date)->first()) {{ $day->totalAmount }}, @else 0, @endif @endforeach],
            marker: {
                lineWidth: 2,
                lineColor: 'green',
                fillColor: 'white'
            },
            color: 'green'
        }, {
            type: 'pie',
            name: 'Total consumption',
            data: [{
                name: 'درامد مدرس',
                y: {{ $last30DaysTotal - $last30DaysSiteBenefit }},
                color: 'pink'
            }, {
                name: 'درامد سایت',
                y: {{ $last30DaysSiteBenefit }},
                color: 'green'
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
