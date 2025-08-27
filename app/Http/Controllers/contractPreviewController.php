<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContractPreviewController extends Controller
{
    public function preview()
    {
        return view('contracts.pdf')->render();
    }
}