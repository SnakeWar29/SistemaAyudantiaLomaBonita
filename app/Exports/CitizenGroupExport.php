<?php

namespace App\Exports;

use App\Models\CitizenGroup;
use Maatwebsite\Excel\Concerns\FromCollection;

class CitizenGroupExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CitizenGroup::all();
    }
}
