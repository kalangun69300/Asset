<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ตรวจสอบทรัพย์สิน
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <br>
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
                </style>
                <div class="row">
                <form action="{{ route('assetInspection.store') }}" method="POST">
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
                        @foreach($assets as $row)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->asset_code }}</td>
                                <td>{{ $row->asset_name }}</td>
                                <td>
                                    <input type="checkbox" class="border-dark border-1" id="checkbox{{$row->id}}" name="asset_pass[{{$row->id}}]">
                                </td>
                                <td>
                                    <input type="text" class="form-control border-dark" id="textbox{{$row->id}}" placeholder="--ระบุปัญหา--" name="asset_problem[{{$row->id}}]">
                                </td>
                                <td>รอการตรวจสอบ</td>
                                
                                <style>
                                    input::placeholder {
                                        text-align: center; /* การจัดให้อยู่ตรงกลาง */
                                    }
                                </style>
                            </tr> 
                        @endforeach
                        </tbody>
                    </table>
                        <div class="row mt-4">
                                <input type="submit" value="บันทึกการตรวจสอบ" class="btn btn-primary  ml-2">
                        </div>
                    </form>
                    <script>
                        new DataTable('#myTable');
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>