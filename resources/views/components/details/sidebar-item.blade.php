@props([
    'label' => '',
    'selected' => ''
])

{{$selected}}
<a href="#"
    class="group flex items-center px-3 py-2 text-sm leading-5 font-medium
    {{$selected === 'true' ? ' border-indigo-600 text-indigo-600 bg-indigo-50' : ' text-gray-600 hover:text-gray-900 hover:bg-gray-50'}} border-l-4 focus:outline-none focus:bg-indigo-100
        transition ease-in-out duration-150">
    <svg
        class="mr-3 h-6 w-6 {{$selected === 'true' ? ' text-indigo-500' : ' text-gray-400 group-hover:text-gray-600 group-focus:text-gray-600'}} transition ease-in-out duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
    </svg>
    {{ $label }}
</a>