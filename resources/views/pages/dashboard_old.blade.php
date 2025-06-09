@extends('layouts.main') 
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')

        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
    @endpush

    <div class="container-fluid dashboard-cards">
        <div class="row">
            <!-- page statustic chart start -->
             <div class="col-xl-3 col-md-6">
                <a href="">
                    <div class="card card-red text-white">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="mb-0"></h4>
                                    <p class="mb-0">{{ __('Travelers')}}</p>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="ik ik-map f-30"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
            </div>
            <div class="col-xl-3 col-md-6">
                <a href="">
                    <div class="card card-blue text-white">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="mb-0"></h4>
                                    <p class="mb-0">{{ __('Locals')}}</p>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="ik ik-user f-30"></i>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6">
                <a href="">
                    <div class="card card-green text-white">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="mb-0"></h4>
                                    <p class="mb-0">{{ __('Services')}}</p>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="ik ik-settings f-30"></i>
                                </div>
                            </div>
                           <!--  <div id="Widget-line-chart3" class="chart-line chart-shadow"></div> -->
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6">
                <a href="">
                    <div class="card card-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0"></h4>
                                <p class="mb-0">{{ __('Locations')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-map-pin f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        </div>
    </div>
    @endsection
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
        <!-- <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script> -->
        <script src="{{ asset('plugins/flot-charts/curvedLines.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

        <script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>
       
        
        <script src="{{ asset('js/widget-statistic.js') }}"></script>
        <script src="{{ asset('js/widget-data.js') }}"></script>
        <script src="{{ asset('js/dashboard-charts.js') }}"></script>

        <!-- piechart-js-here -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>

       


<!-- linechart-js-one -->
<script src='https://www.gstatic.com/charts/loader.js'></script>

<style type="text/css">

.form-group{margin-bottom:0;}    
select.form-control{height: 30px !important;margin: 0;margin-left: auto;width:80px;}

</style>

        
    @endpush
