@extends('layouts.layout')
@section('title')
{{__('Услуги')}}
@endsection
@section('SEO')
<meta name="keywords" content="Услуги, дармон, darmon service, services, servis, xizmatlar">
<meta name="description" content="Услуги Darmon Servis">
@endsection
@section('locales')
@php
    $localesAr = [
        'ru'=>'Русский',
        'uz'=>'O\'zbek'
        ];
@endphp
@foreach(config('app.available_locales') as $locale)
    <li><a class="dropdown-item" href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale]) }}">{{$localesAr[$locale]}}</a></li>
    @endforeach
@endsection
@section('content')
<section class="py-2">
    <div class="container py-5">
    <h3 style="font-size: 20px;" class="text-dark text-center">{{__('Все о клинике')}}</h3>
        <h2 style="font-size: 35px;" class="text-dark text-center">{{__('Статьи о здоровье')}}</h2>
        <div class="row">
            @foreach($posts as $post)
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
