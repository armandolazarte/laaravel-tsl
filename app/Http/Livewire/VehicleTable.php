<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.vehicle-table', [
            'vehicles' => Vehicle::paginate(5),
        ]);
    }
}
