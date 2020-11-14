<?php

namespace App\Http\Livewire;

use App\Models\Job;
use App\Models\Vehicle;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\TransactionItems;

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
    public $suppliers = [];

    public function mount() {
        $this->vehicles = Vehicle::select('id', 'make', 'model')->get();
        $this->jobs = Job::select('id', 'job_ref', 'job_description')->get();
        $this->suppliers = Supplier::select('id', 'company_name', 'account_number')->get();
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

    public function create()
    {
        $transaction = Transaction::create([
            'title' => 'Test title',
            'supplier_id' => 2,
            'amount' => 3222,
            'status' => 'Pending',
            'date' => '12/11/2020',
        ]);

            foreach($this->transactionItems as $item) {
                //dd($item['job_id']);
                TransactionItems::create([
                    'transaction_id' => $transaction->id,
                    'job_id' => $item['job_id'],
                    'vehicle_id' => $item['vehicle_id'],
                    'description' => $item['description'],
                    'part_code' => $item['partCode'],
                    'purchase_code' => $item['purchaseCode'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'item_cost' => $item['itemCost'],
                ]);
            }

        //dd($transaction);
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
