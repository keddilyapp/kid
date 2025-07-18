@extends(route_prefix().'frontend.frontend-page-master')
@section('page-title')

    {{__('Order Cancelled Of:'.' '.($order_details->package_name ?? ''))}}
@endsection
@section('content')
    <div class="error-page-content bg-black padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-cancel-area text-center">
                        <h1 class="title">{{get_static_option('site_order_cancel_page_title')}}</h1>
                        <h3 class="sub-title mt-3">
                            @php
                                $subtitle = get_static_option('site_order_cancel_page_subtitle');
                                $subtitle = str_replace('{pkname}',$order_details->package_name ?? '',$subtitle);
                            @endphp
                            {{$subtitle}}
                        </h3>
                        <p class="mt-4">
                            {{get_static_option('site_order_cancel_page_description')}}
                        </p>
                        <div class="btn-wrapper text-center mt-4">
                            <a href="{{url('/')}}" class="cmn-btn cmn-btn-bg-1">{{__('Back To Home')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection