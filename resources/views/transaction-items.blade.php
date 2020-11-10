<div x-data="{
                    data: {{$allVehicles}},
                    jobData: {{$allJobs}},
                    open: false,
                    jobOpen: false,
                    focusedOptionIndex: null,
                    options: [],
                    jobOptions: [],
                    emptyOptionsMessage: 'No results match your search.',
                    name: '',
                    placeholder: 'Select an option',
                    search: '',
                    value: '',
                    jobValue: '',
                    resultLines: [
                        {
                            'vehicle_id': '',
                            'job_id': '',
                        }
                    ],

                    init() {
                        this.options = this.data
                        this.jobOptions = this.jobData
                        if (!(this.value in this.jobOptions)) this.value = null
                        if (!(this.jobValue in this.jobOptions)) this.jobValue = null

                        this.$watch('data', (value) => {
                            console.log(value)
                        })
                    },

                    focusNextOption() {
                        if (this.focusedObjectIndex === null) return this.focusedObjectIndex = Object.keys(this.options).length - 1

                        if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) return

                        this.focusedOptionIndex++

                        this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                            block: 'center',
                        })
                    },

                    focusPreviousOption() {
                        if (this.focusedObjectIndex === null) return this.focusedObjectIndex = 0

                        if (this.focusedOptionIndex <= 0) return

                        this.focusedOptionIndex--

                        this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                            block: 'center',
                        })
                    },

                    toggleListboxVisibility() {
                        if (this.open) return this.closeListbox()

                        this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value)

                        if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0

                        this.open = true

                        this.$nextTick(() => {
                            this.$refs.search.focus()

                            this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                                block: 'nearest'
                            })
                        })
                    },

                    toggleJobListboxVisibility() {
                        if (this.jobOpen) return this.closeListbox()

                        this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value)

                        if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0

                        this.jobOpen = true

                        this.$nextTick(() => {
                            this.$refs.search.focus()

                            this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                                block: 'nearest'
                            })
                        })
                    },

                    selectOption(index) {
                        console.log('INDX', index)
                        if (!this.open) return this.toggleListboxVisibility()
                        this.value = this.options[this.focusedOptionIndex]
                        this.closeListbox()

                        this.resultLines[index].vehicle_id = this.value.id

                        console.log('resultLines', this.resultLines)
                    },

                    selectJobOption(index) {
                        console.log('INDX', index)
                        if (!this.jobOpen) return this.toggleListboxVisibility()
                        this.value = this.options[this.focusedOptionIndex]
                        this.closeListbox()

                        this.resultLines[index].job_id = this.value.id

                        console.log('resultLines', this.resultLines)
                    },

                    closeListbox() {
                        this.open = false
                        this.jobOpen = false

                        this.focusedOptionIndex = null

                        this.search = ''
                    },

                }" x-init="init" @click.away="open = false" @keydown.escape="open = false" class="flex -mx-1 py-2 border-b">

    <div class="w-64">
        <div class="px-1">
            <div class="relative">
                <span class="inline-block w-full rounded-md shadow-sm">
                    <button x-ref="button" @click="toggleListboxVisibility()" :aria-expanded="open" aria-haspopup="listbox" class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                        <span x-show="! open" x-text="value ? value.id + ' - ' + value.make + ' ' + value.model : placeholder" :class="{ 'text-gray-500': ! (value in options) }" class="block truncate"></span>

                        <input x-ref="search" x-show="open" x-model="search" @keydown.enter.stop.prevent="selectOption()" @keydown.arrow-up.prevent="focusPreviousOption()" @keydown.arrow-down.prevent="focusNextOption()" type="search" class="w-full h-full form-control focus:outline-none" />

                        <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                                <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </button>
                </span>

                <div x-show="open" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg">
                    <ul x-ref="listbox" @keydown.enter.stop.prevent="selectOption()" @keydown.arrow-up.prevent="focusPreviousOption()" @keydown.arrow-down.prevent="focusNextOption()" role="listbox" :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null" tabindex="-1" class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">
                        <template x-for="(option, index) in options" :key="index">
                            <li :id="name + 'Option' + focusedOptionIndex" @click="selectOption({{$index}})" @mouseenter="focusedOptionIndex = index" @mouseleave="focusedOptionIndex = null" role="option" :aria-selected="focusedOptionIndex === index" :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }" class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9">
                                <span x-text="option.id + ' - ' + option.make + ' ' + option.model" :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }" class="block font-normal truncate"></span>

                                <span x-show="index === value" :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }" class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </li>

                        </template>

                        <div x-text="emptyOptionsMessage" class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <div class="w-64">
        <div class="px-1">
            <div class="relative">
                <span class="inline-block w-full rounded-md shadow-sm">
                    <button x-ref="button" @click="toggleJobListboxVisibility()" :aria-expanded="jobOpen" aria-haspopup="listbox" class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                        <span x-show="! jobOpen" x-text="jobValue ? jobValue.job_ref + ' - ' + jobValue.job_description : placeholder" :class="{ 'text-gray-500': ! (jobValue in jobOptions) }" class="block truncate"></span>

                        <input x-ref="search" x-show="jobOpen" x-model="search" @keydown.enter.stop.prevent="selectJobOption()" @keydown.arrow-up.prevent="focusPreviousOption()" @keydown.arrow-down.prevent="focusNextOption()" type="search" class="w-full h-full form-control focus:outline-none" />

                        <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                                <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </button>
                </span>

                <div x-show="jobOpen" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg">
                    <ul x-ref="listbox" @keydown.enter.stop.prevent="selectJobOption()" @keydown.arrow-up.prevent="focusPreviousOption()" @keydown.arrow-down.prevent="focusNextOption()" role="listbox" :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null" tabindex="-1" class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">
                        <template x-for="(option, index) in jobOptions" :key="index">
                            <li :id="name + 'Option' + focusedOptionIndex" @click="selectJobOption({{$index}})" @mouseenter="focusedOptionIndex = index" @mouseleave="focusedOptionIndex = null" role="option" :aria-selected="focusedOptionIndex === index" :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }" class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9">
                                <span x-text="option.job_ref + ' - ' + option.job_description" :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }" class="block font-normal truncate"></span>

                                <span x-show="index === jobValue" :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }" class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </li>

                        </template>

                        <div x-text="emptyOptionsMessage" class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>