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
        @foreach($serviceCategories as $category)
            <a class="text-decoration-none" href="{{route('serviceCategoryDetail', ['locale'=>app()->getLocale(),'slug'=>$category->getSlug()])}}">
                <h3 style="font-size: 20px;" class="text-dark text-center">{{$category->getSupTitle()}}</h3>
                <h2 style="font-size: 35px;" class="text-dark text-center">{{$category->getTitle()}}</h2>
            </a>
            <br>
            <div class="row my-5">
                @foreach($category->services as $service)
                    <div class="col-md-4 p-3">
                        <a href="{{route('serviceDetail', ['locale'=>app()->getLocale(),'slug'=>$service->getSlug()])}}" class="text-decoration-none text-dark">
                            <div class="shadowed bg-white service-item">
                                <p class="p-3">{{$service->getTitle()}}</p>
                                <div class="text-right">
                                    <img src="{{$service->getIcon()}}" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>
@endsection
