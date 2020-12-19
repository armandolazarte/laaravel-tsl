<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Models\Client;

class ClientTable extends Component
{
    use WithPerPagePagination, WithPagination, WithSorting, WithBulkActions;

    public $search = '';
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $editing;
    public $successMessage;
    public $showRight = false;
    public $selectedPerson;

    //protected $queryString = ['sortField', 'sortDirection'];

    protected $listeners = ['refreshVehicles' => '$refresh'];

    protected $rules = [
        'editing.company' => 'required',
        'editing.contact_name' => '',
        'editing.contact_phone' => '',
        'editing.contact_email' => '',
        'editing.address' => '',
        'editing.suburb' => '',
        'editing.city' => '',
    ];

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'client.csv');
    }

    public function deleteSelected()
    {
        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;
    }

    public function create()
    {
        $this->editing = Client::make([]);
        $this->showEditModal = true;
    }

    public function open($person)
    {
        //dd($person);
        $this->showRight = true;
        $this->selectedPerson = $person;
    }


    public function edit($staffID)
    {
        $staff = Client::find($staffID);

        $this->editing = $staff;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();

        $this->successMessage =  'Comment posted!';

        $this->showEditModal = false;

        $this->dispatchBrowserEvent('notify', 'Client updated!');
    }

    public function getRowsQueryProperty()
    {
        $query =  Client::query()
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

        return view('livewire.client-table', [
            'staff' => $this->rows
        ]);

    }
}
