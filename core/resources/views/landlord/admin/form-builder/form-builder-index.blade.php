<div class="btn-wrapper d-flex gap-2">
                        <div class="language-selector">
                            <select class="form-control" id="language_selector" onchange="changeLanguage()">
                                @foreach($all_languages as $lang)
                                    <option value="{{ $lang->slug }}" {{ $current_lang == $lang->slug ? 'selected' : '' }}>
                                        {{ $lang->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <a href="#"
                           class="btn btn-primary"
                           data-bs-toggle="modal"
                           data-bs-target="#new_form_builder_modal"
                        >{{__('Add New Form')}}</a>
                    </div>
<x-fields.textarea name="success_message" label="{{__('Success Message')}}" value="{{old('success_message')}}"/>
                <div class="form-group">
                    <label for="language">{{__('Language')}}</label>
                    <select name="lang" class="form-control">
                        @foreach($all_languages as $lang)
                            <option value="{{ $lang->slug }}" {{ $current_lang == $lang->slug ? 'selected' : '' }}>
                                {{ $lang->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="fields">{{__('Form Fields')}}</label>
                    <textarea name="fields" id="fields" cols="30" rows="10" class="form-control">{{old('fields')}}</textarea>
                </div>