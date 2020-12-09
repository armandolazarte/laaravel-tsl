<div class="py-12 ml-8 mr-8">
    <h1 class="text-2xl font-semibold text-gray-900">Transactions</h1>
    <div class="py-4 space-y-4">
        <div class="flex items-center mb-8">
            <div>
                <x-button.primary wire:click="create">
                    <x-icon.plus />
                    <a href="{{ route('create-transaction') }}">
                        Create Transaction
                    </a>
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
                <x-button.link wire:click="toggleShowFilters">@if ($showFilters) Hide @endif Advanced Search...</x-button.link>
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

        <!-- Advanced Search -->
        <div>
            @if ($showFilters)
            <div class="bg-cool-gray-200 p-4 rounded shadow-inner flex relative">
                <div class="w-1/2 pr-2 space-y-4">
                    <x-input.group inline for="filter-status" label="Status">
                        <x-input.select wire:model="filters.status" id="filter-status">
                            <option value="" disabled>Select Status...</option>

                            @foreach (App\Models\Transaction::STATUSES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group inline for="filter-amount-min" label="Minimum Amount">
                        <x-input.money wire:model.lazy="filters.amount-min" id="filter-amount-min" />
                    </x-input.group>

                    <x-input.group inline for="filter-amount-max" label="Maximum Amount">
                        <x-input.money wire:model.lazy="filters.amount-max" id="filter-amount-max" />
                    </x-input.group>
                </div>

                <div class="w-1/2 pl-2 space-y-4">
                    <x-input.group inline for="filter-date-min" label="Minimum Date">
                        <x-input.date wire:model="filters.date-min" id="filter-date-min" placeholder="MM/DD/YYYY" />
                    </x-input.group>

                    <x-input.group inline for="filter-date-max" label="Maximum Date">
                        <x-input.date wire:model="filters.date-max" id="filter-date-max" placeholder="MM/DD/YYYY" />
                    </x-input.group>

                    <x-button.link wire:click="resetFilters" class="absolute right-0 bottom-0 p-4">Reset Filters</x-button.link>
                </div>
            </div>
            @endif
        </div>

        <!-- Transactions Table -->
        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pr-0 w-8">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('title')" :direction="$sorts['title'] ?? null" class="w-full">Title</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('amount')" :direction="$sorts['amount'] ?? null">Amount</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('status')" :direction="$sorts['status'] ?? null">Status</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('date')" :direction="$sorts['date'] ?? null">Date</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="6">
                            @unless ($selectAll)
                            <div>
                                <span>You have selected <strong>{{ $transactions->count() }}</strong> transactions, do you want to select all <strong>{{ $transactions->total() }}</strong>?</span>
                                <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select All</x-button.link>
                            </div>
                            @else
                            <span>You are currently selecting all <strong>{{ $transactions->total() }}</strong> transactions.</span>
                            @endif
                        </x-table.cell>
                    </x-table.row>
                    @endif

                    @forelse ($transactions as $transaction)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $transaction->id }}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $transaction->id }}" />
                        </x-table.cell>

                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                <x-icon.cash class="text-cool-gray-400" />

                                <p class="text-cool-gray-600 truncate">
                                    {{ $transaction->title }}
                                </p>
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span class="text-cool-gray-900 font-medium">${{ $transaction->amount }} </span> USD
                        </x-table.cell>

                        <x-table.cell>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-{{ $transaction->status_color }}-100 text-{{ $transaction->status_color }}-800 capitalize">
                                {{ $transaction->status }}
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            {{ $transaction->date_for_humans }}
                        </x-table.cell>

                        <x-table.cell>
                            <x-button.link wire:click="edit({{ $transaction->id }})">Edit</x-button.link>
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="6">
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                <span class="font-medium py-8 text-cool-gray-400 text-xl">No transactions found...</span>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <div>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Transactions Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete Transaction</x-slot>

            <x-slot name="content">
                <div class="py-8 text-cool-gray-700">Are you sure you? This action is irreversible.</div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>
        </x-modal.confirmation>
    </form>

</div>