<input type="checkbox" name="{{ $inputName }}" id="{{ $inputId ?? $inputName }}" {{ old($inputName) ? 'checked' : ''}} class="c-checkbox">
<label class="c-checkbox__label" for="{{ $inputName }}">{{ __($labelTitle) }}</label>