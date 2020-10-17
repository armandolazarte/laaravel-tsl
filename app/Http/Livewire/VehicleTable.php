<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use App\Models\Verification;
use Livewire\WithPagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithBulkActions;

class VehicleTable extends Component
{
    use WithPagination, WithSorting, WithBulkActions;

    public $search = '';
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $editing;
    public $successMessage;

    //protected $queryString = ['sortField', 'sortDirection'];

    protected $rules = [
        'editing.vin' => 'required',
        'editing.rego' => 'required',
        'editing.make' => 'required',
        'editing.model' => 'required',
        'editing.name' => 'required',
        'editing.phone' => 'required',
        'editing.email' => 'required',
    ];

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'vehicles.csv');
    }

    public function deleteSelected()
    {
        $this->selectedRowsQuery->delete();

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

    public function getRowsQueryProperty()
    {
        $query =  Vehicle::query()
            ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(5);
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selectPageRows();
        }

        return view('livewire.vehicle-table', [
            'vehicles' => $this->rows
        ]);

    }
}
