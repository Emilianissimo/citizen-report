@extends('admin.layout')

@section('title', 'Админка')

@section('content')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class="row">
              <div class="col-md-6">
                <h1 class="m-0 text-dark">Главная</h1>
              </div>
            </div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Главная</a></li> -->
              <li class="breadcrumb-item active">Главная</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row align-items-center">
          <div class="col-md-12">
            <h2>Информация об организации</h2>
          </div>
          @if(Auth::user()->is_admin) <p><b>Вы админ, для изменения организаций, пройдите в соответствующий пункт меню</b></p>@endif
          @if(!is_null(Auth::user()->organization))
            @if(Auth::user()->is_org_admin)
              {{Form::open([
                  'route' => 'profile.updateOrganization',
                  'method' => 'put',
                  'files' => 'true',
                  'class' => 'row col-md-12'
                ])}}
                <div class="col-md-12 text-right" style="position: sticky; top: 20px; z-index: 1000">
                  <div class="form-group">
                    <button class="btn btn-warning"><i class="fa fa-edit"></i> Изменить</button>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="picture">Картинка
                      <br>
                      <img src="{{Auth::user()->organization->getFile()}}" class="w-100">
                    </label>
                    <input type="file" id="picture" name="picture" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Подопечные регионы</label>
                      {{Form::select('regions[]',
                        $regions, Auth::user()->organization->getRegionIds(), ['class' => 'form-control select2', 'multiple'=>true, 'data-placeholder'=>'Выберите регионы']
                      )}}
                  </div>
                  <div class="form-group">
                    <label>Имя организации</label>
                    <input type="text" name="title" value="{{Auth::user()->organization->title}}" required class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Основная карта</label>
                    <input type="text" name="main_card_number" value="{{Auth::user()->organization->main_card_number}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Телефон</label>
                    <input type="text" name="phone" value="{{Auth::user()->organization->phone}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Адрес</label>
                    <input type="text" name="address" value="{{Auth::user()->organization->address}}" class="form-control">
                  </div>
                </div>
                <div class="col-md-12">
                  <label>Дополнительные реквизиты</label>
                  <textarea name="info"></textarea>
                </div>
              {{Form::close()}}
            @else
                <div class="col-md-6">
                  <br>
                  <ul>
                    <li>
                      <b>Имя организации: {{Auth::user()->organization->title}}</b> 
                    </li>
                    <li>
                      <b>Основная карта: {{Auth::user()->organization->main_card_number}}</b> 
                    </li>
                    <li>
                      <b>Телефон: {{Auth::user()->organization->phone}}</b> 
                    </li>
                    <li>
                      <b>Адрес: {{Auth::user()->organization->address}}</b> 
                    </li>
                    <li>
                      <b>Подопечные регионы: </b> @foreach(Auth::user()->organization->regions as $region) {{$region->title_ru}} @if(!$loop->last)), @endif @endforeach
                    </li>
                    <li>
                      <b>Дополнительные реквизиты и информация: <br> {!!Auth::user()->organization->info!!}</b> 
                    </li>
                  </ul>
                  <p>
                    <b>Изменения могут вносить только администраторы организации.</b>
                  </p>
                </div>
                <div class="col-md-6">
                  <img src="{{Auth::user()->organization->getFile()}}" class="w-50">
                </div>
            @endif
          @endif
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
