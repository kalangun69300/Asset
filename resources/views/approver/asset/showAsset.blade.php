<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            อุปกรณ์ทั้งหมด
        </h2>
    </x-slot>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

            <div class="row mb-4">
              <div class="col-md-2">
                <select class="form-control" name="page_size" id="page_size">
                  <option value="12" @if($search_option["page_size"] === 12 || $search_option["page_size"] === '') selected @endif>12</option>
                  <option value="24" @if($search_option["page_size"] === 24) selected @endif>24</option>
                  <option value="48" @if($search_option["page_size"] === 48) selected @endif>48</option>
                  <option value="72" @if($search_option["page_size"] === 72) selected @endif>72</option>
                </select>
              </div>
              <div class="col-md-4">
                <select class="form-control" name="asset_type" id="asset_type">
                  <option value="all" @if($search_option["asset_type"] === 'all' || $search_option["asset_type"] === '') selected @endif>อุปกรณ์ทั้งหมด</option>
                  <option value="empty" @if($search_option["asset_type"] === 'empty') selected @endif>เฉพาะอุปกรณ์ที่ว่าง</option>
                </select>
              </div>
              <div class="col-md-6">
                <input type="text" id="search" name="search" class="form-control border-2 rounded-pill" placeholder="Search...">
              </div>
            </div>

            <div class="row mb-4">
              <div class="grid grid-cols-4 gap-4">
                  @foreach($assets as $asset)
                    <!-- เริ่มต้นแถว -->
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
                    <!-- จบแถว -->
                  @endforeach
              </div>
            </div>
            <div class="row">
              {{ $assets->links() }}
            </div>
        </div>
      </div>
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

        $( document ).ready(function() {
          let select_page_size = $('#page_size')
          let select_asset_type = $('#asset_type')

          select_page_size.change(function(){
            getData()

          })

          select_asset_type.change(function(){
            getData()

          })


          function getData(){
            let searchParams = new URLSearchParams(window.location.search)
            let path_url = window.location.pathname
            let page = searchParams.get('page')
            let page_size = select_page_size.val()
            let asset_type = select_asset_type.val()

            let url = path_url + '?'
                      + (page !== null ? 'page=' + page + '&' : "")
                      + (page_size !== null ? 'page_size=' + page_size + '&' : "")
                      + (asset_type !== null ? 'asset_type=' + asset_type : "")

            location.replace(url)
          }
        });

    </script>
</x-app-layout>
