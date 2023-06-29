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
              <li class="breadcrumb-item"><a href="{{route('social_requests.index')}}">Обращения</a></li>
              <li class="breadcrumb-item active">{{$socialRequest->title}}</li>
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
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <label>Статус рассмотрения</label>
                                </div>
                                <div class="col-6">
                                    @if(Auth::user()->id == $socialRequest->manager_id || Auth::user()->is_admin || Auth::user()->is_org_admin)
                                    {{Form::select('status_id',
                                        $statuses, $socialRequest->status_id, ['onchange' => '{this.form.submit()}', 'class' => 'form-control select2', 'data-placeholder'=>'Выберите статус']
                                    )}}
                                    @else
                                    <button class="btn" style="border: 2px solid {{$socialRequest->status->color}} !important">{{$socialRequest->status->title_ru}}</button>
                                    @endif
                                </div>
                            </div>                            
                        </form>
                    </div>
                  </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-8 p-3">
                  <h3>Описание проблемы</h3>
                  <hr>
                  <p>
                      {{$socialRequest->text}}
                  </p>
                  <hr>
                  <h3>Комментарии: {{$socialRequest->comments->count()}}</h3>
                  {{$comments->links()}}
                  @foreach($comments as $comment)
                  <div class="my-3" style="border-radius: 20px; box-shadow: 1px 5px 5px gray; padding: 20px">
                    <div class="row">
                      <div class="col-6">
                        <h4>{{$comment->user->name}} || {{$comment->user->phone}}</h4>
                      </div>
                      <div class="col-6 text-right">
                        <form action="{{route('social_requests.comment.destroy', ['id' => $socialRequest->id, 'comment_id' => $comment->id])}}" method="POST">
                          @csrf
                          <input type="hidden" name="_method" value="DELETE">
                          <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                      </div>
                    </div>
                    <hr>
                    <p>
                      {{$comment->text}}
                    </p>
                  </div>
                  @endforeach
                  {{$comments->links()}}
                </div>
                <div class="col-md-4 p-5" style="box-shadow: 5px 5px 5px gray; border-radius: 20px">
                    <h3>Дополнительные данные</h3>
                    <hr>
                    <ul>
                      @if(Auth::user()->is_admin || Auth::user()->is_org_admin)
                        <li>
                          <form action="{{route('social_requests.updateManager', $socialRequest->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                              <label>Ответсвенный:</label>
                              <select name="manager_id" onchange="{this.form.submit()}" class="select2 form-control">
                                <option value="">---</option>
                                @foreach($managers as $manager)
                                  <option @if($manager->id == $socialRequest->manager_id) selected @endif value="{{$manager->id}}">{{$manager->phone}} | {{$manager->name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </form>
                        </li>
                        @else
                        @if(!$socialRequest->manager_id)
                        <li>
                          <form action="{{route('social_requests.updateManager', $socialRequest->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                              <label>Ответсвенный:</label>
                              <button class="btn btn-primary">Прикрепиться</button>
                            </div>
                          </form>
                        </li>
                        @else
                        <li>
                          <form action="{{route('social_requests.updateManager', $socialRequest->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                              <label>Ответсвенный:</label>
                              {{$socialRequest->manager->name}}
                            </div>
                          </form>
                        </li>
                        @endif
                        @endif
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
                        <li>
                          <b>Дата: {{$socialRequest->created_at->format('Y/m/d h:i:s')}}</b> 
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
                    <div class="row">
                      @forelse($gallery as $gallery)
                      <div class="col-md-4">
                        {!!$gallery->getHtmlBlock()!!}
                      </div>
                      @empty
                      <div class="col-md-12">
                        <b>Никакого медиа не было прикреплено</b>
                      </div>
                      @endforelse
                    </div>
                    <hr>
                    <div style="overflow:hidden;max-width:100%;width:100%;height:300px;">
                      <div id="embed-map-canvas" style="height:100%; width:100%;max-width:100%;">
                        <iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q={{$socialRequest->coordinates}}&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                      </div>
                      <style>
                        #embed-map-canvas .text-marker{}
                        .map-generator{
                          max-width: 100%; 
                          max-height: 100%;
                          background: none;
                        }
                      </style>
                     </div>
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
