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
                  <h1>Посты</h1>
                  <div class="row">
                      <div class="col-6">
                          <a class="w-100 btn btn-outline-success" href="{{route('organizations.incomes', $organization->id)}}">Доходы</a>
                      </div>
                      <div class="col-6">
                          <a class="w-100 btn btn-outline-danger" href="{{route('organizations.consumptions', $organization->id)}}">Траты</a>
                      </div>
                  </div>
              </div>
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Название</th>
                  <th>Автор</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>Название</th>
                  <th>Автор</th>
                  <th>Действия</th>
                </tr>
                </tfoot>
                <tbody>
                  @foreach($posts as $post)
                  <tr>
                    <td><a href="{{route('client.posts.show', ['locale'=>app()->getLocale(), 'id'=>$organization->id, 'slug' => $post->slug])}} " target="_blank">{{$post->title}}</a></td>
                    <td>
                        {{$post->user->name}}
                    </td>
                    <td id="actions">
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