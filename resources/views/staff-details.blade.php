<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff') }}
        </h2>
    </x-slot>


    <div>
        <div class="bg-white shadow overflow-hidden w-5/6 mx-auto mt-10 sm:rounded-lg">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Staff Details
                </h3>
            </div>
            <div class="px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 col-gap-4 row-gap-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Name
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900">
                            {{$staff->name}}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Position
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900">
                            {{$staff->phone}}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Phone
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900">
                            {{$staff->phone}}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Email
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900">
                            {{$staff->phone}}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Start Date
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900">
                            {{ \Carbon\Carbon::parse($staff->start_date)->format('j F, Y') }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Date of Birth
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900">
                            {{ \Carbon\Carbon::parse($staff->dob)->format('j F, Y') }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Employee Pay Rate
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900">
                            ${{$staff->rate}}
                        </dd>
                    </div>


                    <div class="sm:col-span-2">
                        <dt class="text-lg leading-5 font-semibold text-gray-900">
                            Address
                        </dt>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Street Address
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900">
                            {{$staff->address}}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Suburb
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900">
                            {{$staff->suburb}}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            City
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900">
                            {{$staff->city}}
                        </dd>
                    </div>
                </dl>
            </div>


        </div>
    </div>
</x-app-layout>