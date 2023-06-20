@extends('admin.layout')

@section('title')
Обращение: {{$socialRequest->title}}
@endsection

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Обращение: {{$socialRequest->title}}</h1>
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
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                  <div class="col-md-9">
                    <h3 class="card-title">Уровень срочности: {!!$socialRequest->getUrgency()!!}</h3>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <form action="{{route('social_requests.changeStatus', $socialRequest->id)}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label>Статус рассмотрения</label>
                                </div>
                                <div class="col-6">
                                    {{Form::select('status_id',
                                        $statuses, $socialRequest->status_id, ['onchange' => '{this.form.submit()}', 'class' => 'form-control select2', 'data-placeholder'=>'Выберите статус']
                                    )}}
                                </div>
                            </div>                            
                        </form>
                    </div>
                  </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <h3>Описание проблемы</h3>
                  <hr>
                  <p>
                      {{$socialRequest->text}}
                  </p>
                </div>
                <div class="col-md-4">
                    <h3>Дополнительные данные</h3>
                    <hr>
                    <ul>
                        <li>
                            <b>Обратившийся: </b> {{$socialRequest->author->name}} | {{$socialRequest->author->phone}}
                        </li>
                        <li>
                            <b>Регион: </b> {{$socialRequest->region->title_ru}}
                        </li>
                        <li>
                            <b>Адрес: </b> {{$socialRequest->address}}
                        </li>
                        <li>
                            <b>Категории: </b> 
                            @foreach($socialRequest->categories as $category)
                                {{$category->title_ru}} @if(!$loop->last), @endif
                            @endforeach
                        </li>
                    </ul>
                    <hr>
                    <h3>Галерея</h3>
                    <hr>
                    
                </div>
              </div>
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
