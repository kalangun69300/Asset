<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขรายละเอียด
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="fs-3 mb-8">แบบฟอร์มแก้ไขข้อมูล</div>
                <form action="{{ url('/asset/update/'.$assets->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_code">รหัสทรัพย์สิน</label>
                                <input type="text" class="form-control" name="asset_code" value="{{ $assets->asset_code }}">
                            </div>
                            @error('asset_code')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_name">ชื่อทรัพย์สิน</label>
                                <input type="text" class="form-control" name="asset_name" value="{{ $assets->asset_name }}">
                            </div>
                            @error('asset_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_amount">จำนวน</label>
                                <input type="text" class="form-control" name="asset_amount" value="{{ $assets->asset_amount }}">
                                @error('asset_amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_brand">แบรนด์</label>
                                <input type="text" class="form-control" name="asset_brand" value="{{ $assets->asset_brand }}">
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
                                    <option value="ของส่วนกลาง" @if($assets->asset_type == 'ของส่วนกลาง') selected @endif>ของส่วนกลาง</option>
                                    <option value="เบิกใช้ส่วนตัว" @if($assets->asset_type == 'เบิกใช้ส่วนตัว') selected @endif>เบิกใช้ส่วนตัว</option>
                                    <option value="เบิกใช้ชั่วคราว" @if($assets->asset_type == 'เบิกใช้ชั่วคราว') selected @endif>เบิกใช้ชั่วคราว</option>
                                    <option value="ไม่ต้องคืน" @if($assets->asset_type == 'ไม่ต้องคืน') selected @endif>ไม่ต้องคืน</option>
                                </select>
                            </div>
                            @error('asset_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_price">ราคา</label>
                                <input type="text" class="form-control" name="asset_price" value="{{ $assets->asset_price }}">
                            </div>
                            @error('asset_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_recieve">วิธีการได้รับทรัพย์สิน</label>
                                    <select class="form-control" name="asset_recieve">
                                        <option value="จัดซื้อ" @if($assets->asset_recieve == 'จัดซื้อ') selected @endif>จัดซื้อ</option>
                                        <option value="ผลิตเอง" @if($assets->asset_recieve == 'ผลิตเอง') selected @endif>ผลิตเอง</option>
                                        <option value="เช่า" @if($assets->asset_recieve == 'เช่า') selected @endif>เช่า</option>
                                        <option value="รับบริจาค" @if($assets->asset_recieve == 'รับบริจาค') selected @endif>รับบริจาค</option>
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
                                <input type="date" class="form-control" name="recieve_date" value="{{ $assets->recieve_date }}">
                            </div>
                            @error('recieve_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cancel_date">วันที่ยกเลิกใช้งาน</label>
                                <input type="date" class="form-control" name="cancel_date" value="{{ $assets->cancel_date }}">
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
                                        <option value="ว่าง" @if($assets->asset_status == 'ว่าง') selected @endif>ว่าง</option>
                                        <option value="ไม่ว่าง" @if($assets->asset_status == 'ไม่ว่าง') selected @endif>ไม่ว่าง</option>
                                        <option value="รอดำเนินการ" @if($assets->asset_status == 'รอดำเนินการ') selected @endif>รอดำเนินการ</option>
                                        <option value="ชำรุด" @if($assets->asset_status == 'ชำรุด') selected @endif>ชำรุด</option>
                                        <option value="ยกเลิกการใช้งาน" @if($assets->asset_status == 'ยกเลิกการใช้งาน') selected @endif>ยกเลิกการใช้งาน</option>
                                    </select>
                                @error('asset_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="asset_image">ภาพประกอบ</label>
                                <input type="file" class="form-control" name="asset_image" value="{{ $assets->asset_image }}">
                            </div>
                            @error('asset_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="old_image" value="{{ $assets->asset_image }}">
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <img src="{{ asset($assets->asset_image) }}" alt="" width="400px" height="400px">
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
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
