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
        [
            'job_id' => '',
            'vehicle_id' => '',
            'description' => '',
            'partCode' => '',
            'purchaseCode' => '',
            'quantity' => '',
            'unit' => '',
            'itemCost' => '',
        ]
    ];

    public $vehicles = [];
    public $jobs = [];

    public function mount() {
        $this->vehicles = Vehicle::select('id', 'make', 'model')->get();
        $this->jobs = Job::select('id', 'job_ref', 'job_description')->get();
    }

    public function addLineItem()
    {
        $this->transactionItems[] = [
            'job_id' => '',
            'vehicle_id' => '',
            'description' => '',
            'partCode' => '',
            'purchaseCode' => '',
            'quantity' => '',
            'unit' => '',
            'itemCost' => '',
        ];
    }

    public function updateItems($item)
    {
        //dd($item);
        $this->transactionItems[$item[0]][$item[1]] = $item[2];
    }

    public function removeProduct($index)
    {
        unset($this->transactionItems[$index]);
        $this->transactionItems = array_values($this->transactionItems);
    }


    public function render()
    {
        return view('livewire.create-transaction');
    }

}
