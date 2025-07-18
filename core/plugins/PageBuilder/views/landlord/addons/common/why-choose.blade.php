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

<section class="choose-area section-bg-1" data-padding-top="{{$data['padding_top']}}" data-padding-bottom="60" id="{{$data['section_id']}}">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-5 mt-4">
                <div class="choose-thumb-content">
                    {!! \App\Facades\ImageRenderFacade::getParent($data['section_image'] ?? '', 'thumb')->getGrandChild(is_lazy: true)->render() !!}
                </div>
            </div>
            <div class="col-xl-7 col-lg-9 mt-4">
                <div class="choose-wrapper">
                    <div class="section-title text-left">
                        {!! $final_title !!}
                        <p class="section-para"> {{$data['subtitle']}} </p>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            @if(array_key_exists('repeater_title_', $data['repeater_data']))
                                @foreach($data['repeater_data']['repeater_title_'] ?? [] as $key => $info)
                                    <div class="single-choose bg-black radius-10 mt-4">
                                        <div class="single-choose-flex">
                                            <div class="single-choose-icon radius-10">
                                                {!! render_image_markup_by_attachment_id($data['repeater_data']['repeater_image_'][$key] ?? '') !!}
                                            </div>
                                            <div class="single-choose-content">
                                                <h3 class="single-choose-content-title">
                                                    <a href="javascript:void(0)"> {{$data['repeater_data']['repeater_title_'][$key]}} </a>
                                                </h3>
                                                <p class="single-choose-content-para"> {{$data['repeater_data']['repeater_subtitle_'][$key]}} </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>