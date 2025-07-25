@extends('landlord.frontend.frontend-page-master')
@section('page-title')
    {{__('Order Cancelled')}}
@endsection
@section('title')
    {{__('Order Cancelled')}}
@endsection
@section('content')
    <div class="error-page-content bg-black padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-cancel-area">
                         <div class="alert alert-warning text-center">
                              <h3 class="title">{{ get_static_option('site_order_cancel_page_title') ?? __('Your Order Has been canceled') }}</h3>
                         </div>
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <h5>{{ get_static_option('site_order_cancel_page_subtitle') ?? __('Your Order Has been canceled') }}</h5>
                                <p>{{ get_static_option('site_order_cancel_page_description') ?? __('Your Order Has been canceled') }}</p>
                            </div>
                        </div>
                        <div class="btn-wrapper mt-5 text-center">
                            <a href="{{url('/')}}" class="boxed-btn btn btn-primary rounded-1">{{__('Back To Home')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection