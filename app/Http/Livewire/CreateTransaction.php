<?php

namespace App\Http\Livewire;

use App\Models\Job;
use App\Models\Vehicle;
use Livewire\Component;

class CreateTransaction extends Component
{
    public $foo = '';
    public $second = '';
    public $third = '';
    public $property = '';
    public $transaction = [];
    public $transactionItems = [
        ['job_id' => '', 'vehicle_id' => '']
    ];
    public $lineItems = [
        ['job_id' => '', 'vehicle_id' => '']
    ];

    public $allVehicles = [];
    public $allJobs = [];

    public function mount() {
        $this->allVehicles = Vehicle::select('id', 'make', 'model')->get();
        $this->allJobs = Job::select('id', 'job_ref', 'job_description')->get();
    }

    public function addLineItem()
    {
        $this->transactionItems[] = [
            'job_id' => '',
            'vehicle_id' => '',
        ];
    }

    public function updateItems($item)
    {
        //dd($id);
        $this->transactionItems[$item[0]]['vehicle_id'] = [$item[1]];
    }


    public function render()
    {
        return view('livewire.create-transaction');
    }
}
