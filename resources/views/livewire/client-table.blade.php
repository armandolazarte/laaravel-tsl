<div class="py-12 ml-8 mr-8">

    <h1 class="text-2xl font-semibold text-gray-900">client</h1>
    <div class="py-4 scrollbar-thumb:bg-red-500 scrollbar-track:rounded">
        <div class="flex items-center mb-8">
            <div>
                <x-button.primary wire:click="create">
                    <x-icon.plus /> Create Client
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

        <div id="journal-scroll" class="flex-col space-y-4 scrollbar-thumb:bg-red-500 scrollbar-track:rounded">

            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pr-0 w-8">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">Company</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('position')" :direction="$sorts['position'] ?? null">Contact Name</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('email')" :direction="$sorts['email'] ?? null">Contact Email</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('phone')" :direction="$sorts['phone'] ?? null">Contact Phone</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('address')" :direction="$sorts['address'] ?? null">Address</x-table.heading>

                    <x-table.heading></x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="5">
                            @unless ($selectAll)
                            <div>
                                <span>You selected <strong>{{ $clients->count() }}</strong> staff, do you want to select all <strong>{{ $clients->total() }}</strong> staff?</span>
                                <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select all</x-button.link>
                            </div>
                            @else
                            You are currently selecting all <strong>{{ $clients->total() }}</strong> clients
                            @endif
                        </x-table.cell>
                    </x-table.row>
                    @endif
                    @forelse ($clients as $client)
                    <x-table.row class="{{ $client->id % 2 === 0 ? 'bg-white' : 'bg-cool-gray-50' }}" wire:key="row-{{ $client->id}}">

                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $client->id }}" />
                        </x-table.cell>

                        <div class="hover:text-gray-700">
                            <x-table.cell  wire:click="open({{ $client->id }})">
                                <div class="flex items-center">
                                    <div>
                                        <svg class="w-5 h-5 text-gray-400  mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <span>{{$client->company}}</span>
                                </div>
                            </x-table.cell>
                        </div>

                        <x-table.cell>
                            {{$client->contact_name}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$client->contact_phone}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$client->contact_email}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$client->address}},
                            @isset($client->suburb) {{$client->suburb}}<br />@endisset
                            @isset($client->city) {{$client->city}}<br />@endisset
                        </x-table.cell>
                        <x-table.cell wire:click="edit({{ $client->id }})">
                            <div class="flex items-center hover:bg-gray-100 p-2 text-center rounded-lg">
                                <span>
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </span>
                                <span>Edit</span>
                            </div>

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
                {{ $clients->links() }}
            </div>
        </div>
    </div>

    <form wire:submit.prevent="deleteSelected" action="">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete client</x-slot>

            <x-slot name="content">
                Are you sure you want to delete these clients?
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>


            </x-modal.dialog>
    </form>

    <form wire:submit.prevent="save" action="">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Edit Client</x-slot>

            <x-slot name="content">

                <div class="flex mb-8">
                    <div class="w-4/6">
                        <x-input.group inline="true" marginRight="true" for="name" label="Name" :error="$errors->first('editing.company')">
                            <x-input.text wire:model="editing.name" id="name" />
                        </x-input.group>
                    </div>


                    <x-input.group inline="true" marginLeft="true" for="email" label="Email" :error="$errors->first('editing.contact_name')">
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
        @if ($showRight)
            <x-client-slideover client={{$selectedClient}} />
        @endif
</div>