<th
    {{ $attributes->merge(['class' => 'px-6 py-1 bg-gray-200 text-left'])->only('class') }}
>
    <span class="flex items-center space-x-1 text-xs leading-4 font-medium text-center text-cool-gray-500 uppercase tracking-wider group focus:outline-none focus:underline">{{ $slot }}</span>
</th>
