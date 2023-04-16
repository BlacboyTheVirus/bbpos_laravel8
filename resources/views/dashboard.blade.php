@extends('layouts.app')

@section('title')
    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>
@endsection


@section('styles')
  
  <!-- Chart JS -->
  <link rel="stylesheet" href="{{ asset('plugins/chart.js/Chart.min.css') }}">

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-12 ">&nbsp;</div>

                                    <div class="card-tools">
                                        <div class="btn-group ">
                                            <button type="button" class="btn btn-info get_tab_records" period="today">Today</button>
                                            <button type="button" class="btn btn-info get_tab_records" period="week">This Week</button>
                                            <button type="button" class="btn btn-info get_tab_records" period="month">This Month</button>
                                            <button type="button" class="btn btn-info get_tab_records" period="year">This Year</button>
                                            <button type="button" class="btn btn-info get_tab_records active" period="all">All</button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3 class="font-weight-bold"><sup style="font-size: 20px">₦</sup>
                                                <span id="invoice_amount">0.00</span></h3>
                                            <p>Invoice Amount</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                        <a href="{{route('invoices.index')}}" class="small-box-footer">
                                            More info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3 class="font-weight-bold"><sup style="font-size: 20px">₦</sup>
                                                <span id="invoice_payment">0.00</span></h3>
                                            <p>Invoice Payments</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-money-bill-wave-alt"></i>
                                        </div>
                                        <a href="{{route('payments.index')}}" class="small-box-footer">
                                            More info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h3 class="font-weight-bold"><sup style="font-size: 20px">₦</sup>
                                                <span id="invoice_due">0.00</span></h3>
                                            <p>Invoice Due</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-credit-card"></i>
                                        </div>
                                        <a href="{{route('invoices.index')}}" class="small-box-footer">
                                            More info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6">

                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3 class="font-weight-bold"><sup style="font-size: 20px">₦</sup>
                                                <span id="expenses_total">0.00</span></h3>
                                            <p>Expenses</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-shopping-basket"></i>
                                        </div>
                                        <a href="{{route('expenses.index')}}" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                            </div> <!-- ROW -->


                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-file-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Invoices</span>
                                            <h5 class="info-box-number" id="invoice_count">0.00</h5>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-secondary elevation-1"><i
                                                class="fas fa-print"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Unique Jobs</span>
                                            <h5 class="info-box-number" id="job_count">0.00</h5>
                                        </div>

                                    </div>

                                </div>


                                <div class="clearfix hidden-md-up"></div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i
                                                class="fas fa-barcode"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Flex</span>
                                            <h5 class="info-box-number" id="flex_total">0.00</h5>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-info elevation-1"><i
                                                class="fas fa-barcode"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">SAV</span>
                                            <h5 class="info-box-number" id="sav_total">0.00</h5>
                                        </div>

                                    </div>

                                </div>

                            </div> <!-- ROW -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->



            <div class="row">
                <div class="col-md-5">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            Sales & Expense Bar Chart
                        </div>


                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                              </div>
                        </div>


                    </div>
                </div>

              

                <div class="col-md-3">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            Items (Flex / SAV)
                        </div>


                        <div class="card-body">
                            <canvas id="doughnut-chart" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                        </div>


                    </div>
                </div>




                <div class="col-md-4">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            Top Customers
                        </div>


                        <div class="card-body">
                            
                            <div class="box-body table-responsive">
                
                                    <table class="table table-responsive table-hover" style = "min-width: 100%">
                                        <thead>
                                            <tr class="bg-gray-light text-bold">
                                                <td>Rank</td>
                                                <td>Customer Name</td>
                                                <td>Invoice Count</td>
                                                <td>Total Invoice</td>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $top_customers as $key=> $customer )
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$customer->customer_name}}</td>
                                                <td>{{$customer->invoice_count}}</td>
                                                <td text-align="right" class="text-bold">{{money_format($customer->total_invoice)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <a href="{{route('customers.index')}}" class="uppercase">View All</a>
                                                </td>
                                            </tr>
                                    </tfoot>
                                </table>
                          
                            </div>

                        </div>


                    </div>
                </div>








            </div>



           




        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection


@section('scripts')

    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    

    <script>
        $('document').ready(function(){


           

            
            $.get('{{route('dashboard.barchartdata')}}', function (data) {
                  
                var barChartData = {
                
                datasets: [
                    {
                        label               : 'Sales',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                    },
                    {
                        label               : 'Expenses',
                        backgroundColor     : '#ffc107',
                        borderColor         : '#ffc107',
                        pointRadius         : false,
                        pointColor          : '#ffc107',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                    },
                ]
            };

            barChartData.labels= data.months;
            barChartData.datasets[0].data = data.sales ;
            barChartData.datasets[1].data = data.expenses;


            new Chart($("#barChart").get(0).getContext("2d"), {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        position: "top",
                        fontSize: 18,
                        fontColor: "#111"
                    },
                    legend: {
                        display: true,
                        position: "top",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0
                            }
                        }]
                    },
                   
                }
            });



            new Chart(document.getElementById("doughnut-chart"), {
                type: 'doughnut',
                data: {
                    labels: ['Flex', 'SAV'],
                    datasets: [
                        {
                            label: "Top Items",
                            backgroundColor: ["#28a745", "#17a2b8"],
                            data: data.totals
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Sales Items'
                    }
                }
             });



            }); //end get


            

            

            // barChartData.datasets[0].label = 'Sales';
            // barChartData.datasets[1].label = 'Expenses';

            // // barChartData.labels=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ];
            // // barChartData.datasets[0].data = [2800, 4800, 4000, 1900, 8600, 2700, 9000, 8100, 5600, 5500, 4000, 4800] ;
            // // barChartData.datasets[1].data = [6500, 5900, 8000, 8100, 5600, 5500, 4000, 4800, 4000, 1900, 8600, 2700];

            // barChartData.labels=a;
            // barChartData.datasets[0].data = b ;
            // barChartData.datasets[1].data = c;

                

           



            $(".get_tab_records").on("click",function(event) {
                if ($(this).hasClass('active')) return false;
                $(".get_tab_records").removeClass('active');
                $(this).addClass('active');
                gettabsdata($(this).attr('period'));
            });

            gettabsdata('all');

            function gettabsdata(period){
                $.ajax({
                    url: "{{ route('dashboard.gettabsdata') }}",
                    type: "get", //send it through get method
                    data: { 
                        'period': period
                    },
                    dataType: 'json',
                    beforeSend: function(){
                            $(".small-box, .info-box").append('<div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Loading...</div></div>');
                    },
                    success: function(response) {
                        var data = response;
                        $.each(data, function(index, element) {
                            $("#"+index).html(element);
                        });
                        $(".overlay").remove();
                    },
                    error: function(xhr) {
                        //Do Something to handle error
                    }
                });
            }
            
            

        });
    </script>

@endsection
