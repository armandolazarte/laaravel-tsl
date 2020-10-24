<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FileBrowser extends Component
{
    public $object;
    public $ancestors;

    public $creatingNewFolder = false;

    public $newFolderState = [
        'name' => ''
    ];

    public function createFolder()
    {
        $this->validate([
            'newFolderState.name' => 'required|max:255'
        ]);

        $object = $this->currentCompany->objects()->make([
            'parent_id' => $this->object->id
        ]);

        $object->objectable()
            ->associate($this->currentCompany->folders()->create($this->newFolderState));
        $object->save();

        $this->creatingNewFolder = false;

        $this->newFolderState = [
            'name' => ''
        ];

        $this->object = $this->object->fresh();
    }

    public function getCurrentCompanyProperty()
    {
        return auth()->user()->company;
    }

    public function render()
    {
        return view('livewire.file-browser');
    }
}
