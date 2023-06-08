@extends('admin.layout')

@section('title', 'Изменение услуги')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Изменение на сайте</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
          <li class="breadcrumb-item"><a href="{{route('service-categories.show', $category->id)}}">{{$category->title_ru}}</a></li>
          <li class="breadcrumb-item active">Услуги</li>
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
          <h3 class="card-title">{{$service->title_ru}}: Вопросы и ответы</h3>
        </div>
        <div class="card-body" style="overflow-x: scroll;">
            <div class="row">
                <div class="col-md-12">
                    {{Form::open([
                    'route' => ['service-navs.store', ['category_id' => $category->id, 'service_id' => $service->id]],
                    ])}}
                    @include('admin.errors')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Вопрос РУ</label>
                                        <input type="text" required name="question_ru" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Вопрос УЗ</label>
                                        <input type="text" required name="question_uz" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ответ РУ</label>
                                        <textarea required name="answer_ru" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ответ УЗ</label>
                                        <textarea required name="answer_uz" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-success w-100">Добавить</button>
                        </div>
                    </div>
                    {{Form::close()}}
                    <hr>
                    <table id="example3" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Вопрос РУ</th>
                            <th>Вопрос УЗ</th>
                            <th>Ответ Ру</th>
                            <th>Ответ Уз</th>
                            <th>Действия</th>
                        </tr>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Вопрос РУ</th>
                            <th>Вопрос УЗ</th>
                            <th>Ответ Ру</th>
                            <th>Ответ Уз</th>
                            <th>Действия</th>
                        </tr>
                        </tfoot>
                        </thead>
                        <tbody>
                        @foreach($navs as $nav)
                        {{Form::open([
                            'route' => ['service-navs.update', ['category_id' => $category->id, 'service_id' => $service->id, 'id' => $nav->id]],
                            'method' => 'put'
                        ])}}
                        <tr id="nav_{{$nav->id}}">
                            <td>{{$nav->id}}</td>
                            <td><input required type="text" name="question_ru" value="{{$nav->question_ru}}" class="form-control"></td>
                            <td><input required type="text" name="question_uz" value="{{$nav->question_uz}}" class="form-control"></td>
                            <td><textarea required name="answer_ru" class="form-control">{!!$nav->answer_ru!!}</textarea></td>
                            <td><textarea required name="answer_uz" class="form-control">{!!$nav->answer_uz!!}</textarea></td>
                            <td id="actions" style="padding: 10px;">
                                <button class="btn btn-warning">
                                    <i style="font-size: 25px" class="fa fa-edit"></i>
                                </button>
                                <button data-route="{{route('service-navs.destroy', ['category_id'=>$category->id, 'service_id'=>$service->id, 'id'=> $nav->id])}}" type="button" class="delete">
                                    <i style="font-size: 25px" class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        {{Form::close()}}
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
