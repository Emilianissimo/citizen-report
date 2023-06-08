@extends('admin.layout')

@section('title')
{{$category->title_ru}}
@endsection

@section('content')
<section class="content-header">
    <div id="alert">
      <div class="alert alert-danger">
          Услуга удалена
      </div>
    </div>
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$category->title_ru}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
              <li class="breadcrumb-item"><a href="{{route('service-categories.index')}}">Категории услуг</a></li>
              <li class="breadcrumb-item active">{{$category->title_ru}}</li>
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
              <h3 class="card-title">Категория услуг: {{$category->title_ru}}</h3>
              <div class="form-group" style="text-align: right">
                <a href="{{route('service-categories.edit', $category->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
              </div>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
              <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Услуги</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{route('services.create', $category->id)}}" class="btn btn-success">Добавить</a>
                        </div>
                    </div>
                    <hr>
                    <table id="example3" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Иконка</th>
                            <th>Название</th>
                            <th>Название Уз</th>
                            <th>Действия</th>
                        </tr>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Иконка</th>
                            <th>Название</th>
                            <th>Название Уз</th>
                            <th>Действия</th>
                        </tr>
                        </tfoot>
                        </thead>
                        <tbody>
                        @foreach($category->services()->orderBy('created_at', 'DESC')->get() as $service)
                        <tr>
                            <td>{{$service->id}}</td>
                            <td><img src="{{$service->getIcon()}}" style="width: 50px; height: 50px; object-fit:cover;"></td>
                            <td>{{$service->title_ru}}</td>
                            <td>{{$service->title_uz}}</td>
                            <td id="actions" style="padding: 10px;">
                            <a style="font-size: 25px" href="{{route('services.show', ['category_id'=>$category->id, 'service'=>$service->id])}}" class="fa fa-eye" title="Вопросы и ответы"></a>
                            <a style="font-size: 25px" href="{{route('services.edit', ['category_id'=>$category->id, 'service'=>$service->id])}}" class="fa fa-edit"></a>
                            <button  data-route="{{route('services.destroy', ['category_id'=>$category->id, 'service'=>$service->id])}}" type="button" class="delete">
                                <i style="font-size: 25px" class="fa fa-trash"></i>
                            </button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
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
