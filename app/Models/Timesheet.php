<?php

namespace App\Models;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timesheet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, string $terms = null)
    {
        collect(explode(' ', $terms))->filter()->each(function ($term) use ($query) {
            $term = '%'.$term.'%';


            $query->where(function ($query) use ($term) {
                $query->where('started_at', 'like', $term)
                ->orWhere('staff_id', 'like', $term);
            });
        });
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
