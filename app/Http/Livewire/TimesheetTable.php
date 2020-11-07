<?php

namespace App\Http\Livewire;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Timesheet;
use Livewire\WithPagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use Illuminate\Support\Facades\Auth;

class TimesheetTable extends Component
{
    use WithPerPagePagination, WithPagination, WithSorting, WithBulkActions;

    public $search = '';
    public $showDeleteModal = false;
    public $showApproveModal = false;

    public $showEditModal = false;
    public $showFilters = false;
    public $editing;
    public $successMessage;

    //protected $queryString = ['sortField', 'sortDirection'];

    protected $listeners = ['refreshVehicles' => '$refresh'];

    // protected $rules = [
    //     'editing.name' => 'required',
    //     'editing.email' => 'required',
    //     'editing.phone' => 'required',
    //     'editing.address' => 'required',
    //     'editing.suburb' => 'required',
    //     'editing.city' => 'required',
    // ];

    public function updatedFilters() { $this->resetPage(); }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'staff.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->dispatchBrowserEvent('notify', 'You\'ve deleted '.$deleteCount.' transactions');
    }

    public function approveSelected()
    {
        $count = $this->selectedRowsQuery->update([
            'approved' => 1,
            'approved_by' => Auth::id(),
        ]);

        $id = Auth::id();

        $this->dispatchBrowserEvent('notify', $count . ' Timesheet records approved!');

        $this->showApproveModal = false;
    }

    public function create()
    {
        $this->editing = Timesheet::make([]);
        $this->showEditModal = true;
    }


    public function edit($staffID)
    {
        $staff = Timesheet::find($staffID);

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
        $query =  Timesheet::query()
            ->where('approved', false)
            ->with('staff')
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

        return view('livewire.timesheet-table', [
            'timesheets' => $this->rows
        ]);
    }
}
