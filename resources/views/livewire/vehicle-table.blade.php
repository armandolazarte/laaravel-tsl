<div>
    <div class="py-4">
        <div class="mb-8">
            <x-button.primary wire:click="create"><x-icon.plus /> Create Vehicle</x-button.primary>
        </div>
        <div>
            <div class="flex w-4/8 space-x-4">
                <x-input.text wire:model="search" placeholder="Search.."/>
                <x-button.link wire:click="$toggle('showFilters')">
                    @if ($showFilters) Hide @endif Advanced Search
                </x-button.link>
            </div>
        </div>

        <div>
            @if ($showFilters)
                <div class="bg-cool-gray-200 p-4 rounded shadow-inner flex relative">
                    <div class="w-1/2 pr-2 space-y-4">
                    </div>

                </div>
            @endif
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
                                    <a href="{{ route('vehicle-details', $vehicle->id) }}">
                                        {{$vehicle->rego}}
                                    </a>
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

            <div class="flex mb-8">
                <div class="w-4/6">
                    <x-input.group  inline="true" marginRight="true" for="rego" label="Rego" :error="$errors->first('editing.rego')">
                            <x-input.text wire:model="editing.rego" id="rego" />
                    </x-input.group>
                </div>


                    <x-input.group inline="true" marginLeft="true" for="vin" label="Vin" :error="$errors->first('editing.vin')">
                        <x-input.text wire:model="editing.vin" id="vin" />
                    </x-input.group>
                </div>

                <div class="flex -mt-4">
                    <x-input.group inline="true" marginRight="true" for="make" label="Make" :error="$errors->first('editing.make')">
                        <x-input.text wire:model="editing.make" id="make" />
                    </x-input.group>

                    <x-input.group inline="true" marginLeft="true" for="model" label="Model" :error="$errors->first('editing.model')">
                        <x-input.text wire:model="editing.model" id="model" />
                    </x-input.group>
                </div>
                <div class="mt-6 mb-4">
                    <h1 class="block text-lg font-semibold leading-5 text-gray-700">Main Contact Details</h1>
                </div>
                <div class="flex mb-2">
                    <x-input.group inline="true" marginRight="true" for="name" label="Name" :error="$errors->first('editing.name')">
                        <x-input.text wire:model="editing.name" id="name" />
                    </x-input.group>
                    <x-input.group inline="true" marginLeft="true"  for="phone" label="Phone" :error="$errors->first('editing.phone')">
                            <x-input.text wire:model="editing.phone" id="phone" />
                    </x-input.group>

                </div>

                <x-input.group inline="true" for="email" label="Email" :error="$errors->first('editing.email')">
                    <x-input.text wire:model="editing.email" id="email" />
                </x-input.group>

            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>


        </x-modal.dialog>
    </form>

</div>
