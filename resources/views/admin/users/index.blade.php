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
              @if(Auth::user()->is_admin)
              <h3 class="card-title">Пользователи сайта</h3>
              @elseif(Auth::user()->is_org_admin)
              <h3 class="card-title">Работники вашей организации</h3>
              @endif
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
                    <td @if($user->is_admin == 1) style="color: green;font-weight: 900" title="Админ" @elseif(Auth::user()->name == $user->name) style="color: #a3a21b;font-weight: 900" @endif>{{$user->name}}</td>
                    <td>{{$user->phone}}</td>
                    <td id="actions">
                      @if(Auth::user()->is_admin == 1 || Auth::user()->is_org_admin == 1)
                      <a style="font-size: 25px" href="{{route('users.edit', $user->id)}}" class="fa fa-edit"></a> 
                      <button data-route="{{route('users.destroy', $user->id)}}" type="button" class="delete">
                        <i style="font-size: 25px" class="fa fa-trash"></i>
                      </button>
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