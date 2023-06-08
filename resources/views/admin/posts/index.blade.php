@extends('admin.layout')

@section('title', 'Все посты')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Статьи врачей на сайте</h1>
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
              <h3 class="card-title">Статьи врачей</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group" style="text-align: right">
                <a href="{{route('posts.create')}}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Заголовок</th>
                  <th>Категории</th>
                  <th>Опубликовано</th>
                  <th>Автор (Врач)</th>
                  <th>Картинка</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Заголовок</th>
                  <th>Категории</th>
                  <th>Опубликовано</th>
                  <th>Автор (Врач)</th>
                  <th>Картинка</th>
                  <th>Действия</th>
                </tr>
                </tfoot>
                <tbody>
                  @foreach($posts as $post)
                  <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title_ru}}</td>
                    <td>
                      @forelse($post->categories as $category)
                        {{$category->title_ru}}@if(!$loop->last), @endif
                      @empty
                      ---
                      @endforelse
                    </td>
                    <td>{{$post->getPublished()}}</td>
                    <td>{{$post->doctor->title_ru}}</td>
                    <td><img src="{{$post->getImage()}}" style="width: 100px; height: 100px; object-fit: cover; display: block; margin: 0 auto"></td>
                    <td id="actions">
                      <a style="font-size: 25px" href="{{route('posts.edit', $post->id)}}" class="fa fa-edit"></a> 
                    <button data-route="{{route('posts.destroy', $post->id)}}" type="button" class="delete">
                      <i style="font-size: 25px" class="fa fa-trash"></i>
                    </button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{$posts->links()}}
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