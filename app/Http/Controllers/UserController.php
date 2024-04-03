<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
  
        return view('users', compact('users'));
    }
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import(Request $request) 
    {
        // Validate incoming request data
        $request->validate([
            'file' => 'required|max:2048',
        ]);
        // dd($request->file('file')->path());
        Excel::import(new UsersImport, $request->file('file')->path());
                 
        return back()->with('success', 'Users imported successfully.');
    }
}
