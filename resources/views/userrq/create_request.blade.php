<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">ยืมทรัพย์สิน</h2>
  </x-slot>

  <div class="py-12"> <!-- ความห่างจาก navbar ด้านบน -->
  <div class="container mx-auto px-6 lg:px-8" > <!-- อยู่ในกรอบตรงกับ logo -->
  
  <!-- ฟอร์มกรอกรายละเอียด-->
  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
    <div class="font-semibold text-l text-gray-800 mb-4">กรุณากรอกรายระเอียดคำขอยืมทรัพย์สิน</div>
      <form action="{{ route('request') }}" method="post">
        @csrf
        <div class="col-md-6 mt-3" >
          <label for="create_at">วันที่สร้างคำขอ</label>
          <input type="date" class="form-control" value="{{now()->toDateString()}}" readonly>
        </div>
        <div class="row ml-1">
          <div class="col-md-6 my-2">
            <label for="borrow_date" class="form-label">วันที่ยืม</label>
            <input type="date" class="form-control" name="borrow_date" >
            
            
          </div>
          
          <div class="col-md-6 my-2">
            <label for="return_date" class="form-label">วันที่คืน</label>
            <input type="date" class="form-control" name="return_date">
          </div>
          
        </div>
     
        <div class="row">
          <div class="col-7 my-2">
            <div class="form-group">
              <label for="asset">Asset:</label>
                  <select class="form-control" name="asset" id="asset">
                    <option value="">กรุณาเลือกทรัพย์สินที่ต้องการยืม</option>
                      @foreach($assets as $asset)
                          <option value="{{ $asset->id }}">{{ $asset->asset_name }}</option>
                      @endforeach
                  </select>
            </div>
          </div>
          <div class="col-5">
            <label for="quantity" class="form-label">จำนวนที่ต้องการยืม</label>
            <input type="text" class="form-control" name="quantity">
          </div>
        </div>
        

        <div class="col-12 my-2">
          <label for="description" class="form-label">เหตุผล</label>
          <input type="text" class="form-control" name="description">
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

