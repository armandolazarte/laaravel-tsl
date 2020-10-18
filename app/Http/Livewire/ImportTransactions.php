<?php

namespace App\Http\Livewire;

use App\Csv;
use Validator;
use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportTransactions extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $upload;
    public $columns;
    public $fieldColumnMap = [
        'rego' => '',
        'make' => '',
        'model' => '',
    ];

    protected $rules = [
        'fieldColumnMap.rego' => 'required',
        'fieldColumnMap.make' => 'required',
        'fieldColumnMap.model' => 'required',
    ];

    public function updatingUpload($value)
    {
        Validator::make(
            ['upload' => $value],
            ['upload' => 'required|mimes:txt,csv'],
        )->validate();
    }

    public function updatedUpload()
    {
        $this->columns = Csv::from($this->upload)->columns();
        $this->guessWhichColumnsMapToWhichFields();
    }

    public function import()
    {
        $this->validate();

        $importCount = 0;

        Csv::from($this->upload)
            ->eachRow(function ($row) use (&$importCount) {
                Vehicle::create(
                    $this->extractFieldsFromRow($row)
                );
                $importCount++;
            });

        $this->showModal = false;

        $this->reset();

        $this->emit('refreshVehicles');

        $this->dispatchBrowserEvent('notify', 'Imported ' . $importCount .' Records!');
    }


    public function extractFieldsFromRow($row)
    {
        $attributes = collect($this->fieldColumnMap)
            ->filter()
            ->mapWithKeys(function($heading, $field) use ($row) {
                return [$field => $row[$heading]];
            })
            ->toArray();

            return $attributes;
        //return $attributes + ['status' => 'success', 'date_for_editing' => now()];
    }

    public function guessWhichColumnsMapToWhichFields()
    {
        $guesses = [
            'rego' => ['rego'],
            'make' => ['make'],
            'model' => ['model']
        ];

        foreach ($this->columns as $column) {
            $match = collect($guesses)->search(fn($options) => in_array(strtolower($column), $options));

            if ($match) $this->fieldColumnMap[$match] = $column;
        }
    }
}
