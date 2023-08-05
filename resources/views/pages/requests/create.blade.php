@extends('layouts.layout')

@section('title')
{{__('Создание запроса')}}
@endsection

@section('locales')
@foreach(config('app.available_locales') as $locale)
    <li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale]) }}"> <img src="/images/{{$locale}}.png" @if(app()->getLocale() == $locale) class="flag-bigger" @else class="flag" @endif alt=""> </a></li>
@endforeach
@endsection

@section('content')
<div class="container">
    @include('admin.errors')
    <div class="row align-items-center justify-content-center">
    <div class="col-md-6 my-5">
        <div class="form-block mx-auto">
        <div class="text-center mb-5">
        <h3><strong>{{__('Создание запроса')}}</strong></h3>
        <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
        </div>
        <form action="{{route('client.requests.store', app()->getLocale())}}" method="POST">
            @csrf
            <div class="form-group">
              <label>{{__('Регион')}}</label>
              <select name="region_id" class="select2 form-control">
                @foreach($regions as $region)
                <option value="{{$region->id}}">{{$region->getTitle(app()->getLocale())}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>{{__('Категории')}}</label>
              <select name="categories[]" multiple class="select2 form-control">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->getTitle(app()->getLocale())}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>{{__('Срочность')}}</label>
              <select name="urgency" class="select2 form-control">
                @foreach($urgency as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group first">
                <label for="title">{{__('Заголовок')}}</label>
                <input type="text" value="{{old('title')}}" required name="title" class="form-control" placeholder="{{__('Заголовок')}}" id="title">
            </div>
            <div class="form-group first">
                <label for="address">{{__('Адрес')}}</label>
                <input type="text" value="{{old('address')}}" required name="address" class="form-control" placeholder="{{__('Адрес')}}" id="address">
            </div>
            <div class="form-group last mb-3">
                <label for="coordinates">{{__('Координаты. Перейдите на карты гугла и нажмите правой кнопкой мыши на месте, где произошло проишествие. Выберите цифры и вставьте их сюда.')}}</label>
                <input type="coordinates" required name="coordinates" class="form-control" placeholder="34.2971631,69.2815243" id="coordinates">
            </div>
            
            <div class="form-group">
              <label for="">{{__('Подробное описание проблемы')}}</label>
              <textarea name="text" class="form-control" rows="10"></textarea>
            </div>
            <button class="btn btn-block btn-primary">{{__('Создать')}}</button>

        </form>
        </div>
    </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Oops, not implemented yet :c</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{__('Напишите и мы вам поможем')}}: <a href="https://t.me/gototheforest">сюда</a>
        <p><b>{{__('Обещаем в будущем сделать вход по СМС')}}</b></p>
      </div>
    </div>
  </div>
</div>
@endsection
