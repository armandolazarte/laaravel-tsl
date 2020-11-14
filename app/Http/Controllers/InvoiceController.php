<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Transaction;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function getInvoice($id)
    {
        // $transaction = Transaction::with(['transactionItems'])
        //     ->where('id', $id);
        $transaction = Transaction::with(['transactionItems'])
            ->findOrFail($id);
        //dd($transaction);

        $pdf = PDF::loadView('invoice', compact('transaction'));

        return $pdf->stream();
    }
}
