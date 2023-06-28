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
              <h3 class="card-title">Организации сайта</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group" style="text-align: right">
                <a href="{{route('organizations.create')}}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Название</th>
                  <th>Регионы</th>
                  <th>Админы организации</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>Название</th>
                  <th>Регионы</th>
                  <th>Админы организации</th>
                  <th>Действия</th>
                </tr>
                </tfoot>
                <tbody>
                  @foreach($organizations as $organization)
                  <tr>
                    <td>{{$organization->title}}</td>
                    <td>
                      @foreach($organization->regions as $region)
                      {{$region->title_ru}} @if(!$loop->last), @endif
                      @endforeach
                    </td>
                    <td>
                      @foreach($organization->users as $user)
                      <a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a> @if(!$loop->last), @endif
                      @endforeach
                    </td>
                    <td id="actions">
                      <a style="font-size: 25px" href="{{route('organizations.show', $organization->id)}}" class="fa fa-eye"></a> 
                      <a style="font-size: 25px" href="{{route('organizations.edit', $organization->id)}}" class="fa fa-edit"></a> 
                      <button data-route="{{route('organizations.destroy', $organization->id)}}" type="button" class="delete">
                        <i style="font-size: 25px" class="fa fa-trash"></i>
                      </button>
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