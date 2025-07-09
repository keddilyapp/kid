
@php
    $all_languages = \App\Facades\GlobalLanguage::all_languages();
@endphp

<nav>
    <div class="nav nav-tabs" role="tablist">
        @foreach($all_languages as $key => $lang)
            <a class="nav-item nav-link @if($key == 0) active @endif" 
               data-bs-toggle="tab" 
               href="#nav-home-{{ $lang->slug }}-{{ $rand ?? rand(999, 9999) }}" 
               role="tab" 
               aria-selected="true">
                {{ $lang->name }}
            </a>
        @endforeach
    </div>
</nav>

<div class="tab-content margin-top-30">
    @foreach($all_languages as $key => $lang)
        <div class="tab-pane fade @if($key == 0) show active @endif" 
             id="nav-home-{{ $lang->slug }}-{{ $rand ?? rand(999, 9999) }}" 
             role="tabpanel">
            {{ ${'content_' . $lang->slug} ?? $content ?? '' }}
        </div>
    @endforeach
</div>