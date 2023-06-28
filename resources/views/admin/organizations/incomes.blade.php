@extends('admin.layout')

@section('title', 'Все Организации')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Организации на сайте</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
              <li class="breadcrumb-item active">Организации</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Организация: {{$organization->title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group">
                  <h1>Доходы</h1>
                  <div class="row">
                      <div class="col-6">
                          <a class="w-100 btn btn-outline-primary" href="{{route('organizations.show', $organization->id)}}">Посты</a>
                      </div>
                      <div class="col-6">
                          <a class="w-100 btn btn-outline-danger" href="{{route('organizations.consumptions', $organization->id)}}">Траты</a>
                      </div>
                  </div>
              </div>
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>От кого</th>
                  <th>Текст</th>
                  <th>Сумма</th>
                  <th>Картинка</th>
                  <th>Записал</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($incomes as $income)
                  <tr>
                    <td>{{$income->from}}</td>
                    <td>{{$income->text}}</td>
                    <td>{{$income->amount}}</td>
                    <td><img src="{{$income->getFile()}}" style="width: 200px" alt=""></td>
                    <td>{{$income->user->name}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{$incomes->links()}}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection