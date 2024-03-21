@props(['name', 'disabled' => false])

<textarea @disabled($disabled)
    oninput="this.style.height='auto';this.style.height = `${this.scrollHeight + 1.6}px`;" {!! $attributes->merge([
        'id' => $name,
        'name' => $name,
        'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm resize-none',
    ]) !!}></textarea>
