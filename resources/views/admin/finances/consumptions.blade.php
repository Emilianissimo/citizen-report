@extends('admin.layout')

@section('title', 'Расходы')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @if(Auth::user()->is_admin)
            <h1>Список организаций</h1>
            @elseif(Auth::user()->is_org_admin)
            <h1>Траты</h1>
            @endif
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @if(Auth::user()->is_admin)
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
              <li class="breadcrumb-item active">Организации</li>
              @elseif(Auth::user()->is_org_admin)
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
              <li class="breadcrumb-item active">Расходы</li>
              @endif
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
              @if(Auth::user()->is_admin == 1)
              <h3 class="card-title">Выберите организацию чтобы посмотреть её Донаты</h3>
              @elseif(Auth::user()->is_org_admin == 1)
              <h3 class="card-title">Расходы</h3>
              @endif
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if(Auth::user()->is_org_admin == 1)
                <div class="row">
                  <div class="col-md-6">
                    <a href="{{route('finances.index')}}" class="btn btn-success w-100" >Приходы</a>
                  </div>
                  <div class="col-md-6">
                    <a href="{{route('finances.consumptions')}}" class="btn btn-danger w-100">Расходы</a>
                  </div>
                </div>

                <div class="form-group mt-5" style="text-align: right">
                  <a href="{{route('finances.consumptionCreate')}}" class="btn btn-success">Добавить</a>
                </div>

                <div class="card-body">
                  <table id="example3" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Текст</th>
                      <th>Сумма</th>
                      <th>Картинка</th>
                      <th>Записал</th>
                      <th>Дата</th>
                      <th>Действия</th>
                      <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($organizationConsumptions as $consumption)
                      <tr>
                        <td>{!! $consumption->text !!}</td>
                        <td>{{$consumption->amount}}</td>
                        <td><img src="{{$consumption->getFile()}}" style="width: 200px" alt=""></td>
                        <td>{{$consumption->user->name}}</td>
                        <td>{{$consumption->created_at->toDateString()}}</td>
                        <td id="actions" style="padding: 10px;">
                          <a style="font-size: 25px" href="{{route('finances.consumptionEdit', $consumption->id)}}" class="fa fa-eye"></a>
                        </td>
                        <td><a href="{{route('finances.consumptionDestroy', $consumption->id)}}"><i style="font-size: 25px;color:red;" class="fa fa-trash"></i></a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{$organizationConsumptions->links()}}
                </div>

              @elseif(Auth::user()->is_admin == 1)
              
              <div style="overflow-x: scroll;">
                <table id="example3" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Организация</th>
                    <th>Картинка</th>
                    <th>Действия</th>
                  </tr>
                  </thead>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Организация</th>
                    <th>Картинка</th>
                    <th>Действия</th>
                  </tr>
                  </tfoot>
                  <tbody>
                    @foreach($organizations as $organization)
                    <tr>
                      <td>{{$organization->id}}</td>
                      <td>{{$organization->title}}</td>
                      <td style="text-align:center;"><img src="{{$organization->getFile()}}" style="width:100px;" alt=""></td>
                      <td id="actions" style="padding: 10px">
                        <a style="font-size: 25px" href="{{route('consumptions.listChoise', $organization->id)}}" class="fa fa-eye"></a>
                      </td>

                    @endforeach
                  </tbody>
                </table>
              </div>
              @endif
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