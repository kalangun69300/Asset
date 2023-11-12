<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            เพิ่มรายการทรัพย์สิน
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="fs-3 mb-8">กรุณากรอกรายระเอียดทรัพย์สิน</div>
                <form action="{{ route('assetStore') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_code">รหัสทรัพย์สิน</label>
                                <input type="text" class="form-control" name="asset_code">
                                @error('asset_code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_name">ชื่อทรัพย์สิน</label>
                                <input type="text" class="form-control" name="asset_name">
                                @error('asset_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_amount">จำนวน</label>
                                <input type="text" class="form-control" name="asset_amount">
                                @error('asset_amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_brand">แบรนด์</label>
                                <input type="text" class="form-control" name="asset_brand">
                                @error('asset_brand')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_type">ประเภท</label>
                                <select class="form-control" name="asset_type">
                                    <option value="">กรุณาเลือกประเภททรัพย์สิน</option>
                                    <option value="ของส่วนกลาง">ของส่วนกลาง</option>
                                    <option value="เบิกใช้ส่วนตัว">เบิกใช้ส่วนตัว</option>
                                    <option value="เบิกใช้ชั่วคราว">เบิกใช้ชั่วคราว</option>
                                    <option value="ไม่ต้องคืน">ไม่ต้องคืน</option>
                                </select>
                                @error('asset_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_price">ราคา</label>
                                <input type="text" class="form-control" name="asset_price">
                                @error('asset_price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_recieve">วิธีการได้รับทรัพย์สิน</label>
                                <select class="form-control" name="asset_recieve">
                                    <option value="">กรุณาเลือกวิธีการได้รับทรัพย์สิน</option>
                                    <option value="จัดซื้อ">จัดซื้อ</option>
                                    <option value="ผลิตเอง">ผลิตเอง</option>
                                    <option value="เช่า">เช่า</option>
                                    <option value="รับบริจาค">รับบริจาค</option>
                                </select>
                                @error('asset_recieve')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_giver">ผู้บริจาค (หากมี)</label>
                                <input type="text" class="form-control" name="asset_giver">
                                @error('asset_giver')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recieve_date">วันที่ได้รับทรัพย์สิน</label>
                                <input type="date" class="form-control" name="recieve_date">
                                @error('recieve_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cancel_date">วันที่ยกเลิกใช้งาน</label>
                                <input type="date" class="form-control" name="cancel_date">
                                @error('cancel_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_status">สถานะ</label>
                                <select class="form-control" name="asset_status">
                                    <option value="">กรุณาเลือกสถานะ</option>
                                    <option value="ว่าง">ว่าง</option>
                                    <option value="ไม่ว่าง">ไม่ว่าง</option>
                                    <option value="ไม่ว่าง">รอดำเนินการ</option>
                                    <option value="ชำรุด">ชำรุด</option>
                                    <option value="ยกเลิกการใช้งาน">ยกเลิกการใช้งาน</option>
                                </select>
                                @error('asset_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="asset_image">ภาพประกอบ</label>
                                <input type="file" class="form-control" name="asset_image">
                                @error('asset_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4 justify-content-end">
                        <div class="col-md-1">
                            <input type="submit" value="บันทึก" class="btn btn-success mb-4">
                        </div>
                        <div class="col-md-1">
                            <a href="{{ route('assetAll') }}" class="btn btn-danger">ยกเลิก</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
