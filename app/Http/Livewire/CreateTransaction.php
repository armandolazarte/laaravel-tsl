<?php

namespace App\Http\Livewire;

use App\Models\Job;
use App\Models\Vehicle;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\TransactionItems;
use Illuminate\Support\Facades\DB;

class CreateTransaction extends Component
{
    public $foo = '';
    public $second = '';
    public $third = '';
    public $property = '';
    public $transaction = [
        'title' => '',
        'date' => null,
        'due_date' => null,
    ];
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
        $latest = DB::table('transactions')->latest()->first();
        $invoiceNumber = '';
        $totalPrice = 0;

        if(! $latest) {
            $invoiceNumber = 'INV-00001';
        } else {
            $invoiceNumber = 'INV-' . (str_pad((int)$latest->id + 1, 5, '0', STR_PAD_LEFT));
        }

        foreach($this->transactionItems as $item) {
            $totalPrice += $item['itemCost'];
        }
        //dd($totalPrice);

        $transaction = Transaction::create([
            'title' => 'Test title',
            'invoice_number' => $invoiceNumber,
            'supplier_id' => 2,
            'amount' => $totalPrice,
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
