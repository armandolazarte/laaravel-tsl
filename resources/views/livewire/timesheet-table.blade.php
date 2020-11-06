<div>
    <div class="py-4">
        <div class="flex items-centermb-8">
            <div>
                <x-button.primary wire:click="create">
                    <x-icon.plus /> Create timesheets
                </x-button.primary>
            </div>
            <div>
                <livewire:import-transactions />
            </div>

        </div>
        <div class="flex w-full items-center">
            <div>
                <div class="flex items-center w-4/8 space-x-4">
                    <x-input.text wire:model="search" placeholder="Search.." />
                    <x-button.link wire:click="$toggle('showFilters')">
                        @if ($showFilters) Hide @endif Advanced Search
                    </x-button.link>
                </div>
            </div>

            <div class="flex align-end space-x-2 ml-8">
                <x-input.group borderless paddingless for="perPage" label="Per Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>
                <x-dropdown label="Bulk Actions">
                    <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                        <x-icon.download class="text-cool-gray-400" />
                        <span>Export</span>
                    </x-dropdown.item>
                    <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')" class="flex items-center space-x-2">
                        <x-icon.trash class="text-cool-gray-400"/> <span>Delete</span>
                    </x-dropdown.item>
                    <x-dropdown.item type="button" wire:click="approveSelected" class="flex items-center space-x-2">
                        <x-icon.trash class="text-cool-gray-400"/> <span>Approve</span>
                    </x-dropdown.item>
                </x-dropdown>
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
                    <x-table.heading sortable multi-column wire:click="sortBy('rego')" :direction="$sorts['rego'] ?? null" class="w-full">Rego</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('make')" :direction="$sorts['make'] ?? null">Make</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('model')" :direction="$sorts['model'] ?? null">Model</x-table.heading>

                    <x-table.heading></x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="5">
                            @unless ($selectAll)
                            <div>
                                <span>You selected <strong>{{ $timesheets->count() }}</strong> timesheets, do you want to select all <strong>{{ $timesheets->total() }}</strong> timesheets?</span>
                                <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select all</x-button.link>
                            </div>
                            @else
                            You are currently selecting all <strong>{{ $timesheets->total() }}</strong> timesheets
                            @endif
                        </x-table.cell>
                    </x-table.row>
                    @endif
                    @forelse ($timesheets as $timesheet)
                    <x-table.row wire:key="row-{{ $timesheet->id}}">

                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $timesheet->id }}" />
                        </x-table.cell>

                        <x-table.cell>
                                {{$timesheet->staff_id}}
                        </x-table.cell>

                        <x-table.cell>
                            {{$timesheet->started_at}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$timesheet->started_at}}
                        </x-table.cell>
                        <x-table.cell>
                            <x-button.link wire:click="edit({{ $timesheet->id }})">Edit</x-button.link>
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
                {{ $timesheets->links() }}
            </div>
        </div>
    </div>

    <form wire:submit.prevent="deleteSelected" action="">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete timesheets</x-slot>

            <x-slot name="content">
                Are you sure you want to delete these timesheets?
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>


        </x-modal.dialog>
    </form>



</div>