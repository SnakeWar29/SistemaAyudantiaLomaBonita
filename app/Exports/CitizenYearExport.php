<?php

namespace App\Exports;

use App\Models\CitizenYear;
use Maatwebsite\Excel\Concerns\FromCollection;

class CitizenYearExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CitizenYear::all();
    }
}
