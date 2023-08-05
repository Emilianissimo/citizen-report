@extends('layouts.layout')

@section('title')
{{'Запросы'}}
@endsection

@section('locales')
@foreach(config('app.available_locales') as $locale)
    <li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale]) }}"> <img src="/images/{{$locale}}.png" @if(app()->getLocale() == $locale) class="flag-bigger" @else class="flag" @endif alt=""> </a></li>
@endforeach
@endsection

@section('content')
<div class="bradcam_area breadcam_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcam_text text-center">
                    <h3>{{__('Запросы о помощи в вашем городе')}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container p-5">
    <div class="row">
        <div class="col-md-8">
            <div>
                @foreach($requests as $req)
                <div>
                    <a href="{{route('client.requests.show', ['locale'=>app()->getLocale(), 'slug'=>$req->slug])}}">
                        <div class="card mb-3 p-2">
                            <div class="d-flex request-card">
                                <div class="card-image" style="padding: 1.25rem 0">
                                    <img style="width: 200px; height: 10rem;object-fit:cover;object-position: center center;" src="{{$req->firstPic()}}" class="card-img" alt="Изображение">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title row">
                                            <div class="col-6">
                                                {{$req->title}}
                                            </div>
                                            <div class="col-6 text-right">
                                                {!!$req->getUrgency()!!}
                                            </div>    
                                        </h5>
                                        <p class="card-text">{!! Str::limit($req->text, 150) !!}</p>
                                        <ul class="blog-info-link text-dark">
                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i>{{$req->region->getTitle(app()->getLocale())}}</li>
                                        </ul>
                                        <ul class="blog-info-link">
                                            <form action="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>app()->getLocale()]) }}" method="GET">
                                                <li class="text-dark"><i class="fa fa-list text-dark" aria-hidden="true"></i>@foreach($req->categories as $category) <label><input name="categories[]" value="{{$category->id}}" onchange="{this.form.submit()}" type="checkbox" style="width: 0; height: 0"><span class="text-dark">{{$category->getTitle(app()->getLocale())}}</span></label> @if(!$loop->last)/@endif @endforeach</li>
                                            </form>
                                        </ul>
                                        <ul class="blog-info-link text-dark">
                                            <li><i class="fa fa-hourglass-start"></i>{{__('Статус')}}: {{$req->status->getTitle(app()->getLocale())}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            {{$requests->links()}}
        </div>
        <div class="col-md-4">
            <div class="blog_right_sidebar"style="position:sticky !important;top:150px;">
                <h3>{{__('Фильтр')}}</h3>
                <aside class="single_sidebar_widget post_category_widget">
                    <form action="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>app()->getLocale()]) }}" method="GET">
                        <h4 class="widget_title">{{__('Регионы')}}</h4>
                        @foreach($regions as $region)
                        <div class="p-3">
                            <label class="w-100">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <span>{{$region->getTitle(app()->getLocale())}}</span>
                                    </div>
                                    <div class="col-2">
                                        <div class="confirm-checkbox">
                                            <input value="{{$region->id}}" type="checkbox" name="regions[]" @if(in_array($region->id, $filterRegions)) checked @endif id="confirm-new-checkbox" style="opacity:0.5;">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                        <br>
                        <h4 class="widget_title">{{__('Категории')}}</h4>
                        @foreach($categories as $category)
                        <div class="p-3">
                            <label class="w-100">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <span>{{$category->getTitle(app()->getLocale())}}</span>
                                    </div>
                                    <div class="col-2">
                                        <div class="confirm-checkbox">
                                            <input value="{{$category->id}}" type="checkbox" name="categories[]" @if(in_array($category->id, $filterCategories)) checked @endif id="confirm-new-checkbox" style="opacity:0.5;">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                        <br>
                        <h4 class="widget_title">{{__('Статусы')}}</h4>
                        @foreach($statuses as $status)
                        <div class="p-3">
                            <label class="w-100">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <span>{{$status->getTitle(app()->getLocale())}}</span>
                                    </div>
                                    <div class="col-2">
                                        <div class="confirm-checkbox">
                                            <input value="{{$status->id}}" type="checkbox" name="statuses[]" @if(in_array($status->id, $filterStatuses)) checked @endif id="confirm-new-checkbox" style="opacity:0.5;">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                        <br>
                        <h4 class="widget_title">{{__('Срочность')}}</h4>
                        @foreach($urgency as $key => $value)
                        <div class="p-3">
                            <label class="w-100">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <span>{{$value}}</span>
                                    </div>
                                    <div class="col-2">
                                        <div class="confirm-checkbox">
                                            <input value="{{$key}}" type="checkbox" name="urgency[]" @if(in_array($key, $filterUrgency)) checked @endif id="confirm-new-checkbox" style="opacity:0.5;">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                        <button class="btn btn-outline-secondary">{{__('Поиск')}} <i class="fa fa-search"></i></button>
                    </form>
                </aside>
            </div>
        </div>
    </div>
</div>
@endsection
