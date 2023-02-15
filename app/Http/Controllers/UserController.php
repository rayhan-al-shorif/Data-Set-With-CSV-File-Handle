<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Imports\UsersDataSet;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function importData(Request $request)
    {
        Excel::import(new UsersDataSet, $request->file('importUserData'));
        Session::flash('message', 'Price import successfully!');
        Session::flash('class', 'success');
        return back();
    }
}
