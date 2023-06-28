@extends('admin.layout')

@section('title', 'Все пользователи')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Пользователи на сайте</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
              <li class="breadcrumb-item active">Пользователи</li>
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
              <h3 class="card-title">Пользователи сайта</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group" style="text-align: right">
                <a href="{{route('users.create')}}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Никнейм</th>
                  <th>Телефон</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>Никнейм</th>
                  <th>Телефон</th>
                  <th>Действия</th>
                </tr>
                </tfoot>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td @if($user->is_admin == 1) style="color: green;font-weight: 900" title="Админ"@endif>{{$user->name}}</td>
                    <td>{{$user->phone}}</td>
                    <td id="actions">
                      @if(Auth::user()->is_admin == 1)
                      <a style="font-size: 25px" href="{{route('users.edit', $user->id)}}" class="fa fa-edit"></a> 
                      @if(Auth::user()->id != 1)
                      <button data-route="{{route('users.destroy', $user->id)}}" type="button" class="delete">
                        <i style="font-size: 25px" class="fa fa-trash"></i>
                      </button>
                      @endif
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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