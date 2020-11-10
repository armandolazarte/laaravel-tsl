<div>
        {{--  SIDEBAR  --}}
        <div class="mx-auto w-5/6">
            <div class="sm:hidden">
                <select aria-label="Selected tab" class="mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5 transition ease-in-out duration-150">
                <option>My Account</option>
                <option>Company</option>
                <option selected>Team Members</option>
                <option>Billing</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <div class="border-b border-gray-200">
                <nav class="-mb-px flex">
                    <a
                        wire:click="$set('currentMenu', 'Details')"
                        href="#"
                        class="whitespace-no-wrap py-4 px-1 border-b-2 font-medium text-sm leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 {{$currentMenu === 'Details' ? ' border-indigo-500 text-indigo-600' : 'border-transparent'}}">
                        Vehicle Details
                    </a>

                    <a
                        wire:click="$set('currentMenu', 'Drivers')"
                        href="#"
                        class="whitespace-no-wrap ml-8 py-4 px-1 border-b-2 font-medium text-sm leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 {{$currentMenu === 'Drivers' ? ' border-indigo-500 text-indigo-600' : 'border-transparent'}}">
                        Drivers
                    </a>
                    <a wire:click="$set('currentMenu', 'Notes')"
                        href="#"
                        class="whitespace-no-wrap ml-8 py-4 px-1 border-b-2  font-medium text-sm leading-5 focus:outline-none focus:text-indigo-800 focus:border-indigo-700 {{$currentMenu === 'Notes' ? ' border-indigo-500 text-indigo-600' : 'border-transparent'}}">
                        Notes & Files
                    </a>
                    <a
                        wire:click="$set('currentMenu', 'Verification')"
                        href="#"
                        class="whitespace-no-wrap ml-8 py-4 px-1 border-b-2  font-medium text-sm leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 {{$currentMenu === 'Verification' ? ' border-indigo-500 text-indigo-600' : 'border-transparent'}}">
                        Verification
                    </a>
                </nav>
                </div>
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
            <div class="w-full">
            <div class="py-6">
                <div class="flex">
                    <div class="w-1/4">
                    <div class="relative mb-2">
                        <div class="w-10 h-10 mx-auto bg-green-500 rounded-full text-lg text-white flex items-center">
                        <span class="text-center text-white w-full">
                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path class="heroicon-ui" d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm14 8V5H5v6h14zm0 2H5v6h14v-6zM8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 8a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </svg>
                        </span>
                        </div>
                    </div>

                    <div class="text-xs text-center md:text-base">Axle Spacing</div>
                    </div>

                    <div class="w-1/4">
                    <div class="relative mb-2">
                        <div class="absolute flex align-center items-center align-middle content-center" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                        <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                            <div class="w-0 bg-green-300 py-1 rounded" style="width: 100%;"></div>
                        </div>
                        </div>

                        <div class="w-10 h-10 mx-auto bg-green-500 rounded-full text-lg text-white flex items-center">
                        <span class="text-center text-white w-full">
                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path class="heroicon-ui" d="M19 10h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2h-2a1 1 0 0 1 0-2h2V8a1 1 0 0 1 2 0v2zM9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h5a5 5 0 0 1 5 5v2z"/>
                            </svg>
                        </span>
                        </div>
                    </div>

                    <div class="text-xs text-center md:text-base">Ratings</div>
                    </div>

                    <div class="w-1/4">
                        <div class="relative mb-2">
                            <div class="absolute flex align-center items-center align-middle content-center" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                <div class="w-0 bg-green-300 py-1 rounded" style="width: 33%;"></div>
                            </div>
                            </div>

                            <div class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
                            <span class="text-center text-gray-600 w-full">
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                </svg>
                            </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">Tare Weight</div>
                    </div>

                    <div class="w-1/4">
                        <div class="relative mb-2">
                            <div class="absolute flex align-center items-center align-middle content-center" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                <div class="w-0 bg-green-300 py-1 rounded" style="width: 33%;"></div>
                            </div>
                            </div>

                            <div class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
                            <span class="text-center text-gray-600 w-full">
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                </svg>
                            </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">RUCs</div>
                    </div>

                    <div class="w-1/4">
                        <div class="relative mb-2">
                            <div class="absolute flex align-center items-center align-middle content-center" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                <div class="w-0 bg-green-300 py-1 rounded" style="width: 33%;"></div>
                            </div>
                            </div>

                            <div class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
                            <span class="text-center text-gray-600 w-full">
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                </svg>
                            </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">Dimensions</div>
                    </div>

                    <div class="w-1/4">
                        <div class="relative mb-2">
                            <div class="absolute flex align-center items-center align-middle content-center" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                <div class="w-0 bg-green-300 py-1 rounded" style="width: 33%;"></div>
                            </div>
                            </div>

                            <div class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
                            <span class="text-center text-gray-600 w-full">
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                </svg>
                            </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">Tyre Size</div>
                    </div>

                    <div class="w-1/4">
                        <div class="relative mb-2">
                            <div class="absolute flex align-center items-center align-middle content-center" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                <div class="w-0 bg-green-300 py-1 rounded" style="width: 33%;"></div>
                            </div>
                            </div>

                            <div class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
                            <span class="text-center text-gray-600 w-full">
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                </svg>
                            </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">Axle Type</div>
                    </div>

                    <div class="w-1/4">
                    <div class="relative mb-2">
                        <div class="absolute flex align-center items-center align-middle content-center" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                        <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                            <div class="w-0 bg-green-300 py-1 rounded" style="width: 0%;"></div>
                        </div>
                        </div>

                        <div class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
                        <span class="text-center text-gray-600 w-full">
                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/>
                            </svg>
                        </span>
                        </div>
                    </div>

                    <div class="text-xs text-center md:text-base">Finished</div>
                    </div>
                </div>
                </div>

                @if ($step === 1) <livewire:vehicle-axle-spacing /> @endif
                @if ($step === 2) <livewire:ratings /> @endif
                @if ($step === 3) <livewire:vehicle-tare-weights/> @endif
            @endif
            </div>



    </div>

</div>