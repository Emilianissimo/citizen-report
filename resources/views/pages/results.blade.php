@extends('layouts.layout')
@section('title')
{{__('О нас')}}
@endsection
@section('SEO')
<meta name="keywords" content="Услуги, дармон, darmon service, services, servis, xizmatlar">
<meta name="description" content="О нас, Darmon Servis">
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
<section class="py-2 about">
    <div class="container py-5">
        @if(Session::has('error'))
        <div class="alert alert-danger">
            {{Session::get('error')}}
        </div>
        @endif
        <h1 class="text-center my-5">{{__('На нашем сайте вы узнаете информацию как быстро и просто получить результаты своих анализов не выходя из дома.')}}</h1>
        {{Form::open([
            'route' => ['results', app()->getLocale()],
            'target' => '_blank'
        ])}}
        <div class="row my-5 align-items-center justify-content-center">
            <div class="col-md-3">
                <input type="text" name="username" placeholder="ID" required class="form-control">
            </div>
            <div class="col-md-3">
                <input type="password" name="password" placeholder="Пароль" required class="form-control">
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-6 mt-3">
                <button class="btn w-100 btn-success">{{__('Отправить')}}</button>
            </div>
        </div>
        {{Form::close()}}
    </div>
</section>
@endsection
