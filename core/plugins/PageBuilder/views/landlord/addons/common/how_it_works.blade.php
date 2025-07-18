@php
    if (str_contains($data['title'], '{h}') && str_contains($data['title'], '{/h}'))
    {
        $text = explode('{h}',$data['title']);

        $highlighted_word = explode('{/h}', $text[1])[0];

        $highlighted_text = '<span class="section-shape title-shape">'. $highlighted_word .'</span>';
        $final_title = '<h2 class="title">'.str_replace('{h}'.$highlighted_word.'{/h}', $highlighted_text, $data['title']).'</h2>';
    } else {
        $final_title = '<h2 class="title">'. $data['title'] .'</h2>';
    }
@endphp

<section class="works-area section-bg-1" data-padding-top="{{$data['padding_top']}}" data-padding-bottom="{{$data['padding_bottom']}}" id="{{$data['section_id']}}">
    <div class="container">
        <div class="section-title">
            {!! $final_title !!}
            <p class="section-para"> {{$data['subtitle']}} </p>
        </div>
        <div class="works-wrapper">
            <div class="row mt-4">
                @if(array_key_exists('repeater_title_', $data['repeater_data']))
                    @foreach($data['repeater_data']['repeater_title_'] as $key => $info)
                        <div class="col-lg-4 col-md-6 mt-4">
                            <div class="single-works center-text bg-black">
                                <div class="single-works-content">
                                    <span class="single-works-content-number"> {{$data['repeater_data']['repeater_number_'][$key] ?? ''}} </span>
                                    <h3 class="single-works-content-title mt-3"> {{$data['repeater_data']['repeater_title_'][$key] ?? ''}} </h3>
                                    <p class="single-works-content-para mt-3">  {{$data['repeater_data']['repeater_description_'][$key] ?? ''}} </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>