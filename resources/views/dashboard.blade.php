<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
              <div class="row row-cols-lg-auto g-3">
                <div class="col-12">
                  <select class="form-select" id="select_year">
                    <option value="">เลือกปี</option>
                    <option value="2023" @if(date('Y') === '2023') selected @endif>2023</option>
                    <option value="2022" @if(date('Y') === '2022') selected @endif>2022</option>
                    <option value="2021" @if(date('Y') === '2021') selected @endif>2021</option>
                  </select>
                </div>
                <div class="col-12">
                  <select class="form-select" id="select_month">
                    <option value="">ทั้งหมด</option>
                    <option value="01" @if(date('n') === '01') selected @endif>มกราคม</option>
                    <option value="02" @if(date('n') === '02') selected @endif>กุมภาพันธ์</option>
                    <option value="03" @if(date('n') === '03') selected @endif>มีนาคม</option>
                    <option value="04" @if(date('n') === '04') selected @endif>เมษายน</option>
                    <option value="05" @if(date('n') === '05') selected @endif>พฤษภาคม</option>
                    <option value="06" @if(date('n') === '06') selected @endif>มิถุนายน</option>
                    <option value="07" @if(date('n') === '07') selected @endif>กรกฎาคม</option>
                    <option value="08" @if(date('n') === '08') selected @endif>สิงหาคม</option>
                    <option value="09" @if(date('n') === '09') selected @endif>กันยายน</option>
                    <option value="10" @if(date('n') === '10') selected @endif>ตุลาคม</option>
                    <option value="11" @if(date('n') === '11') selected @endif>พฤศจิกายน</option>
                    <option value="12" @if(date('n') === '12') selected @endif>ธันวาคม</option>
                  </select>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  <h4 class="text-center">ผลการตรวจทรัพย์สิน</h4>
                  <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <div class="col-md-6">
                  <h4 class="text-center">ประเภททรัพย์สิน</h4>
                  <div class="chart">
                    <canvas id="barChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <h4 class="text-center">สถานะทรัพย์สิน</h4>
                  <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script>
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(function () {

        let select_year = $("#select_year")
        let select_month = $("#select_month")

        select_year.change(function(){
          loadChartData()
        })

        select_month.change(function(){
          loadChartData()
        })

        //-------------
        //- PIE CHART -
        //-------------

        var pieData = {
          labels: ['ว่าง', 'ไม่ว่าง', 'ส่งซ่อม', 'ชำรุด', 'ยกเลิกการใช้งาน'],
          datasets: [
            {
              data: [0,0,0,0,0],
              backgroundColor : ['#7ad08a', '#92d8b5', '#9dcd2a', '#daa810', '#c45312'],
            }
          ]
        }

        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieOptions     = {
          maintainAspectRatio : false,
          responsive : true,
          plugins: {
            legend: {
              position: 'bottom'
            }
          }
        }

        //Create chart
        let pieChart = new Chart(pieChartCanvas, {
          type: 'pie',
          data: pieData,
          options: pieOptions
        })

        //-------------
        //- BAR CHART 1-
        //-------------
        let barChartCanvas = $('#barChart').get(0).getContext('2d')
        let barChartData = {
          labels  : ['ผ่านการพิจารณา', 'ไม่ผ่านการพิจารณา'],
          datasets: [
            {
              label: 'ผลการตรวจทรัพย์สิน',
              backgroundColor     : ['rgba(0, 191, 125, 0.5)', 'rgba(255, 99, 132, 0.5)'],
              borderColor         : ['rgba(0, 191, 125, 1)', 'rgba(255, 99, 132, 1)'],
              data                : [0, 0]
            }
          ]
        }
        let barChartOptions = {
          responsive: true,
          maintainAspectRatio: false,
          datasetFill: false,
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
        let barChart = new Chart(barChartCanvas, {
          type: 'bar',
          data: barChartData,
          options: barChartOptions
        })

        //-------------
        //- BAR CHART 2-
        //-------------

        let barChartCanvas1 = $('#barChart1').get(0).getContext('2d')
        let barChartData1 = {
          labels: ['ของส่วนกลาง', 'เบิกใช้ส่วนตัว', 'เบิกใช้ชั่วคราว', 'ไม่ต้องคืน'],
          datasets: [
            {
              label: 'ประเภททรัพย์สิน',
              backgroundColor: ['rgba(5, 79, 185, 0.5)', 'rgba(4, 97, 207, 0.5)', 'rgba(0, 115, 230, 0.5)', 'rgba(139, 171, 241, 0.5)'],
              borderColor: ['rgba(5, 79, 185, 1)', 'rgba(4, 97, 207, 1)', 'rgba(0, 115, 230, 1)', 'rgba(139, 171, 241, 1)'],
              data: [0,0,0,0]
            }
          ]
        }
        let barChart1 = new Chart(barChartCanvas1, {
          type: 'bar',
          data: barChartData1,
          options: barChartOptions
        })

        loadChartData()

        function loadChartData(){
          $.ajax({
            url: "/getDataChart",
            method: "POST",
            data: {
              month: select_month.val(),
              year: select_year.val()
            }
          }).done(function( res ) {
            pieChart.data.datasets[0].data = res.pieData
            pieChart.update()

            barChart.data.datasets[0].data = res.barData
            barChart.update()

            barChart1.data.datasets[0].data = res.barData1
            barChart1.update()

          });
        }

      })

    </script>
</x-app-layout>
