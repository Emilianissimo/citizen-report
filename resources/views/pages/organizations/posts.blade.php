@extends('layouts.layout')

@section('title')
{{'Запросы'}}
@endsection

@section('locales')
@foreach(config('app.available_locales') as $locale)
    <li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale, 'id' => $organization->id]) }}"> <img src="/images/{{$locale}}.png" @if(app()->getLocale() == $locale) class="flag-bigger" @else class="flag" @endif alt=""> </a></li>
@endforeach
@endsection

@section('content')
<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="d-flex justify-content-center">

        <div class="col-md-8 posts-list">

            <div class="dropdown pb-2 row">
                <div class="col-6">
                    <a href="{{route('client.organizations.index', app()->getLocale())}}">
                        <i class="fa fa-arrow-left"></i>
                        {{__('Назад')}}
                    </a>
                </div>
            </div>

            <div class="single-post">
                <div class="feature-img">
                    <img class="img-fluid w-100" style="object-fit: cover; height: 400px" src="{{$organization->getFile()}}" alt="">
                </div>
                <div class="blog_details">
                    <h2>
                        {{$organization->title}}
                    </h2>
                    <ul class="blog-info-link mt-3 mb-4 align-items-center row px-3">
                        <li><i class="fa fa-creadit-card"></i> {{$organization->main_card_number}}</li>
                        <li><i class="fa fa-phone"></i> {{$organization->phone}}</li>
                        <li><i class="fa fa-map-marker"></i> {{$organization->address}}</li>
                    </ul>
                    <hr>
                    {!!$organization->info!!}
                    <hr>
                    <h2>{{__('Новости')}}</h2>
                    <div>
                        @foreach($posts as $post)
                        <div class="blog_left_sidebar my-2">

                            <article class="blog_item">

                                <a class="d-inline-block" href="{{route('client.posts.show', ['locale'=>app()->getLocale(), 'id'=>$organization->id,'slug' => $post->slug])}}">
                                    <div class="blog_item_img">
                                        <img class="card-img rounded-0" src="{{$post->firstPic()}}" alt="">
                                        <a href="{{route('client.posts.show', ['locale'=>app()->getLocale(), 'id'=>$organization->id,'slug' => $post->slug])}}" class="blog_item_date">
                                            <h3>{{$post->created_at->format('d')}}</h3>
                                            <p>{{$post->created_at->format('M')}}</p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        
                                        <h2>{{$post->title}}</h2>
                                        <p>{!!Str::limit($post->text, 300)!!}</p>
                                        <ul class="blog-info-link">
                                            <li><i class="fa fa-comments"></i> {{__('Комментарии')}}: {{$post->comments()->count()}}</li>
                                            <li><i class="fa fa-clock"></i>{{$post->created_at}}</li>
                                        </ul>
                                    </div>
                                </a>
                            </article>
                        </div>
                        @endforeach
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="blog_right_sidebar"style="position:sticky !important;top:150px;">
                <aside class="single_sidebar_widget post_category_widget">
                    <div class="row align-items-center p-3">
                        <div class="col-10 my-3">
                            <a href="{{route('client.posts', ['locale'=>app()->getLocale(), 'id'=>$organization->id])}}">{{__('Новости')}}</a>
                        </div>
                        <div class="col-10 my-3">
                            <a href="{{route('client.incomes', ['locale'=>app()->getLocale(), 'id'=>$organization->id])}}">{{__('Доходы')}}</a>
                        </div>
                        <div class="col-10 my-3">
                            <a href="{{route('client.consumptions', ['locale'=>app()->getLocale(), 'id'=>$organization->id])}}">{{__('Расходы')}}</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
@endsection
