<?php

namespace App\Http\Livewire\DataTable;

trait WithPerPagePagination
{
    public $perPage = 25;

    public function applyPagination($query)
    {
        return $query->paginate($this->perPage);
    }
}