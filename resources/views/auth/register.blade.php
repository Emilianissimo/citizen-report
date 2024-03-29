@extends('layouts.layout')

@section('title')
{{__('Логин')}}
@endsection

@section('locales')
@foreach(config('app.available_locales') as $locale)
    <li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale]) }}"> <img src="/images/{{$locale}}.png" @if(app()->getLocale() == $locale) class="flag-bigger" @else class="flag" @endif alt=""> </a></li>
@endforeach
@endsection

@section('content')
<div class="container">
    @include('admin.errors')
    @if(Session::has('status'))
    <div class="alert alert-danger">
        {{__('Телефон уже внесен в базу')}}
    </div>
    @endif
    <div class="row align-items-center justify-content-center">
    <div class="col-md-6 my-5">
        <div class="form-block mx-auto">
        <div class="text-center mb-5">
        <h3><strong>{{__('Регистрация')}}</strong></h3>
        <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
        </div>
        <form action="{{route('client.register', app()->getLocale())}}" method="POST">
            @csrf
            <div class="form-group first">
                <label for="name">{{__('Имя')}}</label>
                <input type="text" value="{{old('name')}}" required name="name" class="form-control" placeholder="{{__('Имя')}}" id="name">
            </div>
            <div class="form-group first">
                <label for="phone">{{__('Телефон')}}</label>
                <input type="text" value="{{old('phone')}}" required name="phone" class="form-control masked-phone" placeholder="" id="phone">
            </div>
            <div class="form-group last mb-3">
                <label for="password">{{__('Пароль')}}</label>
                <input type="password" required name="password" class="form-control" placeholder="{{__('Ваш пароль')}}" id="password">
            </div>
            <div class="form-group last mb-3">
                <label for="password_confirmation">{{__('Подтверждение пароля')}}</label>
                <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" placeholder="{{__('Подтверждение пароля')}}" id="password_confirmation">
            </div>
            
            <button class="btn btn-block btn-primary">{{__('Логин')}}</button>

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
        {{__('Напишите и мы вам поможем')}}: <a href="https://t.me/gototheforest"></a>
        <p><b>{{__('Обещаем в будущем сделать вход по СМС')}}</b></p>
      </div>
    </div>
  </div>
</div>
@endsection
