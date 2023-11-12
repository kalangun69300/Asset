<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            อุปกรณ์ทั้งหมด
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4 position-relative">
                    <input type="text" id="search" class="form-control border-2 rounded-pill" placeholder="Search...">
                </div>

                <div class="grid grid-cols-4 gap-4">
                    @foreach($assets as $asset)
                    <!-- เริ่มต้นแถว -->
                    @if ($asset->asset_type != 'ของส่วนกลาง')
                    <div class="border-1 p-8 rounded-md">
                        <!-- รูปภาพของอุปกรณ์ -->
                        <div class="row justify-content-center">
                            <img src="{{asset($asset->asset_image)}}" alt="" style="max-width: 200px; max-height: 200px;">
                        </div>
                        <br>
                        <div class="row">
                                รหัสทรัพย์สิน: {{ $asset->asset_code }}
                        </div>
                        <div class="row">
                                อุปกรณ์: {{ $asset->asset_name }}
                        </div>                            
                        <div class="row">
                                แบรนด์สินค้า: {{ $asset->asset_brand }}
                        </div>
                        <div class="row">
                                สถานะปัจจุบัน: {{ $asset->asset_status }}
                        </div>
                        <div class="row">
                                วันที่กำหนดคืน: {{ optional($asset->borrowRequest)->return_date ? date('d/m/Y', strtotime(optional($asset->borrowRequest)->return_date)) : '-' }}
                               
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12 text-center ">
                                <button class="btn btn-{{ $asset->asset_status != 'ว่าง' ? 'secondary' : 'primary' }} px-4 mb-0 " 
                                        @if ($asset->asset_status != 'ว่าง' || $asset->asset_type == 'ว่าง')
                                            disabled
                                        @else
                                            onclick="location.href='{{ url('/request') }}';"
                                        @endif
                                    >
                                        เบิก
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- จบแถว -->
                    @endforeach
                </div>

                <script>
                    document.getElementById('search').addEventListener('input', function() {
                        let input = this.value.toLowerCase();
                        let assets = document.getElementsByClassName('border-1');

                        Array.from(assets).forEach(asset => {
                            let text = asset.innerText.toLowerCase();
                            if (text.includes(input)) {
                                asset.style.display = "block";
                            } else {
                                asset.style.display = "none";
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>