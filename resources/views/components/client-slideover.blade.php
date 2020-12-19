<div x-data="{ open: @entangle('showRight') }" x-cloak @keydown.window.escape="open = false;" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="fixed inset-0 overflow-hidden transform transition ease-in-out duration-500 sm:duration-700 z-50">

    <div class="absolute inset-0 overflow-hidden">
        <section @click.away="open = false" class="absolute inset-y-0 right-0 pl-10 max-w-full flex sm:pl-16">
            <div class="w-screen max-w-6xl">
                <div class="h-full flex flex-col space-y-6 py-6 bg-white shadow-xl overflow-y-scroll">
                    <header class="px-4 sm:px-6">
                        <div class="flex items-start justify-between space-x-3">
                            <h1 class="text-lg text-center leading-7 font-medium text-gray-900">
                                Client Details
                            </h1>
                            <div class="h-7 flex items-center">
                                <button @click="open = false" aria-label="Close panel" class="text-gray-400 hover:text-gray-500 outline-none transition ease-in-out duration-150">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </header>
                    <div class="relative flex-1 px-4 sm:px-6 bg-cool-gray-50">
                        <div class="px-4 py-5 sm:px-6">
                            <dl class="grid grid-cols-1 col-gap-4 row-gap-8 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm leading-5 font-medium text-gray-500">
                                        Company Name
                                    </dt>
                                    <dd class="mt-1 text-sm leading-5 text-gray-900">
                                        {{$client->name}}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm leading-5 font-medium text-gray-500">
                                        Phone
                                    </dt>
                                    <dd class="mt-1 text-sm leading-5 text-gray-900">
                                        {{$client->phone}}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm leading-5 font-medium text-gray-500">
                                        Email
                                    </dt>
                                    <dd class="mt-1 text-sm leading-5 text-gray-900">
                                        {{$client->phone}}
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
                                        {{$client->address}}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm leading-5 font-medium text-gray-500">
                                        Suburb
                                    </dt>
                                    <dd class="mt-1 text-sm leading-5 text-gray-900">
                                        {{$client->suburb}}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm leading-5 font-medium text-gray-500">
                                        City
                                    </dt>
                                    <dd class="mt-1 text-sm leading-5 text-gray-900">
                                        {{$client->city}}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                </div>
            </div>

        </section>
    </div>
</div>