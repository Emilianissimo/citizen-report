@extends('layouts.layout')

@section('title')
{{'Организации'}}
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
                    <h3>{{__('Приюты в вашем городе')}}</h3>
                    <div class="row justify-content-center my-4">
                        <div class="col-md-6">
                            <form action="{{route('client.organizations.index', app()->getLocale())}}" method="GET">
                                <select onchange="{this.form.submit()}" name="region_id" class="form-control select2">
                                    <option value="">---</option>
                                    @foreach($regions as $region)
                                    <option value="{{$region->id}}" @if($region_id == $region->id) selected @endif>{{$region->getTitle(app()->getLocale())}}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container p-5">

    <div>
        @foreach($organizations as $organization)
        <div>
            <a href="{{route('client.posts', ['locale'=>app()->getLocale(), 'id'=>$organization->id])}}">
                <div class="card mb-3 p-2">
                    <div class="d-flex profile-card">
                        <div class="" style="padding: 1.25rem 0">
                            <img style="width: 100%; height: 10rem;object-fit:cover;object-position: center center;" src="{{$organization->getFile()}}" class="card-img" alt="Изображение">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$organization->title}}</h5>
                                <p class="card-text">{!! Str::limit($organization->info, 150) !!}</p>
                                    <ul class="blog-info-link">
                                        <li><i class="fa fa-map-marker" aria-hidden="true"></i>@foreach($organization->regions as $region) {{$region->getTitle(app()->getLocale())}} @if(!$loop->last)/@endif @endforeach</li>
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{$organizations->links()}}

</div>
@endsection
