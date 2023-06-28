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
    @if(Session::has('status'))
    <div class="alert alert-danger">
        {{__('Неверный телефон или пароль')}}
    </div>
    @endif
    <div class="row align-items-center justify-content-center">
    <div class="col-md-6 my-5">
        <div class="form-block mx-auto">
        <div class="text-center mb-5">
        <h3><strong>{{__('Логин')}}</strong></h3>
        <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
        </div>
        <form action="{{route('client.login', app()->getLocale())}}" method="POST">
            @csrf
            <div class="form-group first">
            <label for="phone">{{__('Телефон')}}</label>
            <input required type="text" name="phone" class="form-control masked-phone" placeholder="" id="phone">
            </div>
            <div class="form-group last mb-3">
            <label for="password">{{__('Пароль')}}</label>
            <input required type="password" name="password" class="form-control" placeholder="{{__('Ваш пароль')}}" id="password">
            </div>

            <div class="d-flex justify-content-between mb-5" style="align-items: center;">

                <div style="display:flex;">
                    <div>
                        <input id="remember" name="remember" style="width: 25px;" type="checkbox">
                    </div>

                    <div>
                        <label for="remember" class="control control--checkbox mb-3 mb-sm-0 p-0"><span class="caption">{{__('Запомнить меня')}}</span></label>
                    </div>
                </div>
                
                <div class="d-sm-flex  align-items-center">
                    <span class="ml-auto">
                        @if(Session::has('status'))
                        <a href="#" data-toggle="modal" data-target="#exampleModal" class="forgot-pass">{{__('Забыли пароль?')}}</a>
                        @endif
                    </span> 
                </div>
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
