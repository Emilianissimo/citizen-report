@extends('admin.layout')

@section('title', 'Все категории')

@section('content')
<section class="content-header">
    <div id="alert">
      <div class="alert alert-danger">
          Категория услуг удалена
      </div>
    </div>
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Категории услуг</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
              <li class="breadcrumb-item active">Категории услуг</li>
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
              <h3 class="card-title">Категории услуг</h3>
              <div class="form-group" style="text-align: right">
                <a href="{{route('service-categories.create')}}" class="btn btn-success">Добавить</a>
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
                    <th>Действия</th>
                  </tr>
                </tfoot>
                </thead>
                <tbody>
                  @foreach($categories as $category)
                  <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->title_ru}}</td>
                    <td>{{$category->title_uz}}</td>
                    <td id="actions" style="padding: 10px;">
                      <a style="font-size: 25px" href="{{route('service-categories.show', $category->id)}}" class="fa fa-eye"></a>
                      <a style="font-size: 25px" href="{{route('service-categories.edit', $category->id)}}" class="fa fa-edit"></a>
                      <button  data-route="{{route('service-categories.destroy', $category->id)}}" type="button" class="delete">
                        <i style="font-size: 25px" class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{$categories->links()}}
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
