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
        <div class="d-flex justify-content-center">

        <div class="col-lg-8 posts-list">

            <div class="dropdown pb-2 row">
                <div class="col-6">
                    <a href="{{route('client.requests.index', app()->getLocale())}}">
                        <i class="fa fa-arrow-left"></i>
                        {{__('Назад')}}
                    </a>
                </div>
                <div class="col-6 text-right">
                    <button class="dropdown-button">
                        <span class="ellipsis">&#8942;</span>
                    </button>
                    <div class="dropdown-menu">
                        <button class="delete-button-blog">{{__('Удалить')}}</button>
                    </div>
                </div>
            </div>

            <div class="single-post">
                <div class="feature-img">
                    <img class="img-fluid" src="{{$socialRequest->firstPic()}}" alt="">
                </div>
                <div class="blog_details">
                    <h2>
                        {{$socialRequest->title}}
                    </h2>
                    <ul class="blog-info-link mt-3 mb-4 align-items-center row px-3">
                        <li><a href="#">{!!$socialRequest->getUrgency()!!}</a></li>
                        <li><i class="fa fa-comments"></i> {{$socialRequest->comments()->count()}}</li>
                    </ul>
                    <hr>
                    {!!$socialRequest->text!!}
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
                                @else
                                <h4>{{__('Не назначен')}}</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="comments-area">
                <h4>05 Comments</h4>
                <div class="comment-list">
                    <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                        <div class="thumb">
                            <img src="img/comment/comment_1.png" alt="">
                        </div>
                        <div class="desc">
                            <p class="comment">
                                Multiply sea night grass fourth day sea lesser rule open subdue female fill which them
                                Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                            </p>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                <h5>
                                    <a href="#">Emilly Blunt</a>
                                </h5>
                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                </div>
                                <div class="reply-btn">
                                <a href="#" class="btn-reply text-uppercase">reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="comment-list">
                    <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                        <div class="thumb">
                            <img src="img/comment/comment_2.png" alt="">
                        </div>
                        <div class="desc">
                            <p class="comment">
                                Multiply sea night grass fourth day sea lesser rule open subdue female fill which them
                                Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                            </p>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                <h5>
                                    <a href="#">Emilly Blunt</a>
                                </h5>
                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                </div>
                                <div class="reply-btn">
                                <a href="#" class="btn-reply text-uppercase">reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="comment-list">
                    <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                        <div class="thumb">
                            <img src="img/comment/comment_3.png" alt="">
                        </div>
                        <div class="desc">
                            <p class="comment">
                                Multiply sea night grass fourth day sea lesser rule open subdue female fill which them
                                Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                            </p>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                <h5>
                                    <a href="#">Emilly Blunt</a>
                                </h5>
                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                </div>
                                <div class="reply-btn">
                                <a href="#" class="btn-reply text-uppercase">reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="comment-form">
                <h4>Leave a Reply</h4>
                <form class="form-contact comment_form" action="#" id="commentForm">
                    <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                placeholder="Write Comment"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="button button-contactForm btn_1 boxed-btn">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</section>
<!--================ Blog Area end =================-->
@endsection
