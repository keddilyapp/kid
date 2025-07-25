<section class="contact-area section-bg-1 padding-top-95 padding-bottom-60">
    <div class="container">
        <div class="row g-0">
            @if(array_key_exists('repeater_title_', $data['repeater_data']))
                @foreach($data['repeater_data']['repeater_title_'] as $key => $value)
                    <div class="col-lg-4 col-sm-6 contact-child">
                        <div class="single-contact center-text bg-black">
                            <div class="single-contact-content">
                                <div class="single-contact-content-icon radius-10">
                                    {!! render_image_markup_by_attachment_id($data['repeater_data']['repeater_image_'][$key]) !!}
                                </div>
                                <div class="single-contact-content-details mt-4">
                                    <h3 class="single-contact-content-title"> {{$data['repeater_data']['repeater_title_'][$key]}} </h3>
                                    <span class="single-contact-content-link">
                                    <a href="javascript:void(0)">{{$data['repeater_data']['repeater_info_'][$key]}}</a>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

@section('scripts')
    <x-custom-js.contact-form-store/>
@endsection