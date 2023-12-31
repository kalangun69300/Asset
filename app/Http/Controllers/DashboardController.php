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
      $month = $requst->month;

      if($year && $month){
        $date_format = "(DATE_FORMAT(created_at,'%Y-%m'))";
        $date = $year.'-'.$month;
      }else if($year){
        $date_format = "(DATE_FORMAT(created_at,'%Y'))";
        $date = $year;
      }

      $list = [
        'pieData' => $this->getPieData($date, $date_format),
        'barData' => $this->getbarData($date, $date_format),
        'barData1' => $this->getbarData1($date, $date_format)
      ];

      return response()->json($list);

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function getPieData($date, $date_format){
    $c1 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_status', 'ว่าง')->where(DB::raw($date_format), "=", $date)->get();
    $c2 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_status', 'ไม่ว่าง')->where(DB::raw($date_format), "=", $date)->get();
    $c3 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_status', 'ส่งซ่อม')->where(DB::raw($date_format), "=", $date)->get();
    $c4 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_status', 'ชำรุด')->where(DB::raw($date_format), "=", $date)->get();
    $c5 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_status', 'ยกเลิกการใช้งาน')->where(DB::raw($date_format), "=", $date)->get();

    return [$c1[0]->total, $c2[0]->total, $c3[0]->total, $c4[0]->total, $c5[0]->total];
  }

  public function getbarData($date, $date_format){
    $c1 = DB::table('asset_examines')->select(DB::raw('count(*) as total'))->where('asset_pass', 'Y')->where(DB::raw($date_format), "=", $date)->get();
    $c2 = DB::table('asset_examines')->select(DB::raw('count(*) as total'))->whereNotNull('asset_problem')->where(DB::raw($date_format), "=", $date)->get();

    return [$c1[0]->total, $c2[0]->total];
  }

  public function getbarData1($date, $date_format){
    $c1 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_type', 'ของส่วนกลาง')->where(DB::raw($date_format), "=", $date)->get();
    $c2 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_type', 'เบิกใช้ส่วนตัว')->where(DB::raw($date_format), "=", $date)->get();
    $c3 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_type', 'เบิกใช้ชั่วคราว')->where(DB::raw($date_format), "=", $date)->get();
    $c4 = DB::table('assets')->select(DB::raw('count(*) as total'))->where('asset_type', 'ไม่ต้องคืน')->where(DB::raw($date_format), "=", $date)->get();

    return [$c1[0]->total, $c2[0]->total, $c3[0]->total, $c4[0]->total];
  }
}
