<div>
    <div class="py-4">
        <div class="mb-8">
            <x-button.primary wire:click="create"><x-icon.plus /> Create Vehicle</x-button.primary>
        </div>
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

    <form wire:submit.prevent="save" action="">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Edit Vehicle</x-slot>

            <x-slot name="content">
                <x-input.group for="rego" label="Rego" :error="$errors->first('editing.rego')">
                    <div>
                        <x-input.text wire:model="editing.rego" id="rego" />
                    </div>

                </x-input.group>

                <x-input.group paddingless="true" for="make" label="Make" :error="$errors->first('editing.make')">
                    <x-input.text wire:model="editing.make" id="make" />
                </x-input.group>

                <x-input.group for="model" label="Model" :error="$errors->first('editing.model')">
                    <x-input.text wire:model="editing.model" id="model" />
                </x-input.group>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

</div>
