<div>
    <div class="py-4">
        <div class="max-w-lg w-full lg:max-w-xs">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input
                    id="search"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out"
                    placeholder="Search" type="search">
            </div>
        </div>
        
        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable>Rego</x-table.heading>
                    <x-table.heading sortable>Make</x-table.heading>
                    <x-table.heading sortable>Model</x-table.heading>
                    <x-table.heading sortable>Verified</x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @foreach ($vehicles as $vehicle)
                        <x-table.row>
                            <x-table.cell>
                                {{$vehicle->rego}}
                            </x-table.cell>
                            <x-table.cell>
                                {{$vehicle->make}}
                            </x-table.cell>
                            <x-table.cell>
                                {{$vehicle->model}}
                            </x-table.cell>
                            <x-table.cell>
                                {{$vehicle->verified}}
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
            <div>
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>
</div>
