@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Visitas e Pageviews</h4>
                    <div id="spline_area" class="apex-charts" dir="ltr"></div>
                </div>
            </div>
            <!--end card-->
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tráfego</h4>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <tbody>
                            @foreach($referrerData as $referrerRow)
                                <tr>
                                    <td>{{ $referrerRow['url'] }}</td>
                                    <td>{{ $referrerRow['pageViews'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Páginas mais acessadas</h4>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <tbody>
                            @foreach($pagesData as $pageRow)
                                <tr>
                                    <td>{{ $pageRow['url'] }}</td>
                                    <td>{{ $pageRow['pageViews'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Browsers</h4>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <tbody>
                            @foreach($browserData as $browserRow)
                                <tr>
                                    <td>{{ $browserRow['browser'] }}</td>
                                    <td>{{ $browserRow['sessions'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/admin/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script>
        var options = {
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            series: [{
                name: 'Visitas',
                //data: [34, 40, 28, 52, 42, 109, 100],
                data: {{ $vtData }}
            }, {
                name: 'Pageviews',
                data: {{ $vtViews }}
            }],
            colors: ['#556ee6', '#34c38f'],
            xaxis: {
                type: 'date',
                categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"]
            },
            grid: {
                borderColor: '#f1f1f1'
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#spline_area"), options);
        chart.render(); // column chart
    </script>
@endsection
