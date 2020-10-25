<?php

namespace App\Http\Livewire;

use App\Models\Obj;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileBrowser extends Component
{
    use WithFileUploads;

    public $upload;
    public $object;
    public $ancestors;

    public $creatingNewFolder = false;
    public $renamingObject;
    public $renamingObjectState;
    public $showingFileUploadModal = false;

    public $newFolderState = [
        'name' => ''
    ];

    public $confirmObjectDeletion;

    public function deleteObject()
    {
        Obj::forCurrentCompany()->find($this->confirmObjectDeletion)->delete();

        $this->confirmObjectDeletion = null;

        $this->object = $this->object->fresh();
    }

    public function updatedUpload($upload)
    {
        $object = $this->currentCompany->objects()->make(['parent_id' => $this->object->id]);

        $object->objectable()->associate(
            $this->currentCompany->files()->create([
                'name' => $upload->getClientOriginalName(),
                'size' => $upload->getSize(),
                'path' => $upload->storePublicly('files', ['disk' => 'local'])
            ])
        );

        $object->save();

        $this->object = $this->object->fresh();
    }

    public function renameObject()
    {
        $this->validate([
            'renamingObjectState.name' => 'required|max:255'
        ]);

        Obj::forCurrentCompany()->find($this->renamingObject)->objectable->update($this->renamingObjectState);

        $this->object = $this->object->fresh();

        $this->renamingObject = null;
    }

    public function updatingRenamingObject($id)
    {
        if($id === null) {
            return;
        }
        if($object = Obj::forCurrentCompany()->find($id)) {
            $this->renamingObjectState = [
                'name' => $object->objectable->name
            ];
        }
    }

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
