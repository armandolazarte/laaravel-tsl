<div class="py-12 ml-8 mr-8">
<h1 class="text-2xl font-semibold text-gray-900">Timesheets</h1>
    <span class="relative z-0 inline-flex shadow-sm">
        <button
            wire:click="$set('showNonApproved', true)"
            type="button"
            class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300
            {{!$showNonApproved ? ' bg-white text-gray-700 hover:text-gray-500' : 'bg-purple-500 text-white' }}
            text-md leading-5 font-medium focus:z-10 focus:outline-none">
            Non-Approved Timesheets
        </button>
        <button
            wire:click="$set('showNonApproved', false)"
            type="button"
            class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300
            {{$showNonApproved ? ' bg-white text-gray-700 hover:text-gray-500' : 'bg-purple-500 text-white' }}
            text-md leading-5 font-medium focus:z-10 focus:outline-none">
            Approved Timesheets
        </button>
    </span>

    <div class="py-4">
        <div class="flex items-center mb-8">
            <div>
                <x-button.primary wire:click="create">
                    <x-icon.plus /> Create timesheets
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
                    <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">Staff</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('start')" :direction="$sorts['start'] ?? null">Start Time</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('finish')" :direction="$sorts['finish'] ?? null">Finish Time</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('afternoon')" :direction="$sorts['afternoon'] ?? null">Morning Break</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('morning')" :direction="$sorts['morning'] ?? null">Afternoon Break</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('hours')" :direction="$sorts['finish'] ?? null">Hours</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('comments')" :direction="$sorts['comments'] ?? null">Comments</x-table.heading>
                    @if (!$showNonApproved)
                        <x-table.heading sortable multi-column wire:click="sortBy('approved_by')" :direction="$sorts['approved_by'] ?? null">Approved By</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('approved_date')" :direction="$sorts['approved_date'] ?? null">Approved Date</x-table.heading>
                    @endif
                    <x-table.heading class="w-6"></x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="{{ $showNonApproved ? 9 : 11 }}">
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
                    <x-table.row
                        class="{{ $timesheet->id % 2 === 0 ? 'bg-white' : 'bg-cool-gray-50' }}"
                        wire:key="row-{{ $timesheet->id}}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $timesheet->id }}" />
                        </x-table.cell>

                        <x-table.cell>
                            {{$timesheet->staff->name}}
                        </x-table.cell>

                        <x-table.cell>
                            {{$timesheet->started_at}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$timesheet->stopped_at}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$timesheet->morning_break}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$timesheet->afternoon_break}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$timesheet->hours}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$timesheet->comments}}
                        </x-table.cell>
                        @if (!$showNonApproved)
                            <x-table.cell>
                            {{$timesheet->user->name}}
                            </x-table.cell>
                            <x-table.cell>
                            {{ $timesheet->approved_date }}
                        </x-table.cell>
                        @endif


                        <x-table.cell>
                            @if ($showNonApproved)
                                <x-button.link
                                    class="text-blue-800 font-bold"
                                wire:click="edit({{ $timesheet->id }})">Edit</x-button.link>
                            @endif
                        </x-table.cell>

                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="{{ $showNonApproved ? 9 : 11 }}">No results found</x-table.cell>
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

    <form wire:submit.prevent="approveSelected" action="">
        <x-modal.confirmation wire:model.defer="showApproveModal">
            <x-slot name="title">Approve timesheets</x-slot>

            <x-slot name="content">
                Are you sure you want to approve these timesheets?
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showApproveModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>


            </x-modal.dialog>
    </form>

    <form wire:submit.prevent="save" action="">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Edit Timesheet</x-slot>

            <x-slot name="content">

                <div class="flex mb-8">
                    <div class="w-4/6">
                        <x-input.group inline="true" marginRight="true" for="started_at" label="Started At" :error="$errors->first('editing.started_at')">
                            <x-input.text wire:model="editing.started_at" id="started_at" />
                        </x-input.group>
                    </div>


                    <x-input.group inline="true" marginLeft="true" for="stopped_at" label="Finished At" :error="$errors->first('editing.stopped_at')">
                        <x-input.text wire:model="editing.stopped_at" id="stopped_at" />
                    </x-input.group>
                </div>

                <div class="flex -mt-4">
                    <x-input.group inline="true" marginRight="true" for="morning_break" label="Morning Break" :error="$errors->first('editing.morning_break')">
                        <x-input.text wire:model="editing.morning_break" id="mamorning_breakke" />
                    </x-input.group>

                    <x-input.group inline="true" marginLeft="true" for="afternoon_break" label="Afternoon Break" :error="$errors->first('editing.afternoon_break')">
                        <x-input.text wire:model="editing.afternoon_break" id="afternoon_break" />
                    </x-input.group>
                </div>
                <div class="flex mb-2">
                    <x-input.group inline="true" marginRight="true" for="comments" label="Comments" :error="$errors->first('editing.comments')">
                        <x-input.text wire:model="editing.comments" id="comments" />
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