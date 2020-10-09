<div>
    <div class="py-4">
        <div>
            <div class="w-1/4">
                <x-input.text wire:model="search" placeholder="Search.."/>
            </div>
        </div>

        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable wire:click="sortBy('rego')">Rego</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('make')">Make</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('model')">Model</x-table.heading>
                    <x-table.heading sortable>Verified</x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @forelse ($vehicles as $vehicle)
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
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="4">No results found</x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
            <div>
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>
</div>
