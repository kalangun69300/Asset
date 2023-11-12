<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Examine;
use Illuminate\Http\Request;
use App\Models\Asset;

class ExamineAssetController extends Controller
{
    public function examines()
    {
        $assets = Asset::all();
        return view('approver.asset.examine', compact('assets'));
    }

}