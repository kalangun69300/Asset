<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;

class ShowAssetController extends Controller

{
    public function ShowAsset()
    {
        $assets = Asset::all(); // ดึงข้อมูลจาก Model เพื่อแสดงผลทั้งหมด
        return view('approver.asset.showAsset',compact('assets'));
    }
}

