<div>
    <div class="flex">
            {{--  SIDEBAR  --}}
            <div class="h-64 mt-10 bg-gray-100 ">
                <div class="flex w-full max-w-xs p-4 bg-white">
                    <ul class="flex flex-col w-full">
                        <li class="my-px">
                            <a href="#"
                            class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 {{$currentMenu === 'Details' ? ' bg-gray-100' : 'hover:bg-gray-100'}}">
                                <span class="flex items-center justify-center text-lg text-gray-400">
                                    <svg fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        class="h-6 w-6">
                                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </span>
                                <span
                                    wire:click="$set('currentMenu', 'Details')"
                                    class="ml-3">Vehicle Details</span>
                            </a>
                        </li>

                        <li class="my-px">
                            <a href="#"
                            class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 {{$currentMenu === 'Drivers' ? ' bg-gray-100' : 'hover:bg-gray-100'}}">
                                <span class="flex items-center justify-center text-lg text-gray-400">
                                    <svg fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        class="h-6 w-6">
                                        <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                    </svg>
                                </span>
                                <span
                                    wire:click="$set('currentMenu', 'Drivers')"
                                    class="ml-3">Drivers</span>
                            </a>
                        </li>
                        <li class="my-px">
                            <a href="#"
                            class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 hover:bg-gray-100">
                                <span class="flex items-center justify-center text-lg text-gray-400">
                                    <svg fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        class="h-6 w-6">
                                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                </span>
                                <span
                                    wire:click="$set('currentMenu', 'Verification')"
                                    class="ml-3">Verification Data</span>
                            </a>
                        </li>
                        <li class="my-px">
                            <a href="#"
                            class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 hover:bg-gray-100">
                                <span class="flex items-center justify-center text-lg text-gray-400">
                                    <svg fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        class="h-6 w-6">
                                        <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </span>
                                <span class="ml-3">Notes & Files</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            {{--  Vehicle INFORMATION / DRIVERS  --}}
            @if ($currentMenu === 'Details')
                <div class="bg-white shadow overflow-hidden w-5/6 mx-auto mt-10 sm:rounded-lg">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Vehicle Information
                    </h3>
                </div>
                <div class="px-4 py-5 sm:px-6">
                    <dl class="grid grid-cols-1 col-gap-4 row-gap-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                Vehicle Registration
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900">
                                {{$vehicle->rego}}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                Vehicle VIN
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900">
                                {{$vehicle->vin}}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                Make
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900">
                                {{$vehicle->make}}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                            Model
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900">
                                {{$vehicle->model}}
                            </dd>
                        </div>

                        <div class="sm:col-span-1">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                            Client
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900">
                                Test Client
                            </dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-lg leading-5 font-semibold text-gray-900">
                            Main Contact Details
                            </dt>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                            Name
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900">
                                {{$vehicle->name}}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                            Phone
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900">
                                {{$vehicle->phone}}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                            Email
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900">
                                {{$vehicle->email}}
                            </dd>
                        </div>
                    </dl>
                </div>

                @elseif ($currentMenu === 'Notes')
                <div class="py-4  mx-auto mt-10 w-5/6">

                    <div class="space-y-4">
                        <x-table>
                            <x-slot name="head">
                                <x-table.heading>
                                    Date Added
                                </x-table.heading>

                                <x-table.heading>
                                    Note
                                </x-table.heading>
                                <x-table.heading>
                                    Created By
                                </x-table.heading>
                                <x-table.heading></x-table.heading>
                            </x-slot>

                            <x-slot name="body">
                                <x-table.row>

                                        <x-table.cell>
                                            Driver 1
                                        </x-table.cell>

                                    <x-table.cell>
                                        56456645
                                    </x-table.cell>
                                    <x-table.cell>
                                        886787678687
                                    </x-table.cell>
                                    <x-table.cell>
                                        <x-button.link>Edit</x-button.link>
                                    </x-table.cell>
                                </x-table.row>
                            </x-slot>
                        </x-table>
                        <div>
                        </div>
                    </div>
                </div>

                @elseif ($currentMenu === 'Drivers')
                <div class="py-4  mx-auto mt-10 w-5/6">

                    <div class="space-y-4">
                        <x-table>
                            <x-slot name="head">
                                <x-table.heading>
                                    Driver Name
                                </x-table.heading>

                                <x-table.heading>
                                    Driver Phone
                                </x-table.heading>
                                <x-table.heading>
                                    Driver Email
                                </x-table.heading>
                                <x-table.heading></x-table.heading>
                            </x-slot>

                            <x-slot name="body">
                                <x-table.row>

                                        <x-table.cell>
                                            Driver 1
                                        </x-table.cell>

                                    <x-table.cell>
                                        56456645
                                    </x-table.cell>
                                    <x-table.cell>
                                        886787678687
                                    </x-table.cell>
                                    <x-table.cell>
                                        <x-button.link>Edit</x-button.link>
                                    </x-table.cell>
                                </x-table.row>
                            </x-slot>
                        </x-table>
                        <div>
                        </div>
                    </div>
                </div>

                @elseif ($currentMenu === 'Verification')
                    @if ($step === 1) <livewire:vehicle-axle-spacing /> @endif
                    @if ($step === 2) <livewire:ratings /> @endif
                    @if ($step === 3) <livewire:vehicle-tare-weights/> @endif
                @endif
        </div>
    </div>

</div>