@extends('layouts.layout')
@section('title')
{{$service->getTitle()}}
@endsection
@section('SEO')
<meta name="keywords" content="{{$service->getSeoKeys()}}, Услуги, дармон, darmon service, services, servis, xizmatlar">
<meta name="description" content="{{$service->getSeoDesc()}}">
@endsection
@section('locales')
@php
    $localesAr = [
        'ru'=>'Русский',
        'uz'=>'O\'zbek'
        ];
@endphp
@foreach(config('app.available_locales') as $locale)
    <li><a class="dropdown-item" href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale, 'slug'=>$service->getSlug()]) }}">{{$localesAr[$locale]}}</a></li>
    @endforeach
@endsection
@section('content')
<section class="py-2">
    <div class="container py-5">
        <h2>{{$service->getTitle()}}</h2>
        <br>
        <p>{!! $service->getContent() !!}</p>
        <br><br>
        <div class="accordion" id="accordionExample">
            @foreach($service->navs as $nav)
            <div class="accordion-item">
                <h2 class="accordion-header p-3" id="heading{{$nav->id}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$nav->id}}" aria-expanded="true" aria-controls="collapse{{$nav->id}}">
                        <h3>{{$nav->getQuestion()}}</h3>
                    </button>
                </h2>
                <div id="collapse{{$nav->id}}" class="accordion-collapse collapse @if($loop->first) show @endif" aria-labelledby="heading{{$nav->id}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {!!$nav->getAnswer()!!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
