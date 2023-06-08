@extends('layouts.layout')
@section('title')
{{__('Специалисты')}}
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
        <h2>{{__('Специалисты Darmon Servis')}}</h2>
        <div class="row">
            @foreach($doctors as $doctor)
            <div class="col-md-7 my-2 p-4 doctor-item">
                <div class="row">
                    <div class="col-md-4">
                        <a class="text-decoration-none text-dark" href="{{route('doctorDetail', ['locale'=>app()->getLocale(),'slug'=>$doctor->getSlug()])}}">
                            <img src="{{$doctor->getImage()}}" alt="" class="w-100">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <a class="text-decoration-none text-dark" href="{{route('doctorDetail', ['locale'=>app()->getLocale(),'slug'=>$doctor->getSlug()])}}">
                            <h3>{{$doctor->getTitle()}}</h3>
                        </a>
                        <a class="text-decoration-none text-dark" href="{{route('doctorCategoryDetail', ['locale'=>app()->getLocale(),'slug'=>$doctor->doctorCategory->getSlug()])}}">
                            <h3>{{$doctor->doctorCategory->getTitle()}}</h3>
                        </a>
                        <p>
                            <b><i class="fa fa-graduation-cap"></i> {{__('Образование')}}: </b> {{$doctor->getEducation()}}
                        </p>
                        <p>
                            <b><i class="fa fa-tablet"></i> {{__('Стаж')}}: </b> {{$doctor->getExperience()}}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
