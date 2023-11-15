<?php

namespace App\Http\Controllers;

use App\Models\AssetRepair;
use App\Models\Asset;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller
{
    public function repair()
    {

      $data = DB::table('asset_repairs')
              ->join('assets', 'assets.id', '=', 'asset_repairs.asset_id')
              ->join('users', 'users.id', '=', 'asset_repairs.user_id')
              ->select('asset_repairs.*', 'users.name', 'assets.asset_name')->get();

      return view('approver.asset.repair', compact('data'));
    }

    public function insert(){
      $data = Asset::where('asset_status', '!=', 'ส่งซ่อม')->get();
      return view('approver.asset.repair-insert', compact('data'));
    }

    public function store(Request $request){

      try {

        $request->validate([
          'asset'=>'required',
          'store_name'=>'required',
          'repair_date'=>'required|date',
          'pickup_date' => 'required|date',
        ],[
          'asset.required'=>"กรุณาเลือกทรัพย์สิน",
          'store_name.required'=>"กรุณากรอกร้านที่ส่งซ่อม",
          'repair_date.required'=>"กรุณาใส่ข้อมูล",
          'pickup_date.required'=>"กรุณาใส่ข้อมูล",
          'repair_date.date'=>"กรุณาใส่วันที่ในรูปแบบ yyyy/mm/dd",
          'pickup_date.date' => "กรุณาใส่วันที่ในรูปแบบ yyyy/mm/dd",
        ]);

        AssetRepair::insert([
          'asset_id' => $request->asset,
          'store_name' => $request->store_name,
          'repair_date' => $request->repair_date,
          'pickup_date' => $request->pickup_date,
          'remark' => $request->remark,
          'created_at'=>Carbon::now(),
          'user_id' => Auth::id()
        ]);

        $asset = Asset::find($request->asset);
        $asset->asset_status = 'ชำรุด';
        $asset->save();

        return redirect()->route('assetRepair')->with('success', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
      } catch (\Throwable $th) {
        throw $th;
        dd($th);
      }

    }


}
