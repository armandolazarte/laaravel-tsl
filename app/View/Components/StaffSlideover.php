<?php

namespace App\View\Components;

use App\Models\Staff;
use Illuminate\View\Component;

class StaffSlideover extends Component
{
    public $staffID;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($staff)
    {
        //
        $this->staffID = $staff;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        //return view('components.staff-slideover', ['staff' => Staff::findOrFail($this->staffID)->with('timesheets')]);
        return view('components.staff-slideover', ['staff' => Staff::with('timesheets')->findOrFail($this->staffID)]);
    }
}
