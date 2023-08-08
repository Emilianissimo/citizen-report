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
          <h3 class="card-title">Добавление пользователя на сайт</h3>
        </div>
        {{Form::open([
          'route' => 'users.store',
          'files' => 'true'
          ])}}
          @include('admin.errors')
          <div class="box-body">
            <div class="row" style="padding: 20px;">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Никнейм<span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="name" placeholder="" value="{{old('name')}}" name="name">
                  </div>
                  <div class="form-group">
                    <label for="email">email<span style="color:red">*</span></label>
                    <input type="email" class="form-control" id="email" placeholder="" value="{{old('email')}}" name="email">
                  </div>
                  <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text" class="form-control" id="phone" placeholder="" value="{{old('phone')}}" name="phone">
                  </div>

                  <div class="form-group">
                    <label>Фото</label>
                    <input type="file" class="form-control" name="file">
                  </div>

                  <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" id="password" placeholder="" value="{{old('password')}}" name="password">
                  </div>
                  @if(Auth::user()->is_admin)
                  <div class="form-group">
                    <label>
                      <input type="checkbox" name="is_admin">
                      Права админа
                    </label>
                    <br>
                    <label>
                      <input type="checkbox" name="is_org_admin">
                      Права админа организации
                    </label>
                    <br>
                    <label>
                      <input type="checkbox" name="is_staff">
                      Права служащего
                    </label>
                  </div>
                  @endif
                  <div class="form-group">
                      <label>Назначить приют</label>
                      <select name="organization_id" class="form-control select2" data-placeholder="Выберите организацию">
                          <option value="set_null">пусто</option>
                          @if(Auth::user()->is_org_admin)
                            @foreach($organizations[0] as $id => $organization)
                                <option value="{{ $id }}">{{ $organization }}</option>
                            @endforeach
                          @elseif(Auth::user()->is_admin)
                            @foreach($organizations as $id => $organization)
                                <option value="{{ $id }}">{{ $organization }}</option>
                            @endforeach
                          @endif
                      </select>
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