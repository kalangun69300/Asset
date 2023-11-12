<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">ส่งซ่อมอุปกรณ์</h2>
  </x-slot>

  <div class="py-12"> <!-- ความห่างจาก navbar ด้านบน -->
  <div class="container mx-auto px-6 lg:px-8" > <!-- อยู่ในกรอบตรงกับ logo -->
  
  <!-- ฟอร์มกรอกรายละเอียด-->
  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
    <div class="font-semibold text-l text-gray-800 mb-4">กรุณากรอกรายระเอียดการส่งซ่อมอุปกรณ์</div>
      <form action="{{ route('assetRepair') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-md-6 mt-3" >
            <label for="asset">ทรัพย์สินที่ส่งซ่อม</label>
                    <select class="form-control" name="asset" id="asset">
                        <option value="">กรุณาเลือกทรัพย์สินที่ส่งซ่อม</option>
                        
                    </select>
                    @error('asset')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-md-6 mt-3" >
            <label for="store">ร้านที่ส่งซ่อม</label>
                 <input type="text" class="form-control" name="asset_store">
                 @error('asset_store')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <br>
        <div class="row ml-1">
          <div class="col-md-6 my-2">
            <label for="repair_date" class="form-label">วันที่ส่งซ่อม</label>
            <input type="date" class="form-control" name="repair_date" >
            @error('repair_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="col-md-6 my-2">
            <label for="pickup_date" class="form-label">กำหนดรับอุปกรณ์</label>
            <input type="date" class="form-control" name="pickup_date">
            @error('pickup_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          
        </div>
     

        <div class="row mt-4 mb-4 justify-content-end">
          <div class="col-md-1">
            <input type="submit" value="บันทึก" class="btn btn-success mb-4">
          </div>
          <div class="col-md-1">
            <a href="{{ route('dashboard') }}" class="btn btn-danger">ยกเลิก</a>
          </div>
        </div>
      </form>
      

     
  </div>
</x-app-layout>

