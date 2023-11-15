<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AssetExamine;
use App\Models\Asset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamineAssetController extends Controller
{
    public function index()
    {
      $data = DB::table('assets')
              ->leftJoin('asset_examines', function ($join) {
                  $join->on('assets.id', '=', 'asset_examines.asset_id')
                    ->where('asset_examines.deleted_at', '=', 0);
              })
              ->leftJoin('users', 'users.id', '=', 'asset_examines.user_id')
              ->select('asset_examines.*', 'users.name', 'assets.asset_name', 'assets.asset_code', 'assets.id as id_asset')
              ->get();

      return view('approver.asset.examine', compact('data'));
    }

    public function store(Request $request){

      try {

        $draft = $request->draft;
        $arr_problem = $request->asset_problem;
        $arr_pass = $request->asset_pass;

        foreach ($arr_problem as $id => $value) {
          $is_edit = false;
          $value_problem = "";
          $value_pass = "";

          if($value){
            $value_problem = $value;
            $is_edit = true;
          }else{

            if(isset($arr_pass[$id])){
              $value_pass = "Y";
              $is_edit = true;
            }
          }

          if($is_edit){
            $exit_examine = AssetExamine::where('asset_id', $id)->where('examine_status', '!=', 'COMPLETE')->where('deleted_at', 0)->first();
            if($exit_examine){
              $exit_examine->asset_pass = $value_pass ? $value_pass : null;
              $exit_examine->asset_problem = $value_problem ? $value_problem : null;
              $exit_examine->user_id = Auth::id();
              $exit_examine->examine_status = $draft === 'Y' ? 'DRAFT' : 'COMPLETE';
              $exit_examine->draft = $draft;
              $exit_examine->updated_at = Carbon::now();
              $exit_examine->save();

            }else{
              $examine = new AssetExamine;
              $examine->asset_id = $id;
              $examine->asset_pass = $value_pass ? $value_pass : null;
              $examine->asset_problem = $value_problem ? $value_problem : null;
              $examine->user_id = Auth::id();
              $examine->examine_status = $draft === 'Y' ? 'DRAFT' : 'COMPLETE';
              $examine->draft = $draft;
              $examine->save();
            }

          }
        }

        return redirect()->route('assetExamine')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');

      } catch (\Throwable $th) {
        throw $th;
      }

    }

}
