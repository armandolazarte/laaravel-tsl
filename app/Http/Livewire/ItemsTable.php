<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Models\Item;

class ItemsTable extends Component
{
    use WithPerPagePagination, WithPagination, WithSorting, WithBulkActions;

    public $search = '';
    public $showDeleteModal = false;
    public $showFilters = false;
    public $editing;
    public $successMessage;

    //protected $queryString = ['sortField', 'sortDirection'];

    protected $listeners = ['refreshVehicles' => '$refresh'];

    protected $rules = [
        'editing.name' => 'required',
        'editing.price' => 'required',
        'editing.unit' => '',
        'editing.description' => ''
    ];

    public function updatedFilters() {
        $this->resetPage();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'items.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->dispatchBrowserEvent('notify', 'You\'ve deleted '.$deleteCount.' items');
    }


    public function create()
    {
        $this->editing = Item::make([]);
        $this->showEditModal = true;
    }


    public function edit($supplierID)
    {
        $supplier = Item::find($supplierID);

        $this->editing = $supplier;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();

        //$this->successMessage =  'Item posted!';

        $this->showEditModal = false;

        $this->dispatchBrowserEvent('notify', 'Item updated!');
    }

    public function getRowsQueryProperty()
    {
        $query =  Item::query()
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

        return view('livewire.items-table', [
            'items' => $this->rows
        ]);
    }

}
