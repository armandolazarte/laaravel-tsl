<?php

namespace App\Http\Livewire;

use App\Models\Job;
use App\Models\Vehicle;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\TransactionItems;

class EditTransaction extends Component
{
    public $transaction;
    public $items;
    public $vehicles = [];
    public $jobs = [];

    protected $rules = [
        'items.*.description' => 'required',
        'items.*.part_code' => '',
        'items.*.purchase_code' => '',
        'items.*.quantity' => '',
        'items.*.unit' => '',
        'items.*.item_cost' => '',
    ];

    public function mount($id)
    {
        $transaction = Transaction::find($id);
        $this->items = collect($transaction->transactionItems);
        //dd($this->items);
        $this->vehicles = Vehicle::select('id', 'make', 'model')->get();
        $this->jobs = Job::select('id', 'job_ref', 'job_description')->get();
        $this->transaction = $transaction;
    }
    public function render()
    {
        return view('livewire.edit-transaction');
    }
}
