<div class="py-12 ml-8 mr-8">
<h1 class="text-2xl font-semibold text-gray-900">Suppliers</h1>
    <div class="py-4">
        <div class="flex items-center mb-8">
            <div>
                <x-button.primary wire:click="create">
                    <x-icon.plus /> Create Supplier
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

        <div class="flex-col space-y-4">

            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pr-0 w-8">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('company_name')" :direction="$sorts['company_name'] ?? null">Company</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('account_number')" :direction="$sorts['account_number'] ?? null">Account Number</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('email')" :direction="$sorts['email'] ?? null">Email</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('contact_name')" :direction="$sorts['contact_name'] ?? null">Contact Name</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('contact_number')" :direction="$sorts['contact_number'] ?? null">Contact Phone</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('street_address')" :direction="$sorts['street_address'] ?? null">Address</x-table.heading>
                    <x-table.heading class="w-6"></x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="6">
                            @unless ($selectAll)
                            <div>
                                <span>You selected <strong>{{ $suppliers->count() }}</strong> suppliers, do you want to select all <strong>{{ $suppliers->total() }}</strong> suppliers?</span>
                                <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select all</x-button.link>
                            </div>
                            @else
                            You are currently selecting all <strong>{{ $suppliers->total() }}</strong> suppliers
                            @endif
                        </x-table.cell>
                    </x-table.row>
                    @endif
                    @forelse ($suppliers as $supplier)
                    <x-table.row
                        class="{{ $supplier->id % 2 === 0 ? 'bg-white' : 'bg-cool-gray-50' }}"
                        wire:key="row-{{ $supplier->id}}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $supplier->id }}" />
                        </x-table.cell>

                        <x-table.cell>
                            {{$supplier->company_name}}
                        </x-table.cell>

                        <x-table.cell>
                            {{$supplier->account_number}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$supplier->email}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$supplier->contact_name}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$supplier->contact_number}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$supplier->street_address}}<br/>
                            {{$supplier->suburb}}<br/>
                            {{$supplier->city}}
                        </x-table.cell>


                        <x-table.cell>
                                <x-button.link
                                    class="text-blue-800 font-bold"
                                wire:click="edit({{ $supplier->id }})">Edit</x-button.link>
                        </x-table.cell>

                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="6">No results found</x-table.cell>
                    </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
            <div>
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>

    <form wire:submit.prevent="deleteSelected" action="">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete suppliers</x-slot>

            <x-slot name="content">
                Are you sure you want to delete these suppliers?
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>


            </x-modal.dialog>
    </form>


    <form wire:submit.prevent="save" action="">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Edit supplier</x-slot>

            <x-slot name="content">

                <div class="flex mb-8">
                        <x-input.group inline="true" marginRight="true" for="company_name" label="Company Name" :error="$errors->first('editing.company_name')">
                            <x-input.text wire:model="editing.company_name" id="company_name" />
                        </x-input.group>


                    <x-input.group inline="true" marginLeft="true" for="account_number" label="Account Number" :error="$errors->first('editing.account_number')">
                        <x-input.text wire:model="editing.account_number" id="account_number" />
                    </x-input.group>
                </div>

                <div class="flex -mt-4">
                    <x-input.group inline="true" marginRight="true" for="email" label="Email" :error="$errors->first('editing.email')">
                        <x-input.text wire:model="editing.email" id="email" />
                    </x-input.group>

                    <x-input.group inline="true" marginLeft="true" for="contact_name" label="Contact Name" :error="$errors->first('editing.contact_name')">
                        <x-input.text wire:model="editing.contact_name" id="contact_name" />
                    </x-input.group>
                </div>
                <div class="flex mb-2">
                    <x-input.group inline="true" marginRight="true" for="contact_number" label="Contact Number" :error="$errors->first('editing.contact_number')">
                        <x-input.text wire:model="editing.contact_number" id="contact_number" />
                    </x-input.group>
                    <x-input.group inline="true" marginLeft="true" for="street_address" label="Street Address" :error="$errors->first('editing.street_address')">
                        <x-input.text wire:model="editing.street_address" id="street_address" />
                    </x-input.group>
                </div>
                <div class="flex mb-2">
                    <x-input.group inline="true" marginRight="true" for="suburb" label="Suburb" :error="$errors->first('editing.suburb')">
                        <x-input.text wire:model="editing.suburb" id="suburb" />
                    </x-input.group>
                    <x-input.group inline="true" marginLeft="true" for="city" label="City" :error="$errors->first('editing.city')">
                        <x-input.text wire:model="editing.city" id="city" />
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