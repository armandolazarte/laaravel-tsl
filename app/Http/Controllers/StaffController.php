<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function show($id)
    {
        //$staff = Staff::findOrFail($id);
        //$staff = Staff::with('nok')->findOrFail($id);

        return view('staff-details', ['staff' => Staff::findOrFail($id)]);
    }
}
