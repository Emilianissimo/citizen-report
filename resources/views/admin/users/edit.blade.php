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
                    <label for="email">Email<span style="color:red">*</span></label>
                    <input type="email" class="form-control" id="email" placeholder="" value="{{$user->email}}" name="email">
                  </div>
                  
                    <div class="form-group">
                      <label>Фото<span style="color:red">*</span></label>
                      <div class="col-md-4 my-3" style="position:relative;">
                        <img src="{{$user->getFile()}}" alt="" class="w-100">
                        <div class="trash-icon" style="position: absolute;top: 5px;right: 20px;">
                            <a href="{{route('client.profile.profilePictureDestroy', [app()->getLocale(), $user->id])}}"><i style="font-size: 25px;color:red;" class="fa fa-trash"></i></a>
                        </div>
                      </div>
                      <input type="file" class="form-control" name="file">
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
                      <input type="checkbox" @if($user->id == 1) disabled @endif name="is_org_admin" @if($user->is_org_admin) checked @endif>
                      Права админа организации
                    </label>
                    <br>
                    <label>
                      <input type="checkbox" @if($user->id == 1) disabled @endif name="is_staff" @if($user->is_staff) checked @endif>
                      Права служащего
                    </label>
                  </div>
                  @elseif(Auth::user()->is_org_admin)
                    <div class="form-group">
                      <label>
                        <input type="checkbox" @if($user->id == 1) disabled @endif name="is_staff" @if($user->is_staff) checked @endif>
                        Права служащего
                      </label>
                    </div>
                  @endif
                  <div class="form-group">
                      <label>Организация</label>
                      <select name="organization_id" class="form-control select2" data-placeholder="Выберите организацию">
                          <option value="set_null" @if(is_null($user->organization_id)) selected @endif>пусто</option>
                          @if(Auth::user()->is_org_admin)
                            @foreach($organizations[0] as $id => $organization)
                                <option value="{{ $id }}" @if($id === $user->organization_id) selected @endif>{{ $organization }}</option>
                            @endforeach
                          @elseif(Auth::user()->is_admin)
                            @foreach($organizations as $id => $organization)
                                <option value="{{ $id }}" @if($id === $user->organization_id) selected @endif>{{ $organization }}</option>
                            @endforeach
                          @endif
                      </select>
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