<div>
    FOOOO {{$foo}}

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

            @json($items)
            @foreach ($items as $index => $item)
            <tr wire:key="item-row-{{ $index }}" class="h-12 {{ $index % 2 === 0 ? 'bg-white' : 'bg-cool-gray-50' }}">
                <td wire:ignore class="w-2/12">
                    <select wire:model="items.{{$index}}.job_id" class="w-full" id="selectJob{{$index}}" tabindex="-1" aria-hidden="true">
                        @foreach ($jobs as $job)
                        @if ($item['job_id'] === $job->id)
                        <option selected="selected" value="{{$job->id}}">{{$job->job_ref}} - {{$job->job_description}}</option>
                        @else
                        <option value="{{$job->id}}">{{$job->job_ref}} - {{$job->job_description}}</option>
                        @endif
                        @endforeach
                    </select>
                </td>
                <td wire:ignore class="w-2/12 py-2 px-1">
                    <select class="w-full" id="selectVehicle{{$index}}">
                        @foreach ($vehicles as $vehicle)
                        @if ($item['vehicle_id'] === $vehicle->id)
                        <option selected="selected" value="{{$vehicle->id}}">{{$vehicle->make}}</option>
                        @else
                        <option value="{{$vehicle->id}}">{{$vehicle->make}}</option>
                        @endif
                        @endforeach
                    </select>
                </td>
                <td class="w-1/6 p-1">
                    <x-input.text wire:model="items.{{$index}}.description" class="h-8 px-2" />
                </td>
                <td class="w-1/12 p-1">
                    <x-input.text class="h-8 px-2" wire:model="items.{{$index}}.part_code" id="items.{{$index}}.part_code" />
                </td>
                <td class="w-2/12 p-1">
                    <x-input.text class="h-8 px-2" wire:model="items.{{$index}}.purchase_code" id="purchaseCode{{$index}}" />
                </td>

                <td class="w-1/12 p-1">
                    <x-input.text class="h-8 px-2" wire:model="items.{{$index}}.quantity" id="quantity{{$index}}" />
                </td>

                <td class="w-1/12 p-1">
                    <x-input.text class="h-8 px-2" wire:model="items.{{$index}}.unit" id="unit{{$index}}" />
                </td>

                <td wire:ignore class="w-1/12 p-1">
                    <x-input.text class="h-8" wire:model="items.{{$index}}.item_cost" />
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
                            //@this.set('')
                            //@this.call('updateItems', [index, 'job_id', value]);
                            @this.set('items.{{$index}}.job_id', value);
                        });

                        $(document).on('change', '#selectVehicle{{$index}}', function(e) {
                            const index = e.target.id.split('selectVehicle')[1]
                            const value = e.target.value
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

    <button class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded shadow-sm" wire:click="addLineItem">
        Add Invoice Items
    </button>

    <div class="flex items-center justify-end mb-8">
        <div>
            <x-button.primary wire:click="save">
                <x-icon.plus /> Save Purchase Order
            </x-button.primary>
        </div>
    </div>
</div>