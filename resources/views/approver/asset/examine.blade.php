<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ตรวจสอบทรัพย์สิน
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
              <div class="row">
                @if(session('success'))
                  <div class="alert alert-success alert-dismissible">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
              </div>
                <style>
                    /* สร้างพื้นหลังสีขาวคลุม DataTable, ช่องค้นหา และส่วนที่มี paginate */
                    .dataTables_wrapper {
                        background-color: #fff;
                        padding: 20px; /* ปรับระยะห่างตามความต้องการ */
                        border-radius: 8px; /* ปรับเป็นขอบโค้ง */
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* เพิ่มเงา */
                        margin-top: 20px; /* ปรับระยะห่างด้านบน */
                    }

                    /* ปรับสไตล์ของช่องค้นหา */
                    .dataTables_filter input {
                        border: 1px solid #ccc; /* เส้นขอบ */
                        border-radius: 8px; /* ขอบโค้ง */
                        padding: 8px; /* ขนาดของช่อง */
                    }

                    input::placeholder {
                      text-align: center; /* การจัดให้อยู่ตรงกลาง */
                    }
                </style>
                <form action="{{ route('examineStore') }}" method="POST" id="examine-form">
                  <input type="hidden" name="draft" value="N">
                  <div class="row">
                    @csrf
                    <table id="myTable" class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th scope="col">ลำดับ</th>
                                <th scope="col">รหัสทรัพย์สิน</th>
                                <th scope="col">ชื่อ</th>
                                <th scope="col">ผ่านการตรวจสอบ</th>
                                <th scope="col">ไม่ผ่านการตรวจสอบ</th>
                                <th scope="col">สถานะการตรวจสอบ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->asset_code }}</td>
                                <td>{{ $row->asset_name }}</td>
                                <td>
                                  @php
                                    $disable_checkbox = false;
                                    $disable_text = false;
                                    if($row->examine_status === 'COMPLETE'){
                                      $disable_checkbox = true;
                                      $disable_text = true;
                                    }
                                  @endphp
                                  <input type="checkbox" class="border-dark border-1" name="asset_pass[{{ $row->id_asset }}]"@if($row->asset_pass) checked @endif @if($disable_checkbox) disabled @endif>
                                </td>
                                <td>
                                    <input type="text" class="form-control border-dark" name="asset_problem[{{ $row->id_asset }}]" placeholder="--ระบุปัญหา--" @if($disable_text) disabled @endif value="{{ $row->asset_problem }}">
                                </td>
                                <td>
                                  @if($row->examine_status === 'COMPLETE')
                                    ตรวจสอบเรียบร้อย
                                  @else
                                    รอการตรวจสอบ
                                  @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                  </div>
                  <div class="row mt-3">
                    <div class="col-12">
                      <div class="d-flex flex-nowrap float-right grid gap-1">
                        <button class="order-1 p-2 btn btn-secondary btn-save"><i class="fas fa-save"></i> บันทึกแบบร่าง</button>
                        <button class="order-2 p-2 btn btn-primary btn-save-draft"><i class="fas fa-save"></i> บันทึก</button>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
    <script>
       new DataTable('#myTable');

      $( document ).ready(function() {

        let form = $("#examine-form")
        $('.btn-save').click(function(){
          form.submit()
        })

        $('.btn-save').click(function(){
          $('input[name=draft]').val('Y')
          form.submit()
        })
      });
    </script>
</x-app-layout>
