@extends('layouts.layout')
@section('title')
{{$post->getTitle()}}
@endsection
@section('SEO')
<meta name="keywords" content="{{$post->getSeoKeys()}}, Услуги, дармон, darmon service, services, servis, xizmatlar">
<meta name="description" content="{{$post->getSeoDesc()}}">
@endsection
@section('locales')
@php
    $localesAr = [
        'ru'=>'Русский',
        'uz'=>'O\'zbek'
        ];
@endphp
@foreach(config('app.available_locales') as $locale)
    <li><a class="dropdown-item" href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale, 'slug'=>$post->getSlug()]) }}">{{$localesAr[$locale]}}</a></li>
    @endforeach
@endsection
@section('content')
<section class="py-2">
    <div class="container py-5">
        <a class="text-decoration-none text-dark" href="{{route('doctorDetail', ['locale'=>app()->getLocale(),'slug'=>$post->doctor->getSlug()])}}">
            <div class="d-flex align-items-center">
                <div class="p-3">
                    <img src="{{$post->doctor->getImage()}}" style="height: 70px !important; width: 70px !important; object-fit: cover; border-radius: 100%" alt="">
                </div>
                <div class="p-3">
                    <b>{{$post->doctor->getTitle()}}</b><br>
                    <span>{{$post->doctor->doctorCategory->getTitle()}}</span>
                </div>
                <div class="p-3">
                    <p class="text-secondary m-0">
                        <i class="fa fa-calendar"></i> {{$post->created_at->format('d.m.Y')}}
                    </p>
                </div>
            </div>
        </a>
        <hr>
        <h2>{{$post->getTitle()}}</h2>
        <br>
        <p>{!! $post->getContent() !!}</p>
        <br><br>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <img src="{{$post->getImage()}}" class="w-100" alt="">
            </div>
        </div>
    </div>
</section>
@endsection
