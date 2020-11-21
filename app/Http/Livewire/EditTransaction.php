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
    public $foo;
    protected $rules = [
        'items.*.job_id' => 'required',
        'items.*.vehicle_id' => 'required',
        'items.*.description' => 'required',
        'items.*.part_code' => '',
        'items.*.purchase_code' => '',
        'items.*.quantity' => '',
        'items.*.unit' => '',
        'items.*.item_cost' => '',
    ];

    public function save()
    {
        $this->validate();
        foreach ($this->items as $item) {
            //dd(array_key_exists('id', $item));
            //dd($item->contains('id'));
            if(array_key_exists('id', $item)) {
                TransactionItems::where('id', $item['id'])->update([
                    'job_id' => $item['job_id'],
                    'vehicle_id' => $item['vehicle_id'],
                    'description' => $item['description'],
                    'part_code' => $item['part_code'],
                    'purchase_code' => $item['purchase_code'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'item_cost' => $item['item_cost'],
                ]);
            } else {
                TransactionItems::create([
                    'job_id' => $item['job_id'],
                    'vehicle_id' => $item['vehicle_id'],
                    'description' => $item['description'],
                    'part_code' => $item['part_code'],
                    'purchase_code' => $item['purchase_code'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'item_cost' => $item['item_cost'],
                ]);
            }


        }
    }



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
