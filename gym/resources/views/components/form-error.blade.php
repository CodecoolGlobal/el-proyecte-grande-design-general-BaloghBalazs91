@props(['name'])

@error($name)
    <p class="text-danger text-sm-start">{{ $message }}</p>
@enderror
