@extends('admin.layout')

@section('title', 'Все категории')

@section('content')
<section class="content-header">
    <div id="alert">
      <div class="alert alert-danger">
          Регион удален
      </div>
    </div>
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Регионы</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
              <li class="breadcrumb-item active">Регионы</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
    @include('admin.errors')
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Регионы</h3>
              <div class="form-group" style="text-align: right">
                <a href="{{route('regions.create')}}" class="btn btn-success">Добавить</a>
              </div>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Название Уз</th>
                    <th>Действия</th>
                  </tr>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Название Уз</th>
                    <!-- <th>Родительский регион</th> -->
                    <th>Действия</th>
                  </tr>
                </tfoot>
                </thead>
                <tbody>
                  @foreach($regions as $region)
                  <tr>
                    <td>{{$region->id}}</td>
                    <td>{{$region->title_ru}}</td>
                    <td>{{$region->title_uz}}</td>
                    <td id="actions" style="padding: 10px;">
                      <a style="font-size: 25px" href="{{route('regions.edit', $region->id)}}" class="fa fa-edit"></a>
                      <button  data-route="{{route('regions.destroy', $region->id)}}" type="button" class="delete">
                        <i style="font-size: 25px" class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{$regions->links()}}
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
