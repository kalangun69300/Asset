<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">ส่งซ่อมอุปกรณ์</h2>
  </x-slot>

  <div class="py-12">
    <div class="container mx-auto px-6 lg:px-8">


      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row justify-content-end">
            <div class="col-12">
                <div class="align-items-end">
                  <a href="{{ url('/repair/insert') }}" class="btn btn-primary btn-lg float-right">
                    <i class="fas fa-plus mt-1"></i>  เพิ่มข้อมูลการส่งซ่อมอุปกรณ์
                  </a>
                </div>
            </div>
        </div>
        <div class="row mt-3">
          <table id="myTable" class="table table-striped table-hover">
            <thead class="table-primary">
                <tr class="text-center">
                  <th scope="col">ลำดับ</th>
                  <th scope="col">ทรัพย์สิน</th>
                  <th scope="col">สถานะ</th>
                  <th scope="col">วันที่ส่งซ่อม</th>
                  <th scope="col">ผู้ส่งซ่อม</th>
                  <th scope="col">หมายเหตุ</th>
                  <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($data as $d)
                <tr class="text-center">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $d->asset_name }}</td>
                  <td>{{ $d->status }}</td>
                  <td>{{ date("d/m/Y", strtotime($d->repair_date)) }}</td>
                  <td>{{ $d->name }}</td>
                  <td>{{ $d->remark }}</td>
                  <td>
                    <button type="button" class="btn btn-info update-btn">
                      <i class="far fa-edit"></i>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>


      </div>
    </div>
  </div> <!-- ความห่างจาก navbar ด้านบน -->
   <!-- อยู่ในกรอบตรงกับ logo -->

  <!-- ฟอร์มกรอกรายละเอียด-->


  <script>
    new DataTable('#myTable');
  </script>
</x-app-layout>

