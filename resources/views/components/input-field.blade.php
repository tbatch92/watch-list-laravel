<div>
    <label for="{{$name}}">{{ $label }}</label>
    <div>{{ $slot }}</div>
    @error($name)
        <div>{{ $message }}</div>
    @enderror
</div>