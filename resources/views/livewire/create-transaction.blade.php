<div class="antialiased sans-serif min-h-screen bg-white w-full" style="min-height: 900px">
    <div class="border-t-8 border-gray-700 h-2"></div>
    <div class="mx-auto py-6 px-20">

        <div class="flex mb-8 justify-between">
            <div class="w-2/4">
                <div class="mb-2 pb-2 md:mb-1 md:flex items-center">
                    <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Invoice Title</label>
                    <span class="mr-4 inline-block md:block">:</span>
                    <div class="w-64">
                        <x-input.text wire:model="transaction.title" class="h-8 px-2" />
                    </div>
                </div>
                <div class="mb-2 pb-2 md:mb-1 md:flex items-center">
                    <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Invoice Date</label>
                    <span class="mr-4 inline-block md:block">:</span>
                    <div class="w-64">
                        <x-input.date wire:model="transaction.date" id="invoice-date" placeholder="DD/MM/YYYY" />
                    </div>
                </div>

                <div class="mb-2 pb-2 md:mb-1 md:flex items-center">
                    <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Due date</label>
                    <span class="mr-4 inline-block md:block">:</span>
                    <div class="w-64">
                        <x-input.date wire:model="transaction.due_date" id="invoice-due_date" placeholder="DD/MM/YYYY" />
                    </div>
                </div>

                <div class="mb-2 pb-2 md:mb-1 md:flex items-center">
                    <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Supplier</label>
                    <span class="mr-4 inline-block md:block">:</span>
                    <div class="w-64">
                        <select class="w-full" id="supplierSelect" tabindex="-1" aria-hidden="true">
                            <option selected></option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->company_name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>
        @json($transactionItems)
        <table>
            <thead class="bg-gray-100 rounded-md px-2 py-8">
                <tr class="text-left">
                    <th class="px-2"></th>
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
                    <td class="px-2">{{$index + 1}}</td>
                    <td wire:ignore class="w-2/12">
                        <select class="w-full" id="selectJob{{$index}}" tabindex="-1" aria-hidden="true">
                            <option selected></option>
                            @foreach ($jobs as $job)
                            <option value="{{$job->id}}">{{$job->job_ref}} - {{$job->job_description}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td wire:ignore class="w-2/12 py-2 px-1">
                        <select class="w-full" id="selectVehicle{{$index}}">
                            <option selected></option>
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
                            placeholder: 'Select a Job',
                        });

                        $('#selectVehicle{{$index}}').select2({
                            placeholder: 'Select a Vehicle',
                        });

                        $(document).on('change', '#selectJob{{$index}}', function(e) {
                            console.log(e.target.id)
                            const index = e.target.id.split('selectJob')[1]
                            const value = e.target.value
                            //@this.call('updateItems', [index, 'job_id', value]);
                            @this.set('items.{{$index}}.job_id', value);
                        });

                        $(document).on('change', '#selectVehicle{{$index}}', function(e) {
                            const index = e.target.id.split('selectVehicle')[1]
                            const value = e.target.value
                            //@this.call('updateItems', [index, 'vehicle_id', value]);
                            @this.set('items.{{$index}}.vehicle_id', value);
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

        <button class="bg-white hover:bg-gray-100 text-gray-700 font-semibold mt-6 py-2 px-4 text-sm border border-gray-300 rounded shadow-sm" wire:click="addLineItem">
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

@push('scripts')

<script>
    $(document).ready(function() {
        $('#supplierSelect').select2({
            placeholder: 'Select an option',
        });
    });
</script>

@endpush