<?php

use App\Models\Vehicle;
use App\Http\Livewire\Suppliers;
use App\Http\Livewire\Transaction;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Livewire\TimesheetTable;
use App\Http\Livewire\VehicleDetails;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\EditTransaction;
use App\Http\Controllers\FileController;
use App\Http\Livewire\CreateTransaction;
use App\Http\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {

    Route::get('/staff', \App\Http\Livewire\StaffTable::class)->name('staff');
    Route::get('/timesheets', \App\Http\Livewire\TimesheetTable::class)->name('timesheets');

    Route::get('/vehicles', \App\Http\Livewire\VehicleTable::class)->name('vehicles');
    Route::get('/transactions', \App\Http\Livewire\TransactionTable::class)->name('transactions');
    Route::get('/suppliers', \App\Http\Livewire\Suppliers::class)->name('suppliers');
    Route::get('transactions/create', CreateTransaction::class)->name('create-transaction');
    Route::get('transactions/edit/{id}', EditTransaction::class)->name('edit-transaction');
    Route::get('vehicle/{id}', VehicleDetails::class)->name('vehicle-details');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

Route::get('/files', [FileController::class, 'index'])->name('files');

Route::get('/invoices/pdf/{id}', [InvoiceController::class, 'getInvoice']);
