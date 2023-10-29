<?php

namespace App\Exports;

use App\Models\CitizenShift;
use Maatwebsite\Excel\Concerns\FromCollection;

class CitizenShiftExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CitizenShift::all();
    }
}
