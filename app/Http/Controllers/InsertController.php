<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asset;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Auth;

class InsertController extends Controller
{
    public function insert() {
        return view('approver.asset.insert');
    }

    public function store(Request $request) {
        //ตรวจสอบข้อมูล
       $request->validate([
            'asset_code'=>'required|max:255|unique:assets',
            'asset_name'=>'required|max:255',
            'asset_amount'=> 'required|integer|digits_between:1,20',
            'asset_brand'=>'required|max:255',
            'asset_type'=>'required|max:255',
            'asset_price'=>'required|integer|digits_between:1,20',
            'asset_recieve'=> 'required|max:255',
            'asset_giver' => 'nullable|max:255',
            'recieve_date'=>'required|date',
            'cancel_date' => 'nullable|date',
            'asset_status'=>'required|max:255',
            'asset_image'=>'required|mimes:jpg,jpeg,png'

        ],
        [
            'asset_code.required'=>"กรุณาใส่ข้อมูล",
            'asset_code.max'=>"กรุณาใส่ข้อมูลไม่เกิน 255 ตัวอักษร",
            'asset_code.unique'=>"มีข้อมูลนี้ในฐานข้อมูลแล้ว",
            'asset_name.required'=>"กรุณาใส่ข้อมูล",
            'asset_name.max'=>"กรุณาใส่ข้อมูลไม่เกิน 255 ตัวอักษร",
            'asset_amount.required'=>"กรุณาใส่ข้อมูล",
            'asset_amount.integer'=>"กรุณาใส่ข้อมูลเป็นตัวเลข",
            'asset_amount.digits_between'=>"กรุณาใส่ตัวเลขไม่เกิน 20 ตัว",
            'asset_brand.required'=>"กรุณาใส่ข้อมูล",
            'asset_brand.max'=>"กรุณาใส่ข้อมูลไม่เกิน 255 ตัวอักษร",
            'asset_type.required'=>"กรุณาใส่ข้อมูล",
            'asset_type.max'=>"กรุณาใส่ข้อมูลไม่เกิน 255 ตัวอักษร",
            'asset_price.required'=>"กรุณาใส่ข้อมูล",
            'asset_price.integer'=>"กรุณาใส่ข้อมูลเป็นตัวเลข",
            'asset_price.digits_between'=>"กรุณาใส่ตัวเลขไม่เกิน 20 ตัว",
            'asset_recieve.required'=>"กรุณาใส่ข้อมูล",
            'asset_recieve.max'=>"กรุณาใส่ข้อมูลไม่เกิน 255 ตัวอักษร",
            'asset_giver.max'=>"กรุณาใส่ข้อมูลไม่เกิน 255 ตัวอักษร",
            'recieve_date.required'=>"กรุณาใส่ข้อมูล",
            'recieve_date.date'=>"กรุณาใส่วันที่ในรูปแบบ yyyy/mm/dd",
            'cancel_date.date' => "กรุณาใส่วันที่ในรูปแบบ yyyy/mm/dd",
            'asset_status.required'=>"กรุณาใส่ข้อมูล",
            'asset_status.max'=>"กรุณาใส่ข้อมูลไม่เกิน 255 ตัวอักษร",
            'asset_image.required'=>"กรุณาใส่ภาพประกอบ",
            'asset_image.mimes'=>"กรุณาเลือกไฟล์ jpg,jpeg,png"
        ]
       );

       //การเข้ารหัสรูปภาพ
       $asset_image = $request->file('asset_image');

       //Generate ชื่อภาพ
       $name_gen=hexdec(uniqid());

       //ดึงนามสกุลไฟล์ภาพ
       $img_ext = strtolower($asset_image->getClientOriginalExtension());
       $img_name = $name_gen.'.'.$img_ext;
    
       //บันทึกข้อมูลภาพ
       $upload_location = 'image/asset/';
       $full_path = $upload_location.$img_name;

       Asset::insert([
            'asset_code'=>$request->asset_code,
            'asset_name'=>$request->asset_name,
            'asset_amount'=>$request->asset_amount,
            'asset_brand'=>$request->asset_brand,
            'asset_type'=>$request->asset_type,
            'asset_price'=>$request->asset_price,
            'asset_recieve'=>$request->asset_recieve,
            'asset_giver'=>$request->asset_giver,
            'recieve_date'=>$request->recieve_date,
            'cancel_date'=>$request->cancel_date,
            'asset_status'=>$request->asset_status,
            'asset_image'=>$full_path,
            'created_at'=>Carbon::now()
       ]);
       $asset_image->move($upload_location,$img_name);


       return redirect()->route('assetAll')->with('success', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
    }
}
