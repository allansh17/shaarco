@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

@php
function formatSales($number) {
if ($number >= 1_000_000) {
return number_format($number / 1_000_000, 2) . 'm';
} elseif ($number >= 1_000) {
return number_format($number / 1_000, 2) . 'k';
}
return number_format($number, 2);
}
@endphp
<!-- <div class="row">
    <div class="col-lg-8 mb-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-7">
                        <h5 class="card-title text-primary">Congratulations {{ Auth::user()->name }}! 🎉</h5>
                        <p class="mb-3">You have done <span class="fw-medium">72%</span> more sales today. Check
                            your
                            new badge in your profile.</p>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                    </div>
                    <div class="col-sm-5 ">
                        <div class="text-sm-left text-center">
                            <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-6 col-6 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success"
                                    class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Profit</span>
                        <h4 class="card-title mb-2">$12,628</h4>
                        <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +72.80%</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-6 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="Credit Card"
                                    class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="{{url('sales_report')}}">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <span>Sales</span>
                        <h4 class="card-title text-nowrap mb-1">${{formatSales($orders->first()->TotalSale)}}</h4>
                        <small class="text-success fw-medium"><i class='bx bx-up-arrow-alt'></i> +28.42%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Total Revenue -->

<div class="row">
    @php
    // Ensure $growthRates is not empty before calling max()
    $highestKey = !empty($growthRates) ? max(array_keys($growthRates)) : null;
    $growthRatesss = collect($growthRates ?? [])->sortKeysDesc();
