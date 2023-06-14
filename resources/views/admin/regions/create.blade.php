@extends('admin.layout')

@section('title', 'Создание региона')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Регионы на сайте</h1>
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
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Добавление региона на сайт</h3>
        </div>
        {{Form::open([
          'route' => 'regions.store',
          ])}}
          @include('admin.errors')
          <div class="box-body">
            <div class="row" style="padding: 20px;">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="title_ru">Название Ру <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="title_ru" placeholder="" value="{{old('title_ru')}}" name="title_ru">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">Название Уз</label>
                    <input type="text" class="form-control" id="title_uz" placeholder="" value="{{old('title_uz')}}" name="title_uz">
                  </div>
                  <!-- <div class="form-group">
                    <label>Родительский регион</label>
                    {{Form::select('parent_id',
                      $regions, null, ['class' => 'form-control select2 select2-danger', 'data-placeholder'=>'Выберите регион']
                    )}}
                  </div> -->
              </div>
             
              <div class="col-md-12">
                  <div class="box-footer">
                      <a href="{{route('regions.index')}}" class="btn btn-default">Назад</a>
                      <button class="btn btn-success float-right">Добавить</button>
                  </div>
              </div>
          </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
</section>
@endsection
