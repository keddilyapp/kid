
<div class="language-switcher">
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="las la-globe"></i>
            @if(isset($current_language))
                {{ $current_language->name }}
            @else
                {{ __('Language') }}
            @endif
        </button>
        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
            @if(isset($all_languages))
                @foreach($all_languages as $language)
                    <li>
                        <a class="dropdown-item language-change-btn" 
                           href="#" 
                           data-lang="{{ $language->slug }}"
                           @if(isset($current_lang_slug) && $current_lang_slug === $language->slug) style="font-weight: bold;" @endif>
                            {{ $language->name }}
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const languageButtons = document.querySelectorAll('.language-change-btn');
    
    languageButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const lang = this.getAttribute('data-lang');
            
            fetch('{{ route("language.change") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({lang: lang})
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.reload();
                }
            });
        });
    });
});
</script>