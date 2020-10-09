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
                    <x-table.heading
                        sortable wire:click="sortBy('rego')"
                        :direction="$sortField === 'rego' ? $sortDirection : null">
                        Rego
                    </x-table.heading>
                    <x-table.heading
                        sortable wire:click="sortBy('make')"
                        :direction="$sortField === 'make' ? $sortDirection : null">
                        Make
                    </x-table.heading>
                    <x-table.heading
                        sortable wire:click="sortBy('model')"
                        :direction="$sortField === 'model' ? $sortDirection : null">
                        Model
                    </x-table.heading>
                    <x-table.heading></x-table.heading>
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
                                <x-button.link wire:click="edit({{ $vehicle->id }})">Edit</x-button.link>
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

    <x-modal.dialog wire:model.defer="showEditModal">
        <x-slot name="title">Edit Vehicle</x-slot>

        <x-slot name="content">
            <x-input.group for="rego" label="Rego">
                <x-input.text id="rego" />
            </x-input.group>
        </x-slot>
        <x-slot name="footer">
            <x-button.secondary>Cancel</x-button.secondary>
            <x-button.primary>Save</x-button.primary>
        </x-slot>
    </x-modal.dialog>
</div>
