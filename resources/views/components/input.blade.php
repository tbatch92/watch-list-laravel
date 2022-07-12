<input 
    {{ $attributes->merge(["type" => "text", "autocomplete" => "on"]) }}
    name="{{$name}}"
    value="{{old($name)}}"
    @error($name) invalid @enderror
/>