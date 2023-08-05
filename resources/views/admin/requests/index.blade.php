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
                <form action="{{route('social_requests.index')}}" method="GET">
                  <div class="row">
                    <div class="col-md-12 mb-2">
                      <button class="btn btn-success w-100">Поиск</button>
                    </div>
                    <div class="col-md-3">
                      {{Form::select('regions[]',
                        $regions, $filterRegions, ['class' => 'form-control select2', 'multiple'=>true, 'data-placeholder'=>'Выберите регион']
                      )}}
                    </div>
                    <div class="col-md-3">
                      {{Form::select('categories[]',
                        $categories, $filterCategories, ['class' => 'form-control select2', 'multiple'=>true, 'data-placeholder'=>'Выберите категории']
                      )}}
                    </div>
                    <div class="col-md-3">
                      {{Form::select('statuses[]',
                        $statuses, $filterStatuses, ['class' => 'form-control select2', 'multiple'=>true, 'data-placeholder'=>'Выберите статусы']
                      )}}
                    </div>
                    <div class="col-md-3">
                      {{Form::select('urgency[]',
                        $urgency, $filterUrgency, ['class' => 'form-control select2', 'multiple'=>true, 'data-placeholder'=>'Выберите срочность']
                      )}}
                    </div>
                    <div class="col-md-12">
                      <label>
                        <input type="checkbox" @if($filterMine) checked @endif name="mine">
                        Только мои
                      </label>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Дата</th>
                    <th>Регион</th>
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
                    <th>Дата</th>
                    <th>Регион</th>
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
                    <td>{{$r->created_at}}</td>
                    <td>{{$r->region->title_ru}}</td>
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
