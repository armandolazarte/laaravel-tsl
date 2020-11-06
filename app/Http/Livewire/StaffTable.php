<?php

namespace App\Http\Livewire;

use App\Models\Staff;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class StaffTable extends Component
{
    use WithPerPagePagination, WithPagination, WithSorting, WithBulkActions;

    public $search = '';
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $editing;
    public $successMessage;

    //protected $queryString = ['sortField', 'sortDirection'];

    protected $listeners = ['refreshVehicles' => '$refresh'];

    protected $rules = [
        'editing.name' => 'required',
        'editing.email' => 'required',
        'editing.phone' => 'required',
        'editing.address' => 'required',
        'editing.suburb' => 'required',
        'editing.city' => 'required',
    ];

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'staff.csv');
    }

    public function deleteSelected()
    {
        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;
    }

    public function create()
    {
        $this->editing = Staff::make([]);
        $this->showEditModal = true;
    }


    public function edit($staffID)
    {
        $staff = Staff::find($staffID);

        $this->editing = $staff;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();

        $this->successMessage =  'Comment posted!';

        $this->showEditModal = false;

        $this->dispatchBrowserEvent('notify', 'Staff updated!');
    }

    public function getRowsQueryProperty()
    {
        $query =  Staff::query()
            ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selectPageRows();
        }

        return view('livewire.staff-table', [
            'staff' => $this->rows
        ]);

    }
}
