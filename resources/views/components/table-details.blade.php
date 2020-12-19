@props([
    'height' => ''
])

<div style="height: {{$height}}" class="align-middle overflow-x-scroll shadow sm:rounded-lg">
    <table class="min-w-full table-fixed divide-y divide-cool-gray-200">
        <thead>
            <tr>
                {{ $head }}
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-cool-gray-200">
            {{ $body }}
        </tbody>
    </table>
</div>
