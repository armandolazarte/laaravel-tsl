<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\WithPagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class Suppliers extends Component
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
        'editing.company_name' => 'required',
        'editing.account_number' => 'required',
        'editing.email' => 'required',
        'editing.contact_name' => 'required',
        'editing.contact_number' => 'required',
        'editing.street_address' => 'required',
        'editing.suburb' => 'required',
        'editing.city' => 'required',
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

        $this->dispatchBrowserEvent('notify', 'You\'ve deleted '.$deleteCount.' suppliers');
    }


    public function create()
    {
        $this->editing = Supplier::make([]);
        $this->showEditModal = true;
    }


    public function edit($supplierID)
    {
        $supplier = Supplier::find($supplierID);

        $this->editing = $supplier;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();

        $this->successMessage =  'Comment posted!';

        $this->showEditModal = false;

        $this->dispatchBrowserEvent('notify', 'Supplier updated!');
    }

    public function getRowsQueryProperty()
    {
        $query =  Supplier::query()
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

        return view('livewire.suppliers', [
            'suppliers' => $this->rows
        ]);
    }
}
