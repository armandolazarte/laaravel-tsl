<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleDetails extends Component
{

    public $vehicle;
    public $currentMenu = 'Details';
    public $step = 1;

    public function mount($id)
    {
        $vehicle = Vehicle::find($id);

        $this->vehicle = $vehicle;
    }

    public function render()
    {
        return view('livewire.vehicle-details');
    }
}
