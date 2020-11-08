<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class CreateTransaction extends Component
{
    public $transaction = [];
    public $transactionItems = [
        ['job_id' => '', 'vehicle_id' => '']
    ];
    public $lineItems = [];

    public $allVehicles = [];
    public $allJobs = [];

    public function mount() {
        $this->allVehicles = Vehicle::select('id', 'make', 'model')->get();
        $this->allJobs = Job::select('id', 'make', 'model')->get();
    }

    public function addLineItem()
    {
        $this->transactionItems[] = [
            'job_id' => '',
            'vehicle_id' => '',
            'quantity' => '',
            'amount' => ''
        ];
    }

    public function render()
    {
        return view('livewire.create-transaction');
    }
}
