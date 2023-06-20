@extends('admin.layout')

@section('title', 'Админка')

@section('content')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class="row">
              <div class="col-md-6">
                <h1 class="m-0 text-dark">Статистика за все время для: </h1>
              </div>
              <div class="col-md-6">
                <form action="{{route('dashboard')}}" method="GET">
                  <select class="form-control select2" onchange="{this.form.submit()}" name="region_id">
                    @foreach($regions as $r)
                    <option value="{{$r->id}}" @if ($region->id == $r->id) selected @endif>{{$r->title_ru}}</option>
                    @endforeach
                  </select>
                </form>
              </div>
            </div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Главная</a></li> -->
              <li class="breadcrumb-item active">Главная</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$newRequests}}</h3>

                <p>Новых обращений</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$solvedRequests}}</h3>

                <p>Решенных</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$processRequests}}</h3>

                <p>В работе</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$unsolvedRequests}}</h3>

                <p>Нерешенных</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <h3>@if(Auth::user()->is_admin) Общая @else Личная @endif cтатистика за все время (В будущем за месяц с фильтрами) </h3>
        <div class="row">
          <!-- bar chart -->
      
          <div class="col-md-12">
            <canvas id="pie" width="100%"></canvas>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <h3>Статистика за {{date('Y')}} год (Future feature)</h3>
          </div> 
          <div class="col-md-6">
            <label for="years">Выберите год: </label>
            <select class="form-control select2" name="years" id="years">
              @foreach($years as $year)
              <option @if (date('Y') == $year) selected @endif>{{$year}}</option>
              @endforeach
            </select>
          </div> 
        </div>
        <div class="row">
          <div class="col-md-6" id="barChart">
            <canvas id="myChart" data-users="[222,33,4324,34]" data-orders="[123,23,123, 2]" data-posts="[228,14,88,11]" width="100%"></canvas>
          </div>
          <div class="col-md-6" id="lineChart">
            <canvas id="line" data-total="$monthlyTotal" width="100%"></canvas>
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('chart-main')
<script>
function drawChart(){
  var ctx = document.getElementById('myChart').getContext('2d');
  var users = $('#myChart').data('users')
  var orders = $('#myChart').data('orders')
  var posts = $('#myChart').data('posts')
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ['Январь', 'Февраль', 'Март', "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
          datasets: [{
              label: 'Новые пользователи',
              backgroundColor: 'rgba(255, 99, 132, 1)',
              borderColor: 'rgba(255, 99, 132, 1)',
              data: users
               //группировка количества пользователей через orderBy('created_at'), группировка по месяцам
          },{
              label: 'Заказы',
              backgroundColor: 'rgba(54, 162, 235, 1)',
              borderColor: 'rgba(54, 162, 235, 1)',
              data: orders
          },
          {
              label: 'Видео',
              backgroundColor: 'rgba(255, 206, 86, 1)',
              borderColor: 'rgba(255, 206, 86, 1)',
              data: posts
          },
        ]    
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });

  var ctx = document.getElementById('line').getContext('2d');
  var total = $('#line').data('total')
  var line = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ['Январь', 'Февраль', 'Март', "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
          datasets: [{
              label: 'Доход',
              backgroundColor: 'rgba(255, 0, 0, .7)',
              borderColor: 'rgba(255, 0, 0, 1)',
              data: total
               //группировка количества пользователей через orderBy('created_at'), группировка по месяцам
          },
        ]    
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
}
var ctx = document.getElementById('pie').getContext('2d');
var pie = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Новые', "В процессе", 'Решенные', 'Нерешенные'],
        datasets: [{
            label: '# Месяц',
            data: [{{$newRequests}}, {{$processRequests}}, {{$solvedRequests}}, {{$unsolvedRequests}}],
            backgroundColor: [
                '#33a2b8',
                '#fec135',
                '#4fa845',
                '#dd4145',
            ],
            borderColor: [
                '#33a2b8',
                '#fec135',
                '#4fa845',
                '#dd4145',
            ],
            borderWidth: 1,
            height: 400,
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

document.addEventListener("DOMContentLoaded", drawChart)
</script>
<!-- <script type="text/javascript">
  $(function() {
  $("#years").on('change', function () {
    // console.log("changed");
    var select = $(this)

    var year = select.val();

    $.ajax({

        url: '/admin/year=' + year,

        type: "POST",

        headers: {

        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },


        success: function (data) {
          $('#line').remove()
          $('#lineChart').append('<canvas id="line" data-total="'+ data['monthlyTotal'] +'" width="100%"></canvas>')//передается, но не генерируется
          $('#myChart').remove()
          $('#barChart').append('<canvas id="myChart" data-users="' + data['usersYear'] + '" data-orders="' + data['ordersYear'] + '" data-posts="' + data['postsYear'] + '" width="100%"></canvas>')
          drawChart()
          // $('#line').attr('data-total', data['monthlyTotal'])
          // $('#myChart').attr('data-users', )
          // $('#myChart').attr('data-orders', data['ordersYear'])
          // $('#myChart').attr('data-businesses', data['businessesYear'])
          
        },

        error: function (data, msg) {

            alert('Ошибка');
            console.log(data)

        }

      });            
});
})
</script> -->
@endsection