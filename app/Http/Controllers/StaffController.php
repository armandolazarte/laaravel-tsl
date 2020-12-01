<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function show($id)
    {
        return view('staff-details', ['staff' => Staff::findOrFail($id)]);
    }
}
