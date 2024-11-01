<div class="flex justify-{{ $position }}">
    {!! NoCaptcha::display(['data-theme' => $theme]) !!}
</div>

<div class="flex justify-{{ $position }}">
    @error('g-recaptcha-response')
    <span class="text-red-500">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

{!! NoCaptcha::renderJs() !!}
