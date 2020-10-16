<?php

namespace App\Http\Livewire\DataTable;

trait WithBulkActions
{
    public $selectPage = false;
    public $selectAll = false;
    public $selected = [];

    public function updatedSelected()
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->selected = $this->rows->pluck('id')->map(fn ($id) => (string) $id);
        } else {
            $this->selected = [];
        }
    }

    public function selectAll()
    {
        $this->selectAll = true;
    }
}