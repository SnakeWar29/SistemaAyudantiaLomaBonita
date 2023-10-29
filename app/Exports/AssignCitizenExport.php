<?php

namespace App\Exports;

use App\Models\AssignCitizen;
use Maatwebsite\Excel\Concerns\FromCollection;

class AssignCitizenExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AssignCitizen::all();
    }
}
