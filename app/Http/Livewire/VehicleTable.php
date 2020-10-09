<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleTable extends Component
{
    public $active = true;
    public $search;
    public $sortField;
    public $asc = true;
    public $desc = false;
    public $queryString = ['search', 'active', 'asc'];

    public function render()
    {
        return view('livewire.vehicle-table', [
            'vehicles' => Vehicle::get()
        ]);
    }
}
