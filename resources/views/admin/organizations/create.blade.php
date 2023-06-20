@extends('admin.layout')

@section('title', 'Все организации')

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
          <h3 class="card-title">Добавление организации на сайт</h3>
        </div>
        {{Form::open([
          'route' => 'organizations.store',
          'files' => 'true'
          ])}}
          @include('admin.errors')
          <div class="box-body">
            <div class="row" style="padding: 20px;">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Название<span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="title" placeholder="" value="{{old('title')}}" name="title">
                  </div>
                  <div class="form-group">
                      <label>Подопечные регионы</label>
                      {{Form::select('regions[]',
                        $regions, null, ['class' => 'form-control select2', 'multiple'=>true, 'data-placeholder'=>'Выберите регионы']
                      )}}
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Лого</label>
                  <input type="file" class="form-control" name="picture">
                </div>
              </div>
              <div class="col-md-12">
                  <div class="box-footer">
                      <a href="{{route('users.index')}}" class="btn btn-default">Назад</a>
                      <button class="btn btn-success float-right">Добавить</button>
                  </div>
              </div>
            </div>
          </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
</section>
@endsection