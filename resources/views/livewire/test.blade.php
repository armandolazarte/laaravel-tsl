<div class="antialiased sans-serif min-h-screen bg-white" style="min-height: 900px">
    <div class="border-t-8 border-gray-700 h-2"></div>
    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-between">
            <h2 class="text-2xl font-bold mb-6 pb-2 tracking-wider uppercase">Invoice</h2>
            <div>
                <div class="relative mr-4 inline-block">
                    <div class="text-gray-500 cursor-pointer w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center" @mouseenter="showTooltip = true" @mouseleave="showTooltip = false" @click="printInvoice()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                            <rect x="7" y="13" width="10" height="8" rx="2" />
                        </svg>
                    </div>
                    <div x-show.transition="showTooltip" class="z-40 shadow-lg text-center w-32 block absolute right-0 top-0 p-2 mt-12 rounded-lg bg-gray-800 text-white text-xs">
                        Print this invoice!
                    </div>
                </div>

                <div class="relative inline-block">
                    <div class="text-gray-500 cursor-pointer w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center" @mouseenter="showTooltip2 = true" @mouseleave="showTooltip2 = false" @click="window.location.reload()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -5v5h5" />
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 5v-5h-5" />
                        </svg>
                    </div>
                    <div x-show.transition="showTooltip2" class="z-40 shadow-lg text-center w-32 block absolute right-0 top-0 p-2 mt-12 rounded-lg bg-gray-800 text-white text-xs">
                        Reload Page
                    </div>
                </div>
            </div>
        </div>

        <div class="flex mb-8 justify-between">
            <div class="w-2/4">
                <div class="mb-2 md:mb-1 md:flex items-center">
                    <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Invoice No.</label>
                    <span class="mr-4 inline-block hidden md:block">:</span>
                    <div class="flex-1">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="eg. #INV-100001" x-model="invoiceNumber">
                    </div>
                </div>

                <div class="mb-2 md:mb-1 md:flex items-center">
                    <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Invoice Date</label>
                    <span class="mr-4 inline-block hidden md:block">:</span>
                    <div class="flex-1">
                        <date-picker v-model="newInvoice.invoice_date" format="DD/MM/YYYY" valueType="format" placeholder="Select invoice date"></date-picker>
                    </div>
                </div>

                <div class="mb-2 md:mb-1 md:flex items-center">
                    <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Due date</label>
                    <span class="mr-4 inline-block hidden md:block">:</span>
                    <div class="flex-1">
                        <date-picker v-model="newInvoice.due_date" format="DD/MM/YYYY" valueType="format" placeholder="Select due date"></date-picker>
                    </div>
                </div>
            </div>
            <div>
                <div class="w-32 h-32 mb-1 border rounded-lg overflow-hidden relative bg-gray-100">
                    <img id="image" class="object-cover w-full h-32" src="https://placehold.co/300x300/e2e8f0/e2e8f0" />

                    <div class="absolute top-0 left-0 right-0 bottom-0 w-full block cursor-pointer flex items-center justify-center" onClick="document.getElementById('fileInput').click()">
                        <button type="button" style="background-color: rgba(255, 255, 255, 0.65)" class="hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                                <circle cx="12" cy="13" r="3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex -mx-1 border-b py-2 items-start">
            <div class="flex px-1">
                <p class="text-gray-800 uppercase tracking-wide text-sm font-bold">Vehicle</p>
            </div>

            <div class="px-1 w-20 text-right">
                <p class="text-gray-800 uppercase tracking-wide text-sm font-bold">Job</p>
            </div>

            <div class="px-1 w-32 text-right">
                <p class="leading-none">
                    <span class="block uppercase tracking-wide text-sm font-bold text-gray-800">Unit</span>
                    <span class="font-medium text-xs text-gray-500">(Incl. GST)</span>
                </p>
            </div>

            <div class="px-1 w-32 text-right">
                <p class="leading-none">
                    <span class="block uppercase tracking-wide text-sm font-bold text-gray-800">Amount</span>
                    <span class="font-medium text-xs text-gray-500">(Incl. GST)</span>
                </p>
            </div>

            <div class="px-1 w-20 text-center">
            </div>
        </div>
        @json($transactionItems)
        @foreach ($transactionItems as $index => $transactionItem)
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
                        console.log(this.value)
                        this.closeListbox()

                        $wire.call('updateItems', [ this.value.id, index ])
                        console.log('resultLines', this.resultLines)

                    },

                    selectJobOption(index) {
                        console.log('INDX', index)
                        if (!this.jobOpen) return this.toggleJobListboxVisibility()
                        this.jobValue = this.jobOptions[this.focusedOptionIndex]
                        this.closeListbox()

                        console.log('resultLines', this.resultLines)
                    },

                    closeListbox() {
                        this.open = false
                        this.jobOpen = false

                        this.focusedOptionIndex = null

                        this.search = ''


                    },

                }" x-init="init" @click.away="open = false" @keydown.escape="open = false" wire:ignore class="flex -mx-1 py-2 border-b">

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
        @endforeach

        <button class="mt-6 bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded shadow-sm" wire:click="addLineItem">
            Add Invoice Items
        </button>

        <div class="py-2 ml-auto mt-5 w-full sm:w-2/4 lg:w-1/4">
            <div class="flex justify-between mb-3">
                <div class="text-gray-800 text-right flex-1">Total incl. GST</div>
                <div class="text-right w-40">
                    <div class="text-gray-800 font-medium" x-html="netTotal"></div>
                </div>
            </div>
            <div class="flex justify-between mb-4">
                <div class="text-sm text-gray-600 text-right flex-1">GST(18%) incl. in Total</div>
                <div class="text-right w-40">
                    <div class="text-sm text-gray-600" x-html="totalGST"></div>
                </div>
            </div>

            <div class="py-2 border-t border-b">
                <div class="flex justify-between">
                    <div class="text-xl text-gray-600 text-right flex-1">Amount due</div>
                    <div class="text-right w-40">
                        <div class="text-xl text-gray-800 font-bold" x-html="netTotal"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Print Template -->
        <div id="js-print-template" x-ref="printTemplate" class="hidden">
            <div class="mb-8 flex justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-6 pb-2 tracking-wider uppercase">Invoice</h2>

                    <div class="mb-1 flex items-center">
                        <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Invoice No.</label>
                        <span class="mr-4 inline-block">:</span>
                        <div x-text="invoiceNumber"></div>
                    </div>

                    <div class="mb-1 flex items-center">
                        <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Invoice Date</label>
                        <span class="mr-4 inline-block">:</span>
                        <div x-text="invoiceDate"></div>
                    </div>

                    <div class="mb-1 flex items-center">
                        <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Due date</label>
                        <span class="mr-4 inline-block">:</span>
                        <div x-text="invoiceDueDate"></div>
                    </div>
                </div>
                <div class="pr-5">
                    <div class="w-32 h-32 mb-1 overflow-hidden">
                        <img id="image2" class="object-cover w-20 h-20" />
                    </div>
                </div>
            </div>

            <div class="flex justify-between mb-10">
                <div class="w-1/2">
                    <label class="text-gray-800 block mb-2 font-bold text-xs uppercase tracking-wide">Bill/Ship To:</label>
                    <div>
                        <div x-text="billing.name"></div>
                        <div x-text="billing.address"></div>
                        <div x-text="billing.extra"></div>
                    </div>
                </div>
                <div class="w-1/2">
                    <label class="text-gray-800 block mb-2 font-bold text-xs uppercase tracking-wide">From:</label>
                    <div>
                        <div x-text="from.name"></div>
                        <div x-text="from.address"></div>
                        <div x-text="from.extra"></div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap -mx-1 border-b py-2 items-start">
                <div class="flex-1 px-1">
                    <p class="text-gray-600 uppercase tracking-wide text-xs font-bold">Description</p>
                </div>

                <div class="px-1 w-32 text-right">
                    <p class="text-gray-600 uppercase tracking-wide text-xs font-bold">Units</p>
                </div>

                <div class="px-1 w-32 text-right">
                    <p class="leading-none">
                        <span class="block uppercase tracking-wide text-xs font-bold text-gray-600">Unit Price</span>
                        <span class="font-medium text-xs text-gray-500">(Incl. GST)</span>
                    </p>
                </div>

                <div class="px-1 w-32 text-right">
                    <p class="leading-none">
                        <span class="block uppercase tracking-wide text-xs font-bold text-gray-600">Amount</span>
                        <span class="font-medium text-xs text-gray-500">(Incl. GST)</span>
                    </p>
                </div>
            </div>
            <template :key="">
                <div class="flex flex-wrap -mx-1 py-2 border-b">
                    <div class="flex-1 px-1">
                        <p class="text-gray-800" x-text="invoice.name"></p>
                    </div>

                    <div class="px-1 w-32 text-right">
                        <p class="text-gray-800" x-text="invoice.qty"></p>
                    </div>

                    <div class="px-1 w-32 text-right">
                        <p class="text-gray-800" x-text="numberFormat(invoice.rate)"></p>
                    </div>

                    <div class="px-1 w-32 text-right">
                        <p class="text-gray-800" x-text="numberFormat(invoice.total)"></p>
                    </div>
                </div>
            </template>

            <div class="py-2 ml-auto mt-20" style="width: 320px">
                <div class="flex justify-between mb-3">
                    <div class="text-gray-800 text-right flex-1">Total incl. GST</div>
                    <div class="text-right w-40">
                        <div class="text-gray-800 font-medium" x-html="netTotal"></div>
                    </div>
                </div>
                <div class="flex justify-between mb-4">
                    <div class="text-sm text-gray-600 text-right flex-1">GST(18%) incl. in Total</div>
                    <div class="text-right w-40">
                        <div class="text-sm text-gray-600" x-html="totalGST"></div>
                    </div>
                </div>

                <div class="py-2 border-t border-b">
                    <div class="flex justify-between">
                        <div class="text-xl text-gray-600 text-right flex-1">Amount due</div>
                        <div class="text-right w-40">
                            <div class="text-xl text-gray-800 font-bold" x-html="netTotal"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="h-16">
            <div class="flex items-center align-middle">

                <div class="px-1">
                </div>
                <div class="px-1">

                </div>
                <div class="px-1">
                </div>
                <div class="px-1">
                </div>
                <div class="px-1">
                </div>
                <div class="px-1">
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#selectJob{{$index}}').select2({
                        placeholder: 'Select an option',
                    });

                    $('#selectVehicle{{$index}}').select2({
                        placeholder: 'Select an option',
                    });

                    $(document).on('change', '#selectJob{{$index}}', function(e) {
                        console.log(e.target.id)
                        const index = e.target.id.split('selectJob')[1]
                        const value = e.target.value
                        @this.call('updateItems', [index, 'job_id', value]);
                    });

                    $(document).on('change', '#selectVehicle{{$index}}', function(e) {
                        const index = e.target.id.split('selectVehicle')[1]
                        const value = e.target.value
                        @this.call('updateItems', [index, 'vehicle_id', value]);
                    });
                });
                document.addEventListener("livewire:load", function(event) {
                    window.livewire.hook('component.initialized', () => {
                        $('#FirstOption').select2({
                            placeholder: 'Select an option',
                        });
                    });
                });
            </script>
            @endforeach


        </div>














@json($transactionItems)
        @foreach ($transactionItems as $index => $transactionItem)
        <div x-data="{
            selectedCity: '',

            select2Alpine() {
                this.select2 = $(this.$refs.select).select2();

                this.select2.on('select2:select', (event) => {
                    this.selectedCity = event.target.value;
                });

                this.$watch('selectedCity', (value) => {
                    this.select2.val(value).trigger('change');
                });
                }

            }" x-init="select2Alpine">
            <select x-ref="select" data-placeholder="Select a City">
                @foreach($allVehicles as $vehicle)
                <option value="London">hhhh</option>
            </select>
        </div>
        @endforeach