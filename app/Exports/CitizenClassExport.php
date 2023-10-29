<?php

namespace App\Exports;

use App\Models\CitizenClass;
use Maatwebsite\Excel\Concerns\FromCollection;

class CitizenClassExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CitizenClass::all();
    }
}
