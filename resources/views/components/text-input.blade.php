@props(['name', 'disabled' => false])

<input @disabled($disabled) {!! $attributes->merge([
    'id' => $name,
    'name' => $name,
    'class' => 'border-gray-300 focus:border-indigo-500  focus:ring-indigo-500 rounded-md shadow-sm',
]) !!}>
