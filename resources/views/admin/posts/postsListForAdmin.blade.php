@extends('admin.layout')

@section('title', 'Все посты')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Посты</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
              <li class="breadcrumb-item active">Статьи</li>
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
              <h3 class="card-title">Посты {{$organization->title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if(Auth::user()->is_admin == 1)
              <div class="form-group" style="text-align: right">
                <a href="{{route('posts.create')}}" class="btn btn-success">Добавить</a>
              </div>
              
              <div style="overflow-x: scroll;">
                <table id="example3" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Опубликовано</th>
                    <th>Автор</th>
                    <th>Картинка</th>
                    <th>Действия</th>
                    <th>Действия</th>
                  </tr>
                  </thead>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Заголовок</th>
                    <th>Опубликовано</th>
                    <th>Автор</th>
                    <th>Картинка</th>
                    <th>Действия</th>
                    <th>Действия</th>
                  </tr>
                  </tfoot>
                  <tbody>
                    @foreach($organizationPosts as $post)
                    <tr>
                      <td>{{$post->id}}</td>
                      <td>{{$post->title}}</td>
                      <td>{{$post->created_at->toDateString()}}</td>
                      <td>{{$post->user->name}}</td>
                      <td style="text-align:center;"><img src="{{$post->firstPic()}}" style="width:100px;" alt=""></td>
                      <td id="actions" style="padding: 10px;border:none;">
                        <a style="font-size: 25px" href="#" class="fa fa-eye"></a>
                      </td>
                      <td><a href="#"><i style="font-size: 25px;color:red;" class="fa fa-trash"></i></a></td>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{$organizationPosts->links()}}
              @endif
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