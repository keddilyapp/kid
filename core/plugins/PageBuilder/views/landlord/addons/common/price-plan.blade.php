@php
    $final_title = '';
    // Check if the title contains explicit highlighting tags
    if (str_contains($data['title'], '{h}') && str_contains($data['title'], '{/h}'))
    {
        $text = explode('{h}',$data['title']);
        $highlighted_word = explode('{/h}', $text[1])[0];
        $highlighted_text = '<span class="section-shape title-shape">'. $highlighted_word .'</span>';
        $final_title = '<h2 class="title">'.str_replace('{h}'.$highlighted_word.'{/h}', $highlighted_text, $data['title']).'</h2>';
    } else {
        // If no explicit tags, automatically highlight the first word
        $words = explode(' ', $data['title'], 2); // Split into at most 2 parts: first word and the rest
        if (count($words) > 1) {
            $highlighted_word = $words[0];
            $remaining_text = $words[1];
            $highlighted_text = '<span class="section-shape title-shape">'. $highlighted_word .'</span>';
            $final_title = '<h2 class="title">'. $highlighted_text . ' ' . $remaining_text .'</h2>';
        } else {
            // If only one word or no spaces, just apply the h2 with default styling
            $final_title = '<h2 class="title">'. $data['title'] .'</h2>';
        }
    }
@endphp

<style>
    /* Existing styles */
    .all-features a{
        color: var(--main-color-one);
    }
    .all-features a:hover{
        border-bottom: 1px solid var(--main-color-one);
    }
    .plan-description {
        background: var(--section-bg-1);
    }
    .plan-description p{
        text-align: justify;
        hyphens: none;
    }
    /* FIX: Ensure plan description remains readable on hover */
    .single-price:hover .plan-description {
        background: rgba(255, 255, 255, 0.2); /* Slightly transparent white on hover */
    }

    /* Styles for the main section background and border-radius */
    .pricing-area {
        background-color: black; /* Set background to black */
        border-radius: 60px; /* Apply 60px radius */
        color: white; /* Ensure text is white for readability on black background */
        padding: 60px; /* Add some padding to account for the radius */
    }

    /* Adjust elements within the pricing area for readability on black background */
    .pricing-area .section-title .section-para,
    .pricing-area .single-price-list-item span,
    .pricing-area .single-price-list-item strong {
        color: white; /* Ensure general text is white */
    }

    /* Set the main title color to white, the span inside will be main color */
    .pricing-area .section-title .title {
        color: white; /* Set main title to white */
    }

    /* Ensure the highlighted part of the title uses the main site color */
    .section-shape.title-shape {
        color: var(--main-color-one); /* This class applies the main color */
    }

    /* Adjust plan-description for black background */
    .pricing-area .plan-description {
        background: rgba(255, 255, 255, 0.1); /* Dark grey for plan description background */
        color: white; /* Ensure text inside plan description is white */
    }

    /* Adjust the pricing tab list container */
    .pricing-tab-list {
        background-color: transparent; /* Ensure the container itself is transparent or matches main area */
        border-radius: 10px; /* Maintain consistent border-radius */
        padding: 15px; /* Add some padding for better appearance */
    }
    /* Set background for the ul containing tab list items */
    .pricing-tab-list ul.tabs {
        background-color: black; /* Set background to black for the ul */
        border-radius: 10px; /* Match parent border-radius */
        padding: 5px; /* Add some padding inside the black background */
    }

    .pricing-tab-list ul.tabs li {
        color: white; /* Ensure inactive tab text is white */
        border: 1px solid rgba(255, 255, 255, 0.3); /* Lighter border for tabs */
        background-color: #333; /* Set background to dark gray for the tab items */
    }
    .pricing-tab-list ul.tabs li.active {
        background-color: var(--main-color-one); /* Active tab uses main color */
        color: white; /* Ensure text is white on active tab */
    }
    .pricing-tab-list ul.tabs li:hover {
        background-color: var(--main-color-one);
        color: white;
    }

    /* Adjust single-price card background to remove "white mark" */
    .single-price {
        background-color: transparent; /* Make default background transparent */
        border: 1px solid rgba(255, 255, 255, 0.2); /* Keep a subtle border */
        transition: background-color 0.3s ease, border-color 0.3s ease; /* Smooth transition */
    }

    /* Pricing plan headings to main site color */
    .single-price-top-plan,
    .single-price-top-title {
         /* Set pricing plan headings to main site color */
    }
    .single-price-top-title sub {
        color: var(--main-color-one); /* Ensure sub text also matches */
    }

    .single-price.active {
        background-color: black; /* Active price card uses main color */
        color: white; /* Ensure text is white */
        border-color: var(--main-color-one); /* Highlight border too */
    }

    /* Ensure text inside active card is white */
    .single-price.active .single-price-top-title,
    .single-price.active .single-price-top-plan,
    .single-price.active .single-price-top-title sub {
    }


    /* Add a subtle hover effect for non-active cards */
    .single-price:not(.active):hover {
        background-color: rgba(255, 255, 255, 0.05); /* Very subtle background on hover for non-active */
    }

    /* Adjust button colors for contrast */
    .cmn-btn-outline-one.color-one {
        border-color: white;
        color: white;
    }
    .cmn-btn-outline-one.color-one:hover {
        background-color: white;
        color: black;
    }
</style>

