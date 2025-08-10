@props(['title', 'value', 'color' => 'gray'])

<div class="bg-{{ $color }}-100 border border-{{ $color }}-300 text-{{ $color }}-800 p-4 rounded shadow">
    <h2 class="text-lg font-semibold">{{ $title }}</h2>
    <p class="text-3xl mt-2 font-bold">{{ $value }}</p>
</div>
