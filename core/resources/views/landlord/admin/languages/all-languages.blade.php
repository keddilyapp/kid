
@extends('landlord.admin.admin-master')

@section('title')
    {{ __('All Languages') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{ __('All Languages') }}</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLanguageModal">
                                {{ __('Add New Language') }}
                            </button>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Slug') }}</th>
                                        <th>{{ __('Direction') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Default') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_languages as $language)
                                        <tr>
                                            <td>{{ $language->id }}</td>
                                            <td>{{ $language->name }}</td>
                                            <td>{{ $language->slug }}</td>
                                            <td>
                                                <span class="badge badge-{{ $language->direction == 1 ? 'warning' : 'info' }}">
                                                    {{ $language->direction == 1 ? 'RTL' : 'LTR' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $language->status == 1 ? 'success' : 'danger' }}">
                                                    {{ $language->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($language->default == 1)
                                                    <span class="badge badge-primary">{{ __('Default') }}</span>
                                                @else
                                                    <button class="btn btn-sm btn-outline-primary set-default-btn" data-id="{{ $language->id }}">
                                                        {{ __('Set Default') }}
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-language-btn" 
                                                        data-id="{{ $language->id }}"
                                                        data-name="{{ $language->name }}"
                                                        data-slug="{{ $language->slug }}"
                                                        data-direction="{{ $language->direction }}"
                                                        data-status="{{ $language->status }}">
                                                    {{ __('Edit') }}
                                                </button>
                                                <a href="{{ route('landlord.admin.languages.edit.words', $language->slug) }}" class="btn btn-sm btn-info">
                                                    {{ __('Edit Words') }}
                                                </a>
                                                @if($language->default != 1)
                                                    <button class="btn btn-sm btn-danger delete-language-btn" data-id="{{ $language->id }}">
                                                        {{ __('Delete') }}
                                                    </button>
                                                @endif
                                            </td>
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

    <!-- Add Language Modal -->
    <div class="modal fade" id="addLanguageModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add New Language') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addLanguageForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('Language Name') }}</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Language Slug') }}</label>
                            <input type="text" name="slug" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Direction') }}</label>
                            <select name="direction" class="form-control">
                                <option value="0">{{ __('LTR') }}</option>
                                <option value="1">{{ __('RTL') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Add Language') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Language Modal -->
    <div class="modal fade" id="editLanguageModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Edit Language') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editLanguageForm">
                    <input type="hidden" name="id" id="edit_language_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('Language Name') }}</label>
                            <input type="text" name="name" id="edit_language_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Language Slug') }}</label>
                            <input type="text" name="slug" id="edit_language_slug" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Direction') }}</label>
                            <select name="direction" id="edit_language_direction" class="form-control">
                                <option value="0">{{ __('LTR') }}</option>
                                <option value="1">{{ __('RTL') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Status') }}</label>
                            <select name="status" id="edit_language_status" class="form-control">
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update Language') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    // Add language form submission
    $('#addLanguageForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '{{ route("landlord.admin.languages.store") }}',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                }
            }
        });
    });

    // Edit language button click
    $('.edit-language-btn').on('click', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const slug = $(this).data('slug');
        const direction = $(this).data('direction');
        const status = $(this).data('status');

        $('#edit_language_id').val(id);
        $('#edit_language_name').val(name);
        $('#edit_language_slug').val(slug);
        $('#edit_language_direction').val(direction);
        $('#edit_language_status').val(status);

        $('#editLanguageModal').modal('show');
    });

    // Edit language form submission
    $('#editLanguageForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '{{ route("landlord.admin.languages.update") }}',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                }
            }
        });
    });

    // Set default language
    $('.set-default-btn').on('click', function() {
        const id = $(this).data('id');
        
        $.ajax({
            url: '{{ route("landlord.admin.languages.set.default") }}',
            method: 'POST',
            data: {id: id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                }
            }
        });
    });

    // Delete language
    $('.delete-language-btn').on('click', function() {
        const id = $(this).data('id');
        
        if (confirm('Are you sure you want to delete this language?')) {
            $.ajax({
                url: '{{ route("landlord.admin.languages.delete") }}',
                method: 'POST',
                data: {id: id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                }
            });
        }
    });
});
</script>
@endsection