<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use App\Models\Verification;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'rego';
    public $sortDirection = 'asc';
    public $showEditModal = false;
    public $showFilters = false;
    public $editing;
    public $successMessage;
    public $selectPage = false;
    public $selectAll = false;
    public $selected = [];

    protected $queryString = ['sortField', 'sortDirection'];

    protected $rules = [
        'editing.vin' => 'required',
        'editing.rego' => 'required',
        'editing.make' => 'required',
        'editing.model' => 'required',
        'editing.name' => 'required',
        'editing.phone' => 'required',
        'editing.email' => 'required',
    ];

    public function updatedSelectPage($value)
    {
        if($value) {
            $this->selected = $this->vehicles->pluck('id')->map(fn($id) => (string) $id);
        } else {
            $this->selected = [];
        }
    }

    public function selectAll()
    {
        $this->selectAll = true;
    }

    public function sortBy($field)
    {
        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo Vehicle::whereKey($this->selected)->toCsv();
        }, 'vehicles.csv');
    }

    public function deleteSelected()
    {
        $vehicles = Vehicle::whereKey($this->selected);

        $vehicles->delete();
    }

    public function create()
    {
        $this->editing = Vehicle::make([]);
        $this->showEditModal = true;
        //$this->resetForm();
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

        //dd($this->editing->id);
        Verification::create([
            'vehicle_id' => $this->editing->id,
            'type' => 'Landata'
        ]);

        Verification::create([
            'vehicle_id' => $this->editing->id,
            'type' => 'TSL'
        ]);

        $this->successMessage =  'Comment posted!';

        $this->showEditModal = false;

        $this->dispatchBrowserEvent('notify', 'Vehicle updated!');
    }

    public function getVehiclesProperty()
    {

        return Vehicle::query()
            ->search($this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.vehicle-table', [
            'vehicles' => $this->vehicles
        ]);

        // return view('livewire.vehicle-table', [
        //     'vehicles' => Vehicle::query()
        //         ->search($this->search)
        //         ->orderBy($this->sortField, $this->sortDirection)
        //         ->paginate(5),
        // ]);
    }
}
