<div>
    <div>
        @if ($successMessage)
            <div class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
                <div x-data="{ show: true }" x-show="show" x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto">
                    <div class="rounded-lg shadow-xs overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm leading-5 font-medium text-gray-900">
                            Successfully saved!
                            </p>
                            <p class="mt-1 text-sm leading-5 text-gray-500">
                            Anyone with a link can now view this file.
                            </p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="show = false; setTimeout(() => show = true, 1000)" class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            </button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
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
