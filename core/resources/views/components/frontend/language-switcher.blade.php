
@php
    $language_helper = new \App\Helpers\LanguageHelper();
    $all_languages = $language_helper->all_languages(1);
    $current_lang = $language_helper->user_lang();
@endphp

<div class="language-switcher">
    <div class="dropdown">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-globe"></i>
            {{ $current_lang->name ?? 'Language' }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
            @foreach($all_languages as $language)
                <li>
                    <a class="dropdown-item {{ $current_lang && $current_lang->slug === $language->slug ? 'active' : '' }}" 
                       href="{{ route('tenant.frontend.language.change', ['lang' => $language->slug]) }}">
                        {{ $language->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<style>
.language-switcher .dropdown-item.active {
    background-color: var(--bs-primary);
    color: white;
}
</style>