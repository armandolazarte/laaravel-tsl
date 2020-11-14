<div class="antialiased sans-serif min-h-screen bg-white w-full" style="min-height: 900px">
    <div class="border-t-8 border-gray-700 h-2"></div>
    <div class="mx-auto py-6 px-20">
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
        @json($transactionItems)
        <table>
            <thead class="bg-gray-100 rounded-md px-2 py-6">
                <tr class="text-left ">
                    <th>Job</th>
                    <th>Vehicle</th>
                    <th class="p1">Description</th>
                    <th class="p1">Part Code</th>
                    <th class="p1">Purchase Code</th>
                    <th class="p1">Quantity</th>
                    <th>Unit</th>
                    <th>Item Cost</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactionItems as $index => $transactionItem)
                <tr class="h-12 {{ $index % 2 === 0 ? 'bg-white' : 'bg-cool-gray-50' }}">
                    <td wire:ignore class="w-2/12">
                        <select class="w-full" id="selectJob{{$index}}" tabindex="-1" aria-hidden="true">
                            @foreach ($jobs as $job)
                            <option value="{{$job->id}}">{{$job->job_ref}} - {{$job->job_description}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td wire:ignore class="w-2/12 py-2 px-1">
                        <select class="w-full" id="selectVehicle{{$index}}">
                            @foreach ($vehicles as $vehicle)
                            <option value="{{$vehicle->id}}">{{$vehicle->make}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="w-1/6 p-1">
                        <x-input.text class="h-8 px-2" wire:model="transactionItems.{{$index}}.description" id="description{{$index}}" />
                    </td>
                    <td class="w-1/12 p-1">
                        <x-input.text class="h-8 px-2" wire:model="transactionItems.{{$index}}.partCode" id="partCode{{$index}}" />
                    </td>
                    <td class="w-2/12 p-1">
                        <x-input.text class="h-8 px-2" wire:model="transactionItems.{{$index}}.purchaseCode" id="purchaseCode{{$index}}" />
                    </td>

                    <td class="w-1/12 p-1">
                        <x-input.text class="h-8 px-2" wire:model="transactionItems.{{$index}}.quantity" id="quantity{{$index}}" />
                    </td>

                    <td class="w-1/12 p-1">
                        <x-input.text class="h-8 px-2" wire:model="transactionItems.{{$index}}.unit" id="unit{{$index}}" />
                    </td>
                    <td class="w-1/12 p-1">
                        <x-input.text class="h-8" wire:model="transactionItems.{{$index}}.itemCost" id="itemCost{{$index}}" />
                    </td>
                    <td>
                        <a href="#" wire:click.prevent="removeProduct({{$index}})">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
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

            </tbody>
        </table>

        <button class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded shadow-sm" wire:click="addLineItem">
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
        <div>
        <x-input.search-dropdown :data="$suppliers">

        </x-input.search-dropdown>
        </div>
        <div class="flex items-center justify-end mb-8">
            <div>
                <x-button.primary wire:click="create">
                    <x-icon.plus /> Create Purchase Order
                </x-button.primary>
            </div>
        </div>
    </div>


</div>