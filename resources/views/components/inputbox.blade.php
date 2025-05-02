@props(['for', 'label', 'type', 'name', 'value' => ''])

<div>
    <label for="{{ $for }}" class="block text-sm font-medium text-blue-500 mb-1">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}" 
           class="w-full border border-gray-300 rounded-lg p-2 text-white focus:ring focus:ring-blue-300" required>
    @error($name)
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>