<div class="py-12 ml-8 mr-8">
<h1 class="text-2xl font-semibold text-gray-900">Staff</h1>
    <div class="py-4">
    <div class="flex items-center mb-8">
            <div>
                <x-button.primary wire:click="create">
                    <x-icon.plus /> Create Staff
                </x-button.primary>
            </div>
            <div class="ml-2">
                <livewire:import-transactions />
            </div>

        </div>
        <div class="mb-4 mt-6 flex justify-between items-center">
            <div class="flex-1 pr-4">
                <div class="relative md:w-1/4">
                    <input wire:model="search" type="search" class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search...">
                    <div class="absolute top-0 left-0 inline-flex items-center p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <circle cx="10" cy="10" r="7" />
                            <line x1="21" y1="21" x2="15" y2="15" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <x-input.group borderless paddingless for="perPage" label="">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>
                <div class="ml-2">
                    <x-dropdown label="Bulk Actions">
                        <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                            <x-icon.download class="text-cool-gray-400" />
                            <span>Export</span>
                        </x-dropdown.item>
                        <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')" class="flex items-center space-x-2">
                            <x-icon.trash class="text-cool-gray-400" /> <span>Delete</span>
                        </x-dropdown.item>
                        <x-dropdown.item type="button" wire:click="$toggle('showApproveModal')" class="flex items-center space-x-2">
                            <x-icon.plus class="text-cool-gray-400" /> <span>Approve</span>
                        </x-dropdown.item>
                    </x-dropdown>
                </div>
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
                    <x-table.heading class="pr-0 w-8">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">Name</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('position')" :direction="$sorts['position'] ?? null">Position</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('email')" :direction="$sorts['email'] ?? null">Email</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('phone')" :direction="$sorts['phone'] ?? null">Phone</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('address')" :direction="$sorts['address'] ?? null">Address</x-table.heading>

                    <x-table.heading></x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="5">
                            @unless ($selectAll)
                            <div>
                                <span>You selected <strong>{{ $staff->count() }}</strong> staff, do you want to select all <strong>{{ $staff->total() }}</strong> staff?</span>
                                <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select all</x-button.link>
                            </div>
                            @else
                            You are currently selecting all <strong>{{ $staff->total() }}</strong> staff
                            @endif
                        </x-table.cell>
                    </x-table.row>
                    @endif
                    @forelse ($staff as $person)
                    <x-table.row
                        class="{{ $person->id % 2 === 0 ? 'bg-white' : 'bg-cool-gray-50' }}"
                        wire:key="row-{{ $person->id}}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $person->id }}" />
                        </x-table.cell>

                        <x-table.cell>
                                {{$person->name}}
                        </x-table.cell>

                        <x-table.cell>
                            {{$person->position}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$person->phone}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$person->email}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$person->address}}<br/>
                            @isset($person->suburb) {{$person->suburb}}<br/>@endisset
                            @isset($person->city) {{$person->city}}<br/>@endisset
                        </x-table.cell>
                        <x-table.cell>
                            <x-button.link wire:click="edit({{ $person->id }})">Edit</x-button.link>
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
                {{ $staff->links() }}
            </div>
        </div>
    </div>

    <form wire:submit.prevent="deleteSelected" action="">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete staff</x-slot>

            <x-slot name="content">
                Are you sure you want to delete these staff?
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>


        </x-modal.dialog>
    </form>

    <form wire:submit.prevent="save" action="">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Edit Staff</x-slot>

            <x-slot name="content">

                <div class="flex mb-8">
                    <div class="w-4/6">
                        <x-input.group inline="true" marginRight="true" for="name" label="Name" :error="$errors->first('editing.name')">
                            <x-input.text wire:model="editing.name" id="name" />
                        </x-input.group>
                    </div>


                    <x-input.group inline="true" marginLeft="true" for="email" label="Email" :error="$errors->first('editing.email')">
                        <x-input.text wire:model="editing.email" id="email" />
                    </x-input.group>
                </div>

                <div class="flex -mt-4">
                    <x-input.group inline="true" marginRight="true" for="make" label="Make" :error="$errors->first('editing.make')">
                        <x-input.text wire:model="editing.make" id="make" />
                    </x-input.group>

                    <x-input.group inline="true" marginLeft="true" for="phone" label="Phone" :error="$errors->first('editing.phone')">
                        <x-input.text wire:model="editing.phone" id="phone" />
                    </x-input.group>
                </div>
                <div class="mt-6 mb-4">
                    <h1 class="block text-lg font-semibold leading-5 text-gray-700">Main Contact Details</h1>
                </div>
                <div class="flex mb-2">
                    <x-input.group inline="true" marginRight="true" for="address" label="Address" :error="$errors->first('editing.address')">
                        <x-input.text wire:model="editing.address" id="address" />
                    </x-input.group>

                </div>

            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>


        </x-modal.dialog>
    </form>

</div>