<section class="pricing-area section-bg-1" data-padding-top="{{$data['padding_top']}}"
         data-padding-bottom="{{$data['padding_bottom']}}" id="{{$data['section_id']}}">
    <div class="container">
        <div class="section-title">
            {!! $final_title !!}
            <p class="section-para"> {{$data['subtitle']}} </p>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-lg-6 mt-4">
                <div class="pricing-tab-list center  center-text">
                    <ul class="tabs price-tab radius-10">
                        @foreach(($data['plan_types']) as $type)
                            @php
                                $type_data_tab = match ($type) {
                                    0 => 'month',
                                    1 => 'year',
                                    2 => 'lifetime'
                                };
                            @endphp
                            <li data-tab="tab-{{$type_data_tab}}" class="price-tab-list {{$loop->first ? 'active' : ''}}"> {{\App\Enums\PricePlanTypEnums::getText($type)}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @foreach($data['all_price_plan'] as $plan_type => $plan_items)
            @php
                $id= '';
                $active = '';
                $period = '';
                if($plan_type == 0){
                    $id = 'month';
                    $active = 'show active';
                    $period = __('/mo');
                }elseif($plan_type == 1){
                    $id = 'year';
                     $period = __('/yr');
                }else{
                     $id = 'lifetime';
                     $period = __('/lt');
                }

                $content_center_class = count($plan_items) <= 3 ? 'justify-content-center' : '';
            @endphp

            <div class="tab-content-item {{$active}}" id="tab-{{$id}}">
                <div class="row {{$content_center_class}} mt-4">
                    @foreach($plan_items as $key => $price_plan_item)
                        @php
                            $featured_condition = $key == 1 ? 'active' : '';
                        @endphp

                        <div class="col-lg-4 col-md-6 mt-4">
                            <div class="single-price radius-10 {{$featured_condition}}">
                                <span class="single-price-sub-title mb-5 radius-5"> {{$price_plan_item->package_badge}} </span>
                                <div class="single-price-top center-text">
                                    <span
                                        class="single-price-top-plan"> {{$price_plan_item->title}} </span>
                                    <h3 class="single-price-top-title mt-4"> {{amount_with_currency_symbol($price_plan_item->price)}}
                                        <sub>{{$period}}</sub></h3>
                                </div>
                                <ul class="single-price-list mt-4">
                                    @if(!empty($price_plan_item->page_permission_feature))
                                        <li class="single-price-list-item">
                                            <span class="check-icon"> <i class="las la-check"></i> </span>
                                            <span>
                                                <strong>
                                                    @if($price_plan_item->page_permission_feature < 0)
                                                        {{__('Page Unlimited')}}
                                                    @else
                                                        {{ __(sprintf('Page %d', $price_plan_item->page_permission_feature) )}}
                                                    @endif
                                                </strong>
                                            </span>
                                        </li>
                                    @endif

                                    @if(!empty($price_plan_item->product_permission_feature))
                                        <li class="single-price-list-item">
                                            <span class="check-icon"> <i class="las la-check"></i> </span>
                                            <span>
                                                <strong>
                                                    @if($price_plan_item->product_permission_feature < 0)
                                                        {{__('Product Unlimited')}}
                                                    @else
                                                        {{ __(sprintf('Product %d',$price_plan_item->product_permission_feature) )}}
                                                    @endif
                                                </strong>
                                            </span>
                                        </li>
                                    @endif

                                    @if(!empty($price_plan_item->blog_permission_feature))
                                        <li class="single-price-list-item">
                                            <span class="check-icon"> <i class="las la-check"></i> </span>
                                            <span>
                                                <strong>
                                                    @if($price_plan_item->blog_permission_feature < 0)
                                                        {{__('Blog Unlimited')}}
                                                    @else
                                                        {{ __(sprintf('Blog %d',$price_plan_item->blog_permission_feature) )}}
                                                    @endif
                                                </strong>
                                            </span>
                                        </li>
                                    @endif

                                    @if(!empty($price_plan_item->storage_permission_feature))
                                        <li class="single-price-list-item">
                                            <span class="check-icon"> <i class="las la-check"></i> </span>
                                            <span>
                                                <strong>
                                                    @if($price_plan_item->storage_permission_feature < 0)
                                                        {{__('Storage Unlimited')}}
                                                    @else
                                                        {{ __(sprintf('Storage %d MB',$price_plan_item->storage_permission_feature) )}}
                                                    @endif
                                                </strong>
                                            </span>
                                        </li>
                                    @endif
                                </ul>

                                @if(!empty($price_plan_item->description))
                                    <div class="mt-4 p-3 rounded plan-description">
                                        <p>{!! $price_plan_item->description !!}</p>
                                    </div>
                                @endif

                                <div class="btn-wrapper text-center all-features mt-4 mt-lg-4">
                                    <a href="{{route('landlord.frontend.plan.order',$price_plan_item->id)}}">{{__('View All Features')}}</a>
                                </div>
                                <div class="btn-wrapper mt-4 mt-lg-4">
                                    @php
                                        $buy_text = $price_plan_item->price > 0 ? __('Buy Now') : __('Get Now');
                                    @endphp
                                    @if($price_plan_item->has_trial == true)
                                        <div class="d-flex justify-content-center">
                                            <a href="{{route('landlord.frontend.plan.order',$price_plan_item->id)}}" class="cmn-btn cmn-btn-outline-one color-one w-100 mx-1">
                                                {{$buy_text}} </a>

                                            <a href="{{route('landlord.frontend.plan.view',[$price_plan_item->id, 'trial'])}}" class="cmn-btn cmn-btn-outline-one color-one w-100 mx-1">
                                                {{__('Try Now')}} </a>
                                        </div>
                                    @else
                                        <a href="{{route('landlord.frontend.plan.order',$price_plan_item->id)}}" class="cmn-btn cmn-btn-outline-one color-one w-100">
                                            {{$buy_text}} </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>