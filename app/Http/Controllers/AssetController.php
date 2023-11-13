<?php

namespace App\Http\Controllers;
use App\Models\BorrowRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;

use Carbon\Carbon;

class AssetController extends Controller
{

    public function assetAll() {

        $assets = Asset::all();
        $borrow_requests = BorrowRequest::all();
        return view('approver.asset.index',compact('assets','borrow_requests'));
    }

    public function edit($id) {
        $assets = Asset::find($id);
        return view('approver.asset.edit',compact('assets'));
    }

    public function update(Request $request , $id) {
        //ตรวจสอบข้อมูล
        $request->validate([
            'asset_code'=>'required|max:255',
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
            'asset_image'=>'mimes:jpg,jpeg,png'

        ],
        [
            'asset_code.required'=>"กรุณาใส่ข้อมูล",
            'asset_code.max'=>"กรุณาใส่ข้อมูลไม่เกิน 255 ตัวอักษร",
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
            'cancel_date.date'=>"กรุณาใส่วันที่ในรูปแบบ yyyy/mm/dd",
            'asset_status.required'=>"กรุณาใส่ข้อมูล",
            'asset_status.max'=>"กรุณาใส่ข้อมูลไม่เกิน 255 ตัวอักษร",
            'asset_image.required'=>"กรุณาใส่ภาพประกอบ",
            'asset_image.mimes'=>"กรุณาเลือกไฟล์ jpg,jpeg,png"
        ]
       );

       $asset_image = $request->file('asset_image');
       //อัพเดตภาพและชื่อ
       if($asset_image){
            //Generate ชื่อภาพ
       $name_gen=hexdec(uniqid());

       //ดึงนามสกุลไฟล์ภาพ
       $img_ext = strtolower($asset_image->getClientOriginalExtension());
       $img_name = $name_gen.'.'.$img_ext;

       //อัพโหลดและอัพเดตข้อมูล
       $upload_location = 'image/asset/';
       $full_path = $upload_location.$img_name;


       Asset::find($id)->update([
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
       ]);
       //ลบภาพเก่าและใส่ภาพใหม่แทนที่
       $old_image = $request->old_image;
       unlink($old_image);
       $asset_image->move($upload_location,$img_name);

       return redirect()->route('assetAll')->with('success',"อัพเดตข้อมูลเรียบร้อย");

       }else{
        //อัพเดตชื่ออย่างเดียว
            Asset::find($id)->update([
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
            ]);

        return redirect()->route('assetAll')->with('success',"อัพเดตข้อมูลเรียบร้อย");
       }
    }

    public function delete($id) {
        //ลบภาพ
        $img = Asset::find($id)->asset_image;
        unlink($img);

        //ลบข้อมูลจากฐานข้อมูล
        $delete=Asset::find($id)->delete();
        return redirect()->route('assetAll')->with('success',"ลบข้อมูลเรียบร้อย");
    }

}
