@extends('admin.layout')

@section('title', 'Все отзывы')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Отзывы</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
              <li class="breadcrumb-item active">Отзывы</li>
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
              <h3 class="card-title">Отзывы</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Автор</th>
                  <th>Текст</th>
                  <th>Email</th>
                  <th>Телефон</th>
                  <th>Тип</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Автор</th>
                  <th>Текст</th>
                  <th>Email</th>
                  <th>Телефон</th>
                  <th>Действия</th>
                </tr>
                </tfoot>
                <tbody>
                  @foreach($feedbacks as $feedback)
                  <tr>
                    <td>{{$feedback->id}}</td>
                    <td>{{$feedback->name}}</td>
                    <td>{{$feedback->text}}</td>
                    <td>{{$feedback->email}}</td>
                    <td>{{$feedback->phone}}</td>
                    <th>{{$feedback->getType()}}</th>
                    <td>
                      {{Form::open([
                        'route'=>['feedbacks.changeStatus', $feedback->id],
                        'method'=>'put',
                        ])}}
                        {{$feedback->created_at->diffForHumans()}}
                        @if ($feedback->is_published)
                        <button class="btn btn-outline-success">
                          <i class="fa fa-toggle-on" title="Виден на сайте"></i>
                        </button>
                        @else
                        <button class="btn btn-outline-danger">
                          <i class="fa fa-toggle-off" title="Не виден на сайте (по умолчанию)"></i>
                        </button>
                        @endif
                      {{Form::close()}}

                    </td>
                    <td id="actions" style="padding: 10px;">
                     <button  data-route="{{route('feedbacks.destroy', $feedback->id)}}" type="button" class="delete">
                      <i style="font-size: 25px" class="fa fa-trash"></i>
                    </button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{$feedbacks->links()}}
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