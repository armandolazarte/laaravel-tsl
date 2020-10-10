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
    public $showEditModal = false;
    public $editing;

    protected $queryString = ['sortField', 'sortDirection'];

    protected $rules = [
        'editing.rego' => 'required',
        'editing.make' => 'required',
        'editing.model' => 'required',
    ];

    public function sortBy($field)
    {
        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function create()
    {
        $this->editing;
        $this->showEditModal = true;

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->editing->rego = '';
        $this->editing->make = '';
        $this->editing->model = '';
    }


    public function edit($vehicleID)
    {
        $vehicle = Vehicle::find($vehicleID);

        $this->editing = $vehicle;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();

        $this->showEditModal = false;
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
