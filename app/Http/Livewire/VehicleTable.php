<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use App\Models\Verification;
use Livewire\WithPagination;
use App\Http\Livewire\Datatable\WithSorting;

class VehicleTable extends Component
{
    use WithPagination, WithSorting;


    public $showDeleteModal = false;
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

    public function updatedSelected()
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->selected = $this->vehicles->pluck('id')->map(fn ($id) => (string) $id);
        } else {
            $this->selected = [];
        }
    }

    public function selectAll()
    {
        $this->selectAll = true;
    }



    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo (clone $this->vehiclesQuery)
                ->unless($this->selectAll, fn($query) => $query->whereKey($this->selected))
                ->toCsv();
        }, 'vehicles.csv');
    }

    public function deleteSelected()
    {
        (clone $this->vehiclesQuery)
                ->unless($this->selectAll, fn($query) => $query->whereKey($this->selected))
                ->delete();

        $this->showDeleteModal = false;
    }

    public function create()
    {
        $this->editing = Vehicle::make([]);
        $this->showEditModal = true;
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

    public function getVehiclesQueryProperty()
    {
        $query =  Vehicle::query()
            ->search($this->search);

        return $this->applySorting($query)


    }

    public function getVehiclesProperty()
    {
        return $this->vehiclesQuery->paginate(5);
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selected = $this->vehicles->pluck('id')->map(fn ($id) => (string) $id);
        }

        return view('livewire.vehicle-table', [
            'vehicles' => $this->vehicles
        ]);

    }
}
