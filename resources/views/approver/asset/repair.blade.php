<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">ส่งซ่อมอุปกรณ์</h2>
  </x-slot>

  <div class="py-12">
    <div class="container mx-auto px-6 lg:px-8">

      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">รายการส่งซ่อม</h5>
                <p class="card-text fs-2">{{ number_format($count_all) }}</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">ส่งซ่อม</h5>
                <p class="card-text fs-2">{{ number_format($count_waiting) }}</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">ดำเนินการเสร็จสิ้น</h5>
                <p class="card-text fs-2">{{ number_format($count_success) }}</p>
              </div>
            </div>
          </div>
        </div>


        <div class="row justify-content-end mt-3">
          <div class="col-md-3">
            <select name="status" id="status" class="form-control">
              <option value="all" @if($option_status === 'all' || $option_status === '') selected @endif>รายการส่งซ่อมทั้งหมด</option>
              <option value="waiting" @if($option_status === 'waiting') selected @endif>ส่งซ่อม</option>
              <option value="success" @if($option_status === 'success') selected @endif>ดำเนินการเสร็จสิ้น</option>
            </select>
          </div>
          <div class="col-md-9">
            <div class="align-items-end">
              <a href="{{ url('/repair/insert') }}" class="btn btn-primary float-right">
                <i class="fas fa-plus mt-1"></i> เพิ่มข้อมูลการส่งซ่อมอุปกรณ์
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
                    @if($d->status !== 'ดำเนินการเสร็จสิ้น')
                      <button type="button" class="btn btn-info update-btn" data-id="{{ $d->id }}" data-asset="{{ $d->asset_id }}">
                        <i class="far fa-edit"></i>
                      </button>
                    @endif
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

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">ปรับสถานะ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('repairUpdate') }}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <input type="hidden" name="asset_id">
            <div class="modal-body">
              <div class="mb-3">
                <label for="status" class="form-label">สถานะทรัพย์สิน</label>
                <select class="form-control" name="asset_status" id="asset_status" required>
                    <option value="">กรุณาเลือกสถานะ</option>
                    <option value="ว่าง">ว่าง</option>
                    <option value="ไม่ว่าง">ไม่ว่าง</option>
                    <option value="ส่งซ่อม">ส่งซ่อม</option>
                    <option value="ชำรุด">ชำรุด</option>
                    <option value="ยกเลิกการใช้งาน">ยกเลิกการใช้งาน</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">บันทึก</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
          </form>
        </div>
      </div>
    </div>




  <script>
    new DataTable('#myTable');

    $( document ).ready(function() {
      let select_status = $('#status')

      select_status.change(function(){
        let path_url = window.location.pathname
        let status = select_status.val()

        let url = path_url + '?'
                  + (status !== null ? 'status=' + status : "")

        location.replace(url)
      })

      $('.update-btn').each(function(){
        $(this).click(function(){
          $('input[name=id]').val($(this).data('id'))
          $('input[name=asset_id]').val($(this).data('asset'))

          $('#staticBackdrop').modal('show')
        })
      })
    })
  </script>
</x-app-layout>