@endphp
    <div class="col-lg-8 order-2 order-md-3 order-lg-2 mb-3">
    <div class="card">
        <div class="row row-bordered g-0">
            <div class="col-md-8">
                <h5 class="card-header m-0 me-2 pb-3">Total Inquiries</h5>
                <div id="totalRevenueCharts" class="px-2"></div>
            </div>
            <div class="col-md-4">
                <div class="card-body">
                    <div class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ $highestKey ?? 'N/A' }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                @foreach($growthRatesss as $key => $data)
                                    <a class="dropdown-item" href="javascript:void(0);" 
                                       onclick="fetchDataAndRendergrowthChart('#growthCharts', 'growthcharts', '{{ $key }}', this)">
                                        {{ $key }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div id="growthCharts"></div>

                @if(!empty($growthRates) && isset($growthRates[$highestKey]))
                    <div class="text-center fw-medium pt-3 mb-2" id="company_growth">
                        {{ $growthRates[$highestKey] }}% Company Growth
                    </div>
                @endif

                <div class="d-flex flex-wrap px-2 p-4 gap-3" id="current">
                    @php
                        $lastTwoSalesData = !empty($salesData) ? array_slice($salesData, -2, 2, true) : [];
                        $lastTwoSalesData = collect($lastTwoSalesData)->sortKeysDesc();
                    @endphp

                    @foreach($lastTwoSalesData as $key => $data)
                        <div class="d-flex">
                            <div class="me-2">
                                <span class="badge bg-label-primary p-2">
                                    <i class="bx bx-box text-primary"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column">
                                <small>{{ $key }}</small>
                                <h6 class="mb-0">{{ $data }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
    <!--/ Total Revenue -->
    <div class="col-lg-4 order-3 order-md-2">
        <div class="row">
            <div class="col-lg-6 col-md-4 col-sm-6 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-primary p-2"><i class="bx bx-cart-alt text-primary"></i></span>
                            </div>
                            <!-- <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                    <a class="dropdown-item" href="{{url('transaction_report')}}">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div> -->
                        </div>
                        <span class="d-block mb-1">Total Inquiries</span>
                        <h4 class="card-title text-nowrap mb-2">{{$totalorders->first()->NumberOfOrders}}</h4>
                        <!-- <small class="text-danger fw-medium"><i class='bx bx-down-arrow-alt'></i> -14.82%</small> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-6 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-primary p-2"><i class="bx bxs-report text-primary"></i></span>
                            </div>
                            <!-- <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                    <a class="dropdown-item" href="{{url('transaction_report')}}">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div> -->
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Categories</span>
                        <h4 class="card-title mb-2">{{$category}}</h4>
                        <!-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.14%</small> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-6 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-primary p-2"><i class="bx bx-camera text-primary"></i></span>
                            </div>
                            <!-- <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                    <a class="dropdown-item" href="{{url('transaction_report')}}">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div> -->
                        </div>

                        <span class="fw-semibold d-block mb-1">Total Products</span>
                        <h4 class="card-title mb-2">{{$totalproducts}}</h4>
                        <!-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.14%</small> -->
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-4 col-sm-6 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-primary p-2"><i class="bx bx-user text-primary"></i></span>
                            </div>
                            <!-- <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                    <a class="dropdown-item" href="{{url('transaction_report')}}">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div> -->
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Customers</span>
                        <h4 class="card-title mb-2">{{($customers->first()->NumberOfCustomers)}}</h4>
                        <!-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.14%</small> -->
                    </div>
                </div>
            </div>
            <!-- </div>
    <div class="row"> -->
            <!-- <div class="col-lg-12 col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2">Profile Report</h5>
                                    <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                                </div>
                                <div class="mt-sm-auto">
                                    <small class="text-success text-nowrap fw-medium"><i class='bx bx-chevron-up'></i>
                                        68.2%</small>
                                    <h4 class="mb-0">$84,686k</h4>
                                </div>
                            </div>
                            <div id="profileReportChart"></div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
<div class="row">
    <!-- Order Statistics -->
    <div class="col-md-4 order-0 mb-3">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Inquiries Statistics</h5>
                    <!-- <small class="text-muted">
                        @php
                        $totalSale = $orders->first()->TotalSale;
                        @endphp
                        {{ formatSales($totalSale) }} Total Sales
                    </small> -->
                </div>
                <!-- <div class="dropdown">
                    <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                        <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                        <a class="dropdown-item" href="javascript:void(0);" onclick="location.reload();">Refresh</a>
                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                    </div>
                </div> -->
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-center gap-1">
                        <h2 class="mb-2">{{formatSales($totalorders->first()->NumberOfOrders)}}</h2>
                        <span>Total Inquiries</span>
                    </div>
                    <div id="orderStatisticsCharts"></div>
                </div>
                <ul style="padding: 0px;">
                    @foreach($orders_products as $order)
                    <li class="d-flex mb-3 pb-1">
                        <!-- <div class="avatar flex-shrink-0 me-3">

                            <i class="bx bx-closet">

                        </div> -->
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">{{ $order->category_name }}</h6>
                            </div>
                            <div class="user-progress">
                                <small class="fw-medium">{{ $order->NumberOfOrders }}</small>
                            </div>
                        </div>
                    </li>
                    @endforeach


                </ul>
            </div>
        </div>
    </div>
    <!--/ Order Statistics -->

    <!-- Expense Overview -->
    <div class="col-md-8 order-0 mb-3">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Latest Inquiries</h5>
                </div>
            </div>
            <div class="card-body">
                <table style="width: 100%; " class="mt-2">
                    <thead>
                        <tr>
                            <th style="padding: 8px; background-color: #f2f2f2;">Sr No</th>
                            <th style="padding: 8px; background-color: #f2f2f2;">Inquiry No</th>
                            <th style="padding: 8px; background-color: #f2f2f2;">Customers</th>
                            <th style="padding: 8px; background-color: #f2f2f2;">Message</th>
                            <th style="padding: 8px; background-color: #f2f2f2;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $srno = 1;
                        @endphp
                        @foreach($latestOrders as $data)
                        <tr>
                            <td style="padding: 8px;">{{$srno++}}</td>
                            <td style="padding: 8px;">{{$data->id}}</td>
                            <td style="padding: 8px;">{{$data->customer_name}}</td>
                            <td style="padding: 8px;">{{ strlen($data->message) > 10 ? substr($data->message, 0, 10) . '...' : $data->message }}</td>
                            <td style="padding: 8px;">@switch($data->order_status)
                                @case(0)
                                Pending
                                @break

                                @case(1)
                                Confirmed
                                @break

                                @case(2)
                                Shipped
                                @break

                                @case(3)
                                Intransit
                                @break

                                @case(4)
                                Delivered
                                @break

                                @case(5)
                                Cancel
                                @break

                                @default
                                Unknown Status
                                @endswitch
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Expense Overview -->
    <!-- 10 customers -->
    <div class="col-md-6 order-0 mb-3">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Customers</h5>
                </div>
            </div>
            <div class="card-body">
                <table style="width: 100%; " class="mt-2">
                    <thead>
                        <tr>
                            <th style="padding: 8px; background-color: #f2f2f2;">Sr No</th>
                            <th style="padding: 8px; background-color: #f2f2f2;">Name</th>
                            <th style="padding: 8px; background-color: #f2f2f2;">Email</th>
                            <th style="padding: 8px; background-color: #f2f2f2;">Phone Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $srno = 1;
                        @endphp
                        @foreach($customersdata as $data)
                        <tr>
                            <td style="padding: 8px;">{{$srno++}}</td>
                            <td style="padding: 8px;">{{$data->first_name}} {{$data->last_name}}</td>
                            <td style="padding: 8px;">{{$data->email}}</td>
                            <td style="padding: 8px;">{{$data->phone}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end 10 customers -->
    <!-- Best 5 Products -->
    <div class="col-md-6 order-0 mb-3">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Best Products</h5>
                </div>
            </div>
            <div class="card-body">
                <table style="width: 100%; " class="mt-2">
                    <thead>
                        <tr>
                            <th style="padding: 8px; background-color: #f2f2f2;">Sr No</th>
                            <th style="padding: 8px; background-color: #f2f2f2;">Name</th>
                            <th style="padding: 8px; background-color: #f2f2f2;">Price</th>
                            <th style="padding: 8px; background-color: #f2f2f2;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $srno = 1;
                        @endphp
                        @foreach($topProducts as $data)
                        <tr>
                            <td style="padding: 8px;">{{$srno++}}</td>
                            <td style="padding: 8px;">{{$data->name}}</td>
                            <td style="padding: 8px;">{{$data->price}}</td>
                            <td style="padding: 8px;">{{$data->status == 1 ? 'Active' : 'InActive'}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Best 5 Products -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script>
    // for  Order Statistics Chart
    function fetchDataAndRenderChart(chartId, dataUrl) {
        $.ajax({
            url: dataUrl,
            method: 'post',
            dataType: 'json',
            data: {

                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                //  console.log(data);
                renderChart(chartId, data);
            },
            error: function(xhr, error) {
                console.error("Error fetching data: ", error);
            }
        });
    }

    function renderChart(chartId, data) {
        let cardColor = config.colors.cardColor,
            headingColor = config.colors.headingColor,
            axisColor = config.colors.axisColor,
            borderColor = config.colors.borderColor;
        const chartData = {
            series: data.series,
            labels: data.categories,
            chart: {
                height: 165,
                width: 130,
                type: "donut"
            },
            colors: [config.colors.primary, config.colors.secondary, config.colors.info, config.colors.success],
            stroke: {
                width: 5,
                colors: [cardColor]
            },
            dataLabels: {
                enabled: false,
                formatter: function(value) {
                    return parseInt(value) + "%"
                }
            },
            legend: {
                show: false
            },
            grid: {
                padding: {
                    top: 0,
                    bottom: 0,
                    right: 15
                }
            },
            states: {
                hover: {
                    filter: {
                        type: "none"
                    }
                },
                active: {
                    filter: {
                        type: "none"
                    }
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: "75%",
                        labels: {
                            show: true,
                            value: {
                                fontSize: "1.5rem",
                                fontFamily: "Public Sans",
                                color: headingColor,
                                offsetY: -15,
                                formatter: function(value) {
                                    return parseInt(value)
                                }
                            },
                            name: {
                                offsetY: 20,
                                fontFamily: "Public Sans"
                            },
                            total: {
                                show: true,
                                fontSize: "0.8125rem",
                                color: axisColor,
                                label: "TOTAL",
                                formatter: function() {
                                    return data.totalproducts
                                }
                            }
                        }
                    }
                }
            }
        };
        const chartElement = document.querySelector(chartId);
        if (chartElement) {
            new ApexCharts(chartElement, chartData).render();
        } else {
            console.warn(`Chart element not found: ${chartId}`);
        }
    }
    const chartId = "#orderStatisticsCharts";
    const dataUrl = "orderstatisticschart";
    fetchDataAndRenderChart(chartId, dataUrl);


    // for  total revenue chart

    function fetchDatatotalrevenue(chartId, dataUrl) {
        $.ajax({
            url: dataUrl,
            method: 'post',
            dataType: 'json',
            data: {

                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                renderCharts(chartIds, data);
                // console.log(data);
            },
            error: function(xhr, error) {
                console.error("Error fetching data: ", error);
            }
        });
    }

    function renderCharts(chartId, data) {
        let cardColor = config.colors.cardColor,
            headingColor = config.colors.headingColor,
            axisColor = config.colors.axisColor,
            borderColor = config.colors.borderColor;
        let colors = [
            config.colors.primary,
            config.colors.info,
            "#FF5733",
            "#33FF57",
            "#5733FF",
            "#FF33A6"
            // Add more colors as needed
        ];
        // Extract unique months and sort them in chronological order
        let uniqueMonths = [...new Set(data.month)].sort((a, b) => {
            return new Date(Date.parse(a + " 1, 2020")) - new Date(Date.parse(b + " 1, 2020"));
        });

        // Map series data ensuring it's aligned with the uniqueMonths
        let seriesData = data.series.map(seriesItem => {
            let alignedData = uniqueMonths.map(month => {
                // If the month exists in the series labels, get the corresponding data point, otherwise set it to 0 or null
                let monthIndex = seriesItem.months.indexOf(month);
                return monthIndex > -1 ? seriesItem.data[monthIndex] : 0; // Adjust '0' to null or another placeholder if needed
            });
            return {
                name: seriesItem.name,
                data: alignedData
            };
        });

        const chartData = {
            series: seriesData,
            chart: {
                height: 300,
                stacked: true,
                type: "bar",
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "33%",
                    borderRadius: 12,
                    startingShape: "rounded",
                    endingShape: "rounded"
                }
            },
            colors: colors,
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth",
                width: 6,
                lineCap: "round",
                colors: [cardColor]
            },
            legend: {
                show: true,
                horizontalAlign: "left",
                position: "top",
                markers: {
                    height: 8,
                    width: 8,
                    radius: 12,
                    offsetX: -3
                },
                labels: {
                    colors: axisColor
                },
                itemMargin: {
                    horizontal: 10
                }
            },
            grid: {
                borderColor: borderColor,
                padding: {
                    top: 0,
                    bottom: -8,
                    left: 20,
                    right: 20
                }
            },
            xaxis: {
                categories: uniqueMonths,
                labels: {
                    style: {
                        fontSize: "13px",
                        colors: axisColor
                    }
                },
                axisTicks: {
                    show: false
                },
                axisBorder: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: "13px",
                        colors: axisColor
                    }
                }
            },
            responsive: [{
                    breakpoint: 1700,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "32%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 1580,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "35%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 1440,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "42%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 1300,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "48%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 1200,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "40%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 1040,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 11,
                                columnWidth: "48%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 991,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "30%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 840,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "35%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 768,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "28%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 640,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "32%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 576,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "37%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 480,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "45%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 420,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "52%"
                            }
                        }
                    }
                },
                {
                    breakpoint: 380,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "60%"
                            }
                        }
                    }
                }
            ],
            states: {
                hover: {
                    filter: {
                        type: "none"
                    }
                },
                active: {
                    filter: {
                        type: "none"
                    }
                }
            }
        };

        const chartElement = document.querySelector(chartId);
        if (chartElement) {
            new ApexCharts(chartElement, chartData).render();
        } else {
            console.warn(`Chart element not found: ${chartId}`);
        }
    }

    const chartIds = "#totalRevenueCharts";
    const dataUrls = "fetchDatatotalrevenue";
    fetchDatatotalrevenue(chartIds, dataUrls);

    // For growth charts

    function fetchDataAndRendergrowthChart(chartId, dataUrl, year = null, element = null) {
        if (year !== null) {
            const button = document.getElementById('growthReportId');
            button.innerHTML = year;
        }

        $('#growthCharts').empty();
        $.ajax({
            url: dataUrl,
            method: 'post',
            dataType: 'json',
            data: {
                year: year,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {

                renderChartgrowth(chartId, data);
                // console.log(data);
            },
            error: function(xhr, error) {
                console.error("Error fetching data: ", error);
            }
        });
    }

    function renderChartgrowth(chartId, data) {

        let highestYear = null;
        let highestValue = -Infinity;
        if (data.previous && Object.keys(data.previous).length > 0 && typeof data.previous === 'object') {
            $('#current').empty();
            for (const [year, amount] of Object.entries(data.previous)) {
                $('#current').append(`
                <div class="d-flex">
                    <div class="me-2">
                        <span class="badge bg-label-primary p-2">
                            <i class="bx bx-box text-primary"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-column">
                        <small>${year}</small>
                        <h6 class="mb-0">${(amount)}</h6>
                    </div>
                </div>
            `);
            }
        }

        if (data.curent && Object.keys(data.curent).length > 0 && typeof data.curent === 'object') {
            $('#company_growth').empty();
            $('#company_growth').append(`${highestValue}% Company Growth`);
            for (const [year, amount] of Object.entries(data.curent)) {
                $('#current').append(`
                <div class="d-flex">
                    <div class="me-2">
                        <span class="badge bg-label-primary p-2">
                            <i class="bx bx-box text-primary"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-column">
                        <small>${year}</small> <!-- Displaying the year -->
                        <h6 class="mb-0">${(amount)}</h6> <!-- Displaying the amount formatted as currency -->
                    </div>
                </div>
            `);
            }
        }
        if (data.series && typeof data.series === 'object') {
            for (const [year, value] of Object.entries(data.series)) {
                if (year > highestYear) {
                    highestValue = value; // Update the highest value
                    highestYear = year; // Store the year with the highest value
                }
            }
            if (data.curent && Object.keys(data.curent).length > 0 && typeof data.curent === 'object') {
                $('#company_growth').empty();
                $('#company_growth').append(`${highestValue}% Company Growth`);
            }
        } else {
            console.error('No series data available or invalid format.');
        }
        let cardColor = config.colors.cardColor,
            headingColor = config.colors.headingColor,
            axisColor = config.colors.axisColor,
            borderColor = config.colors.borderColor;
        const chartData = {
            series: [],
            labels: ["Growth"],
            chart: {
                height: 240,
                type: "radialBar"
            },
            plotOptions: {
                radialBar: {
                    size: 150,
                    offsetY: 10,
                    startAngle: -150,
                    endAngle: 150,
                    hollow: {
                        size: "55%"
                    },
                    track: {
                        background: cardColor,
                        strokeWidth: "100%"
                    },
                    dataLabels: {
                        name: {
                            offsetY: 15,
                            color: headingColor,
                            fontSize: "15px",
                            fontWeight: "500",
                            fontFamily: "Public Sans"
                        },
                        value: {
                            offsetY: -25,
                            color: headingColor,
                            fontSize: "22px",
                            fontWeight: "500",
                            fontFamily: "Public Sans"
                        }
                    }
                }
            },
            colors: [config.colors.primary],
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    shadeIntensity: 0.5,
                    gradientToColors: [config.colors.primary],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 0.6,
                    stops: [30, 70, 100]
                }
            },
            stroke: {
                dashArray: 5
            },
            grid: {
                padding: {
                    top: -35,
                    bottom: -10
                }
            },
            states: {
                hover: {
                    filter: {
                        type: "none"
                    }
                },
                active: {
                    filter: {
                        type: "none"
                    }
                }
            }
        };
        chartData.series.push(highestValue);
        const chartElement = document.querySelector(chartId);
        if (chartElement) {
            new ApexCharts(chartElement, chartData).render();
        } else {
            console.warn(`Chart element not found: ${chartIdss}`);
        }
    }
    const chartIdss = "#growthCharts";
    const dataUrlss = "growthcharts";
    fetchDataAndRendergrowthChart(chartIdss, dataUrlss);




    function formatSales(number) {
        if (number >= 1000000) {
            return (number / 1000000).toFixed(2) + 'm'; // Format for millions
        } else if (number >= 1000) {
            return (number / 1000).toFixed(2) + 'k'; // Format for thousands
        }
        return number.toFixed(2); // Default format
    }
</script>


@endsection