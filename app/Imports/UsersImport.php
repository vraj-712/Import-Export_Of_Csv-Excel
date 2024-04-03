<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        // dd($row);
        return new User([
            'name'     => $row[1],
            'email'    => $row[2], 
            'password' => Hash::make('password'),
        ]);
    }
    public function rules(): array
    {
        return [
            'name' => 'required',
            'password' => 'required|min:5',
            'email' => 'required|email|unique:users'
        ];
    }
}
