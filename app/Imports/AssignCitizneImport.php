<?php

namespace App\Imports;

use App\Models\AssignCitizen;
use Maatwebsite\Excel\Concerns\ToModel;

class AssignCitizneImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AssignCitizen([
            'id' => $row[0],
            'citizen_id' => $row[1],
            'roll' => $row[2],
            'class_id' => $row[3],
            'year_id' => $row[4],
            'group_id' => $row[5],
            'shift_id' => $row[6],
            'created_at' => $row[7],
            'updated_at' => $row[8],
        ]);
    }
}
