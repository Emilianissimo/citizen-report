@extends('admin.layout')

@section('title', 'Обращения')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Обращения</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
              <li class="breadcrumb-item active">Обращения</li>
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
              <div class="form-group" style="text-align: right">
                filter goes here
                region, urgency, status
              </div>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Адрес</th>
                    <th>Срочность</th>
                    <th>Статус</th>
                    <th>Обратившийся</th>
                    <th>Ответственный</th>
                    <th>Действия</th>
                  </tr>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Адрес</th>
                    <th>Срочность</th>
                    <th>Статус</th>
                    <th>Обратившийся</th>
                    <th>Ответственный</th>
                    <th>Действия</th>
                  </tr>
                </tfoot>
                </thead>
                <tbody>
                  @foreach($requests as $r)
                  <tr>
                    <td>{{$r->id}}</td>
                    <td>{{$r->title}}</td>
                    <td>{{$r->address}}</td>
                    <td>{!!$r->getUrgency()!!}</td>
                    <td>
                      <button class="btn" style="border: 2px solid {{$r->status->color}}">
                        {{$r->status->title_ru}}
                      </button>
                    </td>
                    <td>{{$r->author->name}}</td>
                    <td>
                      @if($r->manager)
                      {{$r->manager->name}}
                      @else
                      <b class="text-danger">Не назначен!</b>
                      @endif
                    </td>
                    <td id="actions" style="padding: 10px;">
                      <a style="font-size: 25px" href="{{route('social_requests.show', $r->id)}}" class="fa fa-eye"></a>
                      <!-- <button  data-route="{{route('social_requests.show', $r->id)}}" type="button" class="delete">
                        <i style="font-size: 25px" class="fa fa-trash"></i>
                      </button> -->
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{$requests->links()}}
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
