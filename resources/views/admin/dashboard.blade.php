@extends('admin.layout')

@section('title', 'Админка')

@section('content')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Статистика за все время</h1>
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
                <h3>$ordersNewAll->count()</h3>

                <p>Новых заказов</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="route('orders.index')" class="small-box-footer">Заказы <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>$buyPercent<sup style="font-size: 20px">%</sup></h3>

                <p>Общая рентабельность</p>
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
                <h3>$postsAll->count() | $postsViewsAll<sup><i class="fa fa-eye"></i></sup></h3>

                <p>Видео</p>
              </div>
              <div class="icon">
                <i class="fas fa-video"></i>
              </div>
              <a href="route('posts.index')" class="small-box-footer">Все видео <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>$users->count() | $usersStatus->count()</h3>

                <p>Пользователи | Покупатели</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="route('users.index')" class="small-box-footer">Все пользователи <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <h3>Статистика за $month {{date('Y')}} года</h3>
        <div class="row">
          <!-- bar chart -->
      
          <div class="col-md-12">
            <canvas id="pie" width="100%"></canvas>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <h3>Статистика за {{date('Y')}} год</h3>
          </div> 
          <div class="col-md-6">
            <label for="years">Выберите год: </label>
            <select class="form-control select2" name="years" id="years">
              foreach($years as $year)
              <option if (date('Y') == $year) selected endif>$year</option>
              endforeach
            </select>
          </div> 
        </div>
        <div class="row">
          <div class="col-md-6" id="barChart">
            <canvas id="myChart" data-users="$usersYear" data-orders="$ordersYear" data-posts="$postsYear" width="100%"></canvas>
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
        labels: ['Видео', 'Продажи', 'Просмотры видео'],
        datasets: [{
            label: '# Месяц',
            data: [$posts->count(), $sellings, $postViews],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
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
<script type="text/javascript">
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
</script>
@endsection