<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'id' => $row[0],
            'usertype' => $row[1],
            'name' => $row[2],
            'email' => $row[3],
            'mobile' => $row[4],
            'address' => $row[5],
            'gender' => $row[6],
            'image' => $row[7],
            'fname' => $row[8],
            'mname' => $row[9],
            'Disabilities' => $row[10],
            'id_no' => $row[11],
            'dob' => $row[12],
            'code' => $row[13],
            'role' => $row[14],
            'join_date' => $row[15],
            'designation_id' => $row[16],
            'salary' => $row[17],
        ]);
    }
}
