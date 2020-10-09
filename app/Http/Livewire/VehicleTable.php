<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'rego';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.vehicle-table', [
            'vehicles' => Vehicle::query()
                ->search($this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(5),
        ]);
    }
}
