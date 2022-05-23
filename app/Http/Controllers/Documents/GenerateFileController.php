<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Title;


class GenerateFileController extends Controller
{
    public function estimate($id)
    {
        $trade = Title::find($id);
        return view('dashboard.reports.estimate' ,compact('trade'));
    }
}
