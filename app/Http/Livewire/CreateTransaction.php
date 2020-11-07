<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateTransaction extends Component
{
    public $transaction = [];
    public $transactionItems = [];

    public $jobs = ['job 1', 'job 2', 'job 3', 'job 4'];
    public $vehicles = ['vehicle 1', 'vehicle 2', 'vehicle 3', 'vehicle 4'];

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
