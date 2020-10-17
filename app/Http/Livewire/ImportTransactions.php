<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Validator;

class ImportTransactions extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $upload;
    public $columns;

    public function updatingUpload($value)
    {
        Validator::make(['upload' => $value],
            ['upload' => $value],
            ['upload' => 'required|mimes:txt,csv']
        )->validate();
    }

    public function updatedUpload()
    {
        $this->columns = 
    }
}
