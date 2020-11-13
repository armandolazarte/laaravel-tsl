<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Vehicle;
use Livewire\Component;
use App\Models\Timesheet;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class TimesheetTable extends Component
{
    use WithPerPagePagination, WithPagination, WithSorting, WithBulkActions;

    public $search = '';
    public $showNonApproved = true;
    public $showDeleteModal = false;
    public $showApproveModal = false;

    public $showEditModal = false;
    public $showFilters = false;
    public $editing;
    public $successMessage;

    //protected $queryString = ['sortField', 'sortDirection'];

    protected $listeners = ['refreshVehicles' => '$refresh'];

    protected $rules = [
        'editing.started_at' => 'required',
        'editing.stopped_at' => 'required',
        'editing.morning_break' => 'required',
        'editing.afternoon_break' => 'required',
        'editing.comments' => 'required',
    ];

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
            'approved_date' => Carbon::now()->toDateTimeString()
        ]);

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
            ->where('approved', !$this->showNonApproved)
            ->with('staff:id,name')
            ->with('user:id,name')
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
