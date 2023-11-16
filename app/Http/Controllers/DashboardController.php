<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index(){
    return view('dashboard');
  }

  public function getDataChart(Request $requst) {
    try {

      $year = $requst->year ? $requst->year : date('Y');
      $month = $requst->month ? $requst->month : date('n');

      $date = $year.'-'.$month;

      $list = [
        'pieData' => $this->getPieData($date),
        'barData' => $this->getbarData($date),
        'barData1' => $this->getbarData1($date)
      ];

      return response()->json($list);

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function getPieData($date){
    $c1 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_status', 'ว่าง')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), "=", $date)->get();
    $c2 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_status', 'ไม่ว่าง')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), "=", $date)->get();
    $c3 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_status', 'ส่งซ่อม')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), "=", $date)->get();
    $c4 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_status', 'ชำรุด')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), "=", $date)->get();
    $c5 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_status', 'ยกเลิกการใช้งาน')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), "=", $date)->get();

    return [$c1[0]->total, $c2[0]->total, $c3[0]->total, $c4[0]->total, $c5[0]->total];
  }

  public function getbarData($date){
    $c1 = DB::table('asset_examines')->select(DB::raw('count(*) as total'))->where('asset_pass', 'Y')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), "=", $date)->get();
    $c2 = DB::table('asset_examines')->select(DB::raw('count(*) as total'))->whereNotNull('asset_problem')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), "=", $date)->get();

    return [$c1[0]->total, $c2[0]->total];
  }

  public function getbarData1($date){
    $c1 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_type', 'ของส่วนกลาง')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), "=", $date)->get();
    $c2 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_type', 'เบิกใช้ส่วนตัว')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), "=", $date)->get();
    $c3 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_type', 'เบิกใช้ชั่วคราว')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), "=", $date)->get();
    $c4 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_type', 'ไม่ต้องคืน')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), "=", $date)->get();

    return [$c1[0]->total, $c2[0]->total, $c3[0]->total, $c4[0]->total];
  }
}
