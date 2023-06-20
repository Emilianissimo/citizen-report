@extends('admin.layout')

@section('title', 'Все пользователи')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Пользователи на сайте</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
          <li class="breadcrumb-item active">Пользователи</li>
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
          <h3 class="card-title">Изменение пользователя на сайте</h3>
        </div>
        {{Form::open([
          'route' => ['users.update', $user->id],
          'files' => 'true',
          'method'=>'put'
          ])}}
          @include('admin.errors')
          <div class="box-body">
            <div class="row" style="padding: 20px;">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text" class="form-control" id="phone" placeholder="" value="{{$user->phone}}" name="phone">
                  </div>
                  <div class="form-group">
                    <label for="name">Никнейм<span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="name" placeholder="" value="{{$user->name}}" name="name">
                  </div>
                  <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" id="password" placeholder="" name="password">
                  </div>
                  @if(Auth::user()->is_admin)
                  <div class="form-group">
                    <label>
                      <input type="checkbox" @if($user->id == 1) disabled @endif name="is_admin" @if($user->is_admin) checked @endif>
                      Права админа
                    </label>
                    <br>
                    <label>
                      <input type="checkbox" @if($user->id == 1) disabled @endif name="is_staff" @if($user->is_staff) checked @endif>
                      Права служащего
                    </label>
                  </div>
                  @endif
                  <div class="form-group">
                      <label>Организация</label>
                      {{Form::select('organizations[]',
                        $organiztions, $user->getOrganizationIds(), ['class' => 'form-control select2', 'multiple'=>true, 'data-placeholder'=>'Выберите ориганизации']
                      )}}
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="box-footer">
                      <a href="{{route('users.index')}}" class="btn btn-default">Назад</a>
                      <button class="btn btn-warning float-right">Изменить</button>
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