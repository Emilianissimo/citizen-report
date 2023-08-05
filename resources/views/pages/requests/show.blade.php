@extends('layouts.layout')

@section('title')
{{$socialRequest->title}}
@endsection

@section('locales')
@foreach(config('app.available_locales') as $locale)
    <li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale, 'slug'=>$socialRequest->slug]) }}"> <img src="/images/{{$locale}}.png" @if(app()->getLocale() == $locale) class="flag-bigger" @else class="flag" @endif alt=""> </a></li>
@endforeach
@endsection

@section('content')
<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bradcam_text text-center">
                      <h3>{{$socialRequest->title}}</h3>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- bradcam_area_end -->
<!--================Blog Area =================-->
<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="d-flex justify-content-center requests-parent">

            @auth
            @if($socialRequest->author_id == Auth::user()->id || Auth::user()->is_admin || Auth::user()->id == $socialRequest->manager_id || (Auth::user()->is_org_admin && Auth::user()->organization_id == $socialRequest->manager->organization_id))
            <div class="col-md-4">
                <div class="blog_right_sidebar"style="position:sticky !important;top:150px;">
                    <aside class="single_sidebar_widget post_category_widget">
                        <form action="{{ route('client.requests.addFile', ['locale'=>app()->getLocale(), 'slug'=>$socialRequest->slug]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h4 class="widget_title">{{__('Добавить медиа')}}</h4>
                            <div class="p-3">
                                <input type="file" required name="file" class="form-control">
                                <sub>PNG, JPEG, JPG, MP4</sub>
                            </div>
                            <button class="w-100 btn btn-success">{{__('Добавить')}}</button>
                        </form>
                    </aside>
                </div>
            </div>
            @endif
            @endauth

        <div class="col-md-8 posts-list">

            <div class="dropdown pb-2 row">
                <div class="col-6">
                    <a href="{{route('client.requests.index', app()->getLocale())}}">
                        <i class="fa fa-arrow-left"></i>
                        {{__('Назад')}}
                    </a>
                </div>
            </div>

            <div class="single-post">
                <div class="feature-img">
                    <img class="img-fluid w-100" style="object-fit: cover; height: 400px" src="{{$socialRequest->firstPic()}}" alt="">
                </div>
                <div class="blog_details">
                    <h2>
                        {{$socialRequest->title}}
                    </h2>
                    <ul class="blog-info-link mt-3 mb-4 align-items-center row px-3">
                        <li><a href="#">{!!$socialRequest->getUrgency()!!}</a></li>
                        <li><i class="fa fa-comments"></i> {{$socialRequest->comments()->count()}}</li>
                        <li>@foreach($socialRequest->categories as $category){{$category->getTitle(app()->getLocale())}} @if(!$loop->last), @endif @endforeach</li>
                        <li><i style="color:rgb(145, 34, 34);" class="fa fa-map-marker" aria-hidden="true"></i> {{$socialRequest->region->getTitle(app()->getLocale())}}</li>
                        <li><i style="color:rgb(145, 34, 34);" class="fa fa-hourglass-start" aria-hidden="true"></i> {{$socialRequest->status->getTitle(app()->getLocale())}}</li>
                        <li>{{$socialRequest->created_at->format('Y/m/d h:i:s')}}</li>
                    </ul>
                    <hr>
                    {!!$socialRequest->text!!}
                    <h4 class="mt-4">
                        <b>Адрес: </b> {{$socialRequest->address}}
                    </h4>
                    <hr>
                    <h2>
                        {{__('Галерея')}}
                    </h2>
                    <hr>
                    <div class="row">
                        @forelse($socialRequest->gallery as $gallery)
                        <div class="col-md-6 my-3 p-2">
                            @auth
                            @if($socialRequest->author_id == Auth::user()->id || Auth::user()->is_admin || Auth::user()->id == $socialRequest->manager_id || (Auth::user()->is_org_admin && Auth::user()->organization_id == $socialRequest->manager->organization_id))
                            <form action="{{route('client.requests.destroyFileRequest', ['locale'=>app()->getLocale(), 'slug'=>$socialRequest->slug, 'id'=>$gallery->id])}}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="no-btn" style="background: transparent; border: 0"><i class="fa fa-times"></i></button>
                            </form>
                            @endif
                            @endauth
                            {!!$gallery->getHtmlBlock()!!}
                        </div>
                        @empty
                        <div class="col-md-12">
                            <b>{{__('Никакого медиа не было прикреплено')}}</b>
                        </div>
                        @endforelse
                    </div>
                    <hr>
                    <h2>
                        {{__('Место на карте')}}
                    </h2>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="blog-author">
                        <h5 style="color:#CCC;" class="pb-2">{{__('Автор репорта')}}</h5>
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h4>{{$socialRequest->author->name}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="blog-author">
                        <h5 style="color:#CCC;" class="pb-2">{{__('Ответственный')}}</h5>
                        <div class="media align-items-center">
                            <div class="media-body">
                                @if($socialRequest->manager)
                                <h4>{{$socialRequest->manager->name}}</h4>
                                <h5>
                                    <a href="{{route('client.posts', ['locale' => app()->getLocale(), 'id' => $socialRequest->manager->organization->id])}}">
                                        {{$socialRequest->manager->organization->title}}
                                    </a>
                                </h5>
                                @else
                                <h4>{{__('Не назначен')}}</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-details">
                <hr>
                <h2>{{__('Отчет')}}</h2>
                <hr>
                {!!$socialRequest->report ?? __('Отчета пока нет')!!}
            </div>
            <div class="comments-area">
                <h4>{{__('Комментарии')}}: {{$socialRequest->comments()->count()}}</h4>
                @foreach($comments as $comment)
                <div class="comment-list">
                    <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                        <!-- <div class="thumb">
                            <img src="img/comment/comment_1.png" alt="">
                        </div> -->
                        @if(Auth::user())
                        @if(Auth::user()->is_admin || Auth::user()->id == $comment->user_id)
                        <form action="{{route('client.requests.comment.destroy', ['locale'=> app()->getLocale(),'slug' => $socialRequest->slug, 'id' => $comment->id])}}" method="POST" class="mr-3">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-outline-danger" style="height: 100%;"><i class="fa fa-trash"></i></button>
                        </form>
                        @endif
                        @endif
                        <div class="desc">
                            <p class="comment">
                                {{$comment->text}}
                            </p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>
                                    <a href="#">{{$comment->user->name}}</a>
                                </h5>
                                <p class="date">{{$comment->created_at->diffForHumans()}} | {{$comment->created_at->format('Y-m-d h:i:s')}}</p>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
            @auth
            <div class="comment-form">
                <h4>{{__('Оставьте комментарий')}}</h4>
                <form class="form-contact comment_form" action="{{route('client.requests.comment', ['locale'=>app()->getLocale(), 'slug'=>$socialRequest->slug])}}" method="POST" id="commentForm">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea required class="form-control w-100" name="text" id="text" cols="30" rows="9"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="button button-contactForm btn_1 boxed-btn">{{__('Отправить')}}</button>
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>

        </div>
    </div>
</section>
<!--================ Blog Area end =================-->
@endsection
