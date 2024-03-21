@props(['name'])

<ul x-show="errors?.[@js($name)]" {{ $attributes->merge(['class' => 'text-sm text-red-600  space-y-1']) }}>
    <template x-for="error in errors?.[@js($name)]">
        <li x-text="error"></li>
    </template>
</ul>
