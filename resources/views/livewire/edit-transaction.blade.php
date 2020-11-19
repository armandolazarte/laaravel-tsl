<div>
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
            @foreach ($items as $index => $item)

            <tr wire:key="item-field-{{ $item->id }}" class="h-12 {{ $index % 2 === 0 ? 'bg-white' : 'bg-cool-gray-50' }}">
                <td wire:ignore class="w-2/12">
                    <select class="w-full" id="selectJob{{$index}}" tabindex="-1" aria-hidden="true">
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
</div>