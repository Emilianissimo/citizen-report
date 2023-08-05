@extends('layouts.layout')

@section('title')
{{$post->title}}
@endsection

@section('locales')
@foreach(config('app.available_locales') as $locale)
    <li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale, 'id'=>$organization->id, 'slug'=>$post->slug]) }}"> <img src="/images/{{$locale}}.png" @if(app()->getLocale() == $locale) class="flag-bigger" @else class="flag" @endif alt=""> </a></li>
@endforeach
@endsection

@section('content')
<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bradcam_text text-center">
                      <h3>{{$post->title}}</h3>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- bradcam_area_end -->
<!--================Blog Area =================-->
<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="d-flex justify-content-center">

        <div class="col-md-8 posts-list">

            <div class="dropdown pb-2 row">
                <div class="col-6">
                    <a href="{{route('client.posts', ['locale'=>app()->getLocale(), 'id'=>$organization->id])}}">
                        <i class="fa fa-arrow-left"></i>
                        {{__('Назад')}}
                    </a>
                </div>
            </div>

            <div class="single-post">
                <div class="feature-img">
                    <img class="img-fluid w-100" style="object-fit: cover; height: 400px" src="{{$post->firstPic()}}" alt="">
                </div>
                <div class="blog_details">
                    <h2>
                        {{$post->title}}
                    </h2>
                    <ul class="blog-info-link mt-3 mb-4 align-items-center row px-3">
                        <li><i class="fa fa-comments"></i> {{$post->comments()->count()}}</li>
                        @auth
                        @if(
                            Auth::user()->is_admin ||
                            Auth::user()->organization_id == $post->organization->id
                        )
                        <li>
                            <a href="{{route('client.posts.edit', ['locale' => app()->getLocale(), 'id'=>$organization->id, 'slug' => $post->slug])}}"><i class="fa fa-edit"></i></a>
                        </li>
                        <li>
                            <form action="{{route('client.posts.destroy', ['locale' => app()->getLocale(), 'id'=>$organization->id, 'slug' => $post->slug])}}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="no-btn"><i class="fa fa-trash"></i></button>
                            </form>
                        </li>
                        @endif
                        @endauth
                        <li>{{$post->created_at->format('Y/m/d h:i:s')}}</li>
                    </ul>
                    <hr>
                    {!!$post->text!!}
                    <h2>
                        {{__('Галерея')}}
                    </h2>
                    <hr>
                    <div class="row">
                        @forelse($post->gallery as $gallery)
                        <div class="col-md-6 my-3 p-2">
                            @auth
                            @if($post->author_id == Auth::user()->id || Auth::user()->is_admin || (Auth::user()->is_org_admin && Auth::user()->organization_id == $post->user->organization_id))
                            <form action="{{route('client.posts.destroyFile', ['locale'=>app()->getLocale(), 'id'=>$organization->id,'slug'=>$post->slug, 'file_id'=>$gallery->id])}}" method="POST">
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="blog-author">
                        <h5 style="color:#CCC;" class="pb-2">{{__('Автор репорта')}}</h5>
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h4>{{$post->user->name}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="blog-author">
                        <h5 style="color:#CCC;" class="pb-2">{{__('Организация')}}</h5>
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h4>{{$post->organization->title}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="comments-area">
                <h4>{{__('Комментарии')}}: {{$post->comments()->count()}}</h4>
                @foreach($comments as $comment)
                <div class="comment-list">
                    <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                        <!-- <div class="thumb">
                            <img src="img/comment/comment_1.png" alt="">
                        </div> -->
                        @auth
                        @if(Auth::user()->is_admin || Auth::user()->id == $comment->user_id)
                        <form action="{{route('client.posts.comment.destroy', ['locale'=> app()->getLocale(), 'id'=>$organization->id, 'slug' => $post->slug, 'comment_id' => $comment->id])}}" method="POST" class="mr-3">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-outline-danger" style="height: 100%;"><i class="fa fa-trash"></i></button>
                        </form>
                        @endif
                        @endauth
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
                <form class="form-contact comment_form" action="{{route('client.posts.comment', ['locale'=>app()->getLocale(), 'id'=>$organization->id, 'slug'=>$post->slug])}}" method="POST" id="commentForm">
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
        @auth
        @if($post->author_id == Auth::user()->id || Auth::user()->is_admin || (Auth::user()->is_org_admin && Auth::user()->organization_id == $post->user->organization_id))
        <div class="col-md-4">
            <div class="blog_right_sidebar"style="position:sticky !important;top:150px;">
                <aside class="single_sidebar_widget post_category_widget">
                    <form action="{{ route('client.posts.addFile', ['locale'=>app()->getLocale(), 'id' => $organization->id,'slug'=>$post->slug]) }}" method="POST" enctype="multipart/form-data">
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
        </div>
    </div>
</section>
<!--================ Blog Area end =================-->
@endsection
