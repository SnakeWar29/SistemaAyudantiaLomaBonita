<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user=User::select('id','usertype','name','email','mobile','address','gender','image','fname','mname','Disabilities','id_no','dob','code','role','join_date','designation_id','salary')->get();
        return $user;
        //return User::all();
    }
}
