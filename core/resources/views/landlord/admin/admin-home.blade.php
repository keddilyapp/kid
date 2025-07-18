@extends('landlord.admin.admin-master')

@section('title')
    {{__('Dashboard')}}
@endsection

@section('style')
    <link href="{{ global_asset('assets/landlord/admin/css/update-info.css') }}" rel="stylesheet">
@endsection

@section('content')
    @inject('healthHelper', 'App\Helpers\SiteHealthHelper')

    @if(!tenant() && $healthHelper->getIssues() > 0)
        <div class="alert alert-danger rounded">
            <p><strong class="text-danger"> {{$healthHelper->issueMessage()}} </strong></p>
            <p>{{ __('If all necessary server values are not configured correctly, it may affect the system’s functionality.') }}
                <a class="text-decoration-none" href="{{$healthHelper->getReadMore()['route']}}">{{$healthHelper->getReadMore()['text']}}</a></p>
        </div>
    @endif

    <div class="col-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-xl-4 col-md-6 stretch-card">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{global_asset('assets/landlord/admin/images/circle.png')}}"
                                     class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-bold mb-3">{{__('Total Admins')}}<i
                                            class="las la-user-shield mdi-24px float-right"></i>
                                </h4>
                                <h1 class="mb-5">{{$total_admin}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 stretch-card">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{global_asset('assets/landlord/admin/images/circle.png')}}"
                                     class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-bold mb-3">{{__('Total Users')}}<i
                                            class="las la-user-shield mdi-24px float-right"></i>
                                </h4>
                                <h1 class="mb-5">{{$total_user}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 stretch-card">
                        <div class="card bg-gradient-success card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{global_asset('assets/landlord/admin/images/circle.png')}}"
                                     class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-bold mb-3">{{__('Total Shops')}}
                                    <i class="mdi mdi-store mdi-24px float-right"></i>
                                </h4>
                                <h1 class="mb-5">{{$all_tenants}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 stretch-card">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{global_asset('assets/landlord/admin/images/circle.png')}}"
                                     class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-bold mb-3">{{__('Total Testimonial')}} <i
                                            class="mdi mdi-diamond mdi-24px float-right"></i>
                                </h4>
                                <h1 class="mb-5">{{$total_testimonial}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 stretch-card">
                        <div class="card bg-gradient-primary card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{global_asset('assets/landlord/admin/images/circle.png')}}"
                                     class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-bold mb-3">{{__('Total Price Plan')}}<i
                                            class="mdi mdi-diamond mdi-24px float-right"></i>
                                </h4>
                                <h1 class="mb-5">{{$total_price_plan}}</h1>
                            </div>
                        </div>
                    </div>
                    {{--                    <div class="col-xl-4 col-md-6 stretch-card">--}}
                    {{--                        <div class="card bg-gradient-warning card-img-holder text-white">--}}
                    {{--                            <div class="card-body">--}}
                    {{--                                <img src="{{global_asset('assets/landlord/admin/images/circle.png')}}" class="card-img-absolute" alt="circle-image">--}}
                    {{--                                <h4 class="font-weight-normal mb-3">{{__('Total Brand')}} <i class="mdi mdi-diamond mdi-24px float-right"></i>--}}
                    {{--                                </h4>--}}
                    {{--                                <h2 class="mb-5">{{$total_brand}}</h2>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    @php
                        $themes = getAllThemeSlug();
                    @endphp
                    <div class="col-xl-4 col-md-6 stretch-card mt-3">
                        <div class="card bg-gradient-warning card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{global_asset('assets/landlord/admin/images/circle.png')}}"
                                     class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-bold mb-3">{{__('Total Theme')}} <i
                                            class="mdi mdi-diamond mdi-24px float-right"></i>
                                </h4>
                                <h1 class="mb-5">{{count($themes)}}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-sm-12 mt-5">
                        <div class="chart-wrapper margin-top-40">
                            <h2 class="chart-title">{{__("Amount Per Month In")}} {{date('Y')}}</h2>
                            <canvas id="monthlyRaised"></canvas>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-sm-12 mt-5">
                        <div class="chart-wrapper margin-top-40">
                            <h2 class="chart-title">{{__("Amount Per Day In Last 30Days")}}</h2>
                            <div>
                                <canvas id="monthlyRaisedPerDay"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-5">
                        <div class="recent_order_logs_wrap">
                            <h3 class=" text-center mb-4">{{__('Recent Order Logs')}}</h3>
                            <div class="recent_order_logs">
                                <table class="table table-bordered">
                                    <thead class="text-white" style="background-color: #b66dff">
                                    <tr>
                                        <th> {{__('ID')}} </th>
                                        <th> {{__('Order ID')}}</th>
                                        <th> {{__('User Name')}}</th>
                                        <th> {{__('Package Name')}}</th>
                                        <th> {{__('Price')}} </th>
                                        <th> {{__('Subdomain')}} </th>
                                        <th> {{__('Payment Status')}} </th>
                                        <th> {{__('Order Status')}} </th>
                                        <th> {{__('Created At')}} </th>
                                        <th> {{__('Renewed At')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($recent_order_logs as $key => $data)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$data->package_id ?? ''}}</td>
                                            <td>{{$data->name}}</td>
                                            <td> {{$data->package_name}}</td>
                                            <td>{{amount_with_currency_symbol($data->package_price)}}</td>
                                            <td>{{$data->tenant_id}}</td>
                                            @php
                                                $status = ['pending' => 'text-warning', 'complete' => 'text-success'];
                                            @endphp
                                            <td class="{{$status[$data->payment_status]}} text-capitalize">{{$data->payment_status}}</td>
                                            <td class="{{$data->status != 'trial' ? $status[$data->payment_status] : 'text-primary'}} text-capitalize">{{$data->status}}</td>
                                            <td>{{$data->created_at?->diffForHumans()}}</td>
                                            <td>{{$data->updated_at?->diffForHumans()}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @includeWhen(count($update_info) > 0,'landlord.admin.partials.update-info', $update_info)
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/landlord/admin/js/update-info.js')}}"></script>
    <script src="{{asset('assets/common/js/chart.js')}}"></script>
    <script>
        $.ajax({
            url: '{{route('landlord.admin.home.chart.data.month')}}',
            type: 'POST',
            async: false,
            data: {
                _token: "{{csrf_token()}}"
            },
            success: function (data) {
                labels = data.labels;
                chartdata = data.data;
                new Chart(
                    document.getElementById('monthlyRaised'),
                    {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '{{__('Amount Received')}}',
                                backgroundColor: '#039cda',
                                borderColor: '#039cda',
                                data: chartdata,
                                barThickness: 15,
                                hoverBackgroundColor: '#fc3c68',
                                borderRadius: 5,
                                hoverBorderColor: '#fc3c68',
                                minBarLength: 50,
                                indexAxis: "x",
                                pointStyle: 'star',
                            }],
                        }
                    }
                );
            }
        });
        $.ajax({
            url: '{{route('landlord.admin.home.chart.data.by.day')}}',
            type: 'POST',
            async: false,
            data: {
                _token: "{{csrf_token()}}"
            },
            success: function (data) {
                labels = data.labels;
                chartdata = data.data;
                new Chart(
                    document.getElementById('monthlyRaisedPerDay'),
                    {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '{{__('Amount Received')}}',
                                backgroundColor: '#F86048',
                                borderColor: '#fd861d',
                                data: data.data,
                            }]
                        }
                    }
                );
            }
        });
    </script>
@endsection