<?php

use App\Http\Livewire\VehicleDetails;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;

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

    Route::get('/vehicles', \App\Http\Livewire\VehicleTable::class)->name('vehicles');

    Route::get('vehicle/{id}', VehicleDetails::class)->name('vehicle-details');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});
