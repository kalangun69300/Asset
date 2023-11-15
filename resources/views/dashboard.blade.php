<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
              <div class="row">
                <div class="col-md-6">
                  <h4>ผลการตรวจทรัพย์สิน</h4>
                  <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <div class="col-md-6">
                  <h4>ประเภททรัพย์สิน</h4>
                  <div class="chart">
                    <canvas id="barChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
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

        var donutData = {
          labels: [
              'Chrome',
              'IE',
              'FireFox',
              'Safari',
              'Opera',
              'Navigator',
          ],
          datasets: [
            {
              data: [700,500,400,600,300,100],
              backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
          ]
        }

        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData        = donutData;
        var pieOptions     = {
          maintainAspectRatio : false,
          responsive : true,
          plugins: {
            legend: {
              "position": 'bottom'
            }
          }
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
          type: 'pie',
          data: pieData,
          options: {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
              position: 'bottom'
            }
          }
        })

        var areaChartData = {
          labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [
            {
              label               : 'Digital Goods',
              backgroundColor     : 'rgba(60,141,188,0.9)',
              borderColor         : 'rgba(60,141,188,0.8)',
              pointRadius          : false,
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : [28, 48, 40, 19, 86, 27, 90]
            },
            {
              label               : 'Electronics',
              backgroundColor     : 'rgba(210, 214, 222, 1)',
              borderColor         : 'rgba(210, 214, 222, 1)',
              pointRadius         : false,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#c1c7d1',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : [65, 59, 80, 81, 56, 55, 40]
            },
          ]
        }

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        var temp1 = areaChartData.datasets[1]
        barChartData.datasets[0] = temp1
        barChartData.datasets[1] = temp0

        var barChartOptions = {
          responsive              : true,
          maintainAspectRatio     : false,
          datasetFill             : false,
          legend: {
            position: 'bottom'
          }
        }

        new Chart(barChartCanvas, {
          type: 'bar',
          data: barChartData,
          options: barChartOptions
        })


        var barChartCanvas1 = $('#barChart1').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        var temp1 = areaChartData.datasets[1]
        barChartData.datasets[0] = temp1
        barChartData.datasets[1] = temp0

        new Chart(barChartCanvas1, {
          type: 'bar',
          data: barChartData,
          options: barChartOptions
        })
      })


      function loadChartPie(){
        $.ajax({
          url: "/getDataChart",
          method: "POST",
          data: {
            provinces: sel_provinces.val(),
            districts: sel_districts.val()
           }
        }).done(function( res ) {

          pieChart.data.datasets[0].data = res.pieData
          pieChart.update()

          barChart.data.datasets[0].data = res.barData.data_y
          barChart.data.datasets[1].data = res.barData.data_n
          barChart.data.labels = res.barData.label
          barChart.update()

        });
      }

    </script>
</x-app-layout>
