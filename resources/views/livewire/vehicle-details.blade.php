<div>
    <div class="flex">
        <x-sidebar />
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
        </div>
    </div>

</div>