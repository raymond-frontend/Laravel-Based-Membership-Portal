<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CsvImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Member;

class CsvFile extends Controller
{
    public function index(){
        $members = Member::latest()->get();
        return view('csv', compact('members'));
    }

    public function csv_import(){
        Excel::import(new CsvImport, request()->file('file'));
        return back();
    }
}
