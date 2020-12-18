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

                <div id="supplier-select" class="mb-2 pb-2 md:mb-1 md:flex items-center">
                    <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Supplier</label>
                    <span class="mr-4 inline-block md:block">:</span>
                    <div wire:ignore class="w-64">
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
        @php
        $total = 0;
        @endphp
        <table id="invoice-items-table">
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
                    $('#invoice-items-table').ready(function() {
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
                            @this.set('transactionItems.{{$index}}.job_id', value);
                        });

                        $(document).on('change', '#selectVehicle{{$index}}', function(e) {
                            const index = e.target.id.split('selectVehicle')[1]
                            const value = e.target.value
                            //@this.call('updateItems', [index, 'vehicle_id', value]);
                            @this.set('transactionItems.{{$index}}.vehicle_id', value);
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


        <div class="py-2 ">
            <div class="flex justify-between">
                <div class="text-xl text-gray-600 text-right flex-1">Invoice Total</div>
                <div class="text-right w-40">
                    <div class="text-xl text-gray-800 font-bold">
                        @isset($transactionItems)
                        ${{collect($transactionItems)->sum(function ($item) {
                            $cost = (int)$item['itemCost'];
                            return $cost;
                        })}}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end mb-8 mt-12">
        <div>
            <x-button.primary wire:click="create">
                <x-icon.plus /> Create Invoice
            </x-button.primary>
        </div>
    </div>
    </div>

</div>


</div>

@push('scripts')

<script>
    $('#supplier-select').ready(function() {
        $('#supplierSelect').select2({
            placeholder: 'Select a supplier',
        });

        $(document).on('change', '#supplierSelect', function(e) {
            //const index = e.target.id.split('selectVehicle')[1]
            const value = e.target.value
            console.log(value)
            @this.set('transaction.supplier_id', value);
        });

    });
</script>

@endpush