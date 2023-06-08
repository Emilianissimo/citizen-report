@extends('layouts.layout')
@section('title')
{{$doctor->getTitle()}}
@endsection
@section('SEO')
<meta name="keywords" content="{{$doctor->getSeoKeys()}}, Услуги, дармон, darmon service, services, servis, xizmatlar">
<meta name="description" content="{{$doctor->getSeoDesc()}}">
@endsection
@section('locales')
@php
    $localesAr = [
        'ru'=>'Русский',
        'uz'=>'O\'zbek'
        ];
@endphp
@foreach(config('app.available_locales') as $locale)
    <li><a class="dropdown-item" href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale, 'slug'=>$doctor->getSlug()]) }}">{{$localesAr[$locale]}}</a></li>
    @endforeach
@endsection
@section('content')
<section class="py-2">
    <div class="container py-5">
        <div class="d-flex align-items-center">
            <div class="p-3">
                <img src="{{$doctor->getImage()}}" style="height: 70px !important; width: 70px !important; object-fit: cover; border-radius: 100%" alt="">
            </div>
            <div class="p-3">
                <b>{{$doctor->getTitle()}}</b><br>
                <span>{{$doctor->doctorCategory->getTitle()}}</span>
            </div>
            <div class="p-3">
                <p class="text-secondary m-0">
                    {{__('Статьи')}}
                </p>
            </div>
        </div>
        <hr>
        <div class="row">
            @foreach($doctor->posts as $post)
                <div class="col-md-4 p-3">
                    <div class="shadowed bg-white p-3 post-item">
                        <div class="p-3">
                            <a class="text-decoration-none" href="{{route('postDetail', ['locale'=>app()->getLocale(),'slug'=>$post->getSlug()])}}">
                                <img src="{{$post->getImage()}}" alt="" class="w-100">
                            </a>
                            <br><br>
                            @foreach($post->categories as $category)
                            <a href="{{route('categoryDetail', ['locale'=>app()->getLocale(),'slug'=>$category->getSlug()])}}" class="btn btn-successfully">{{$category->getTitle()}}</a>
                            @endforeach
                            <a class="text-decoration-none" href="{{route('postDetail', ['locale'=>app()->getLocale(),'slug'=>$post->getSlug()])}}">
                                <p class="my-3 text text-dark">{{$post->getTitle()}}</p>
                                <p class="text-secondary m-0">
                                    <i class="fa fa-calendar"></i> {{$post->created_at->format('d.m.Y')}}
                                </p>
                            </a>
                            <a class="text-decoration-none text-dark" href="{{route('doctorDetail', ['locale'=>app()->getLocale(),'slug'=>$post->doctor->getSlug()])}}">
                                <div class="row align-items-center author mt-3">
                                    <div class="col-3">
                                        <img src="{{$post->doctor->getImage()}}" style="height: 70px !important; width: 70px !important; object-fit: cover; border-radius: 100%" alt="">
                                    </div>
                                    <div class="col-9">
                                        <b>{{$post->doctor->getTitle()}}</b><br>
                                        <span>{{$post->doctor->doctorCategory->getTitle()}}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
