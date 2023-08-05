@extends('layouts.layout')

@section('title')
{{__('Создание запроса')}}
@endsection

@section('locales')
@foreach(config('app.available_locales') as $locale)
    <li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale, 'id'=>Auth::user()->id]) }}"> <img src="/images/{{$locale}}.png" @if(app()->getLocale() == $locale) class="flag-bigger" @else class="flag" @endif alt=""> </a></li>
@endforeach
@endsection

@section('content')



    <div class="mx-5 my-5">
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card-box text-center">
                    <div calss="col-md-8">
                        <img src="{{$user->getFile()}}" style="width:15rem;height:15rem;object-position: center center;object-fit: cover;" class="rounded-circle avatar-xl img-thumbnail" alt="profile-image">
                        <h4 class="mb-0">{{$user->name}}</h4>
                    </div>

                    <div class="text-left mt-3">
                        
                        <h4 class="font-13 text-uppercase">{{__('Статус')}} :</h4>
                       
                        @if($user->is_admin)
                        <p class="text-muted font-13 mb-3">
                            {{__('Супер админ')}}
                        </p>
                        @elseif($user->is_staff)
                        <p class="text-muted font-13 mb-3">
                            {{__('Сотрудник')}}
                        </p>
                        @elseif($user->is_org_admin)
                        <p class="text-muted font-13 mb-3">
                            {{__('Админ')}}
                        </p>
                        @else
                        <p class="text-muted font-13 mb-3">
                            {{__('Пользователь')}}
                        </p>
                        @endif
                       
                        
                        <p class="text-muted mb-2 font-13"><strong>{{__('Имя')}} :</strong> <span class="ml-2">{{$user->name}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>{{__('Телефон')}} :</strong><span class="ml-2">{{$user->phone}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{$user->email}}</span></p>

                    </div>

                </div>
            </div>

            <div class="col-lg-8 col-xl-8">
                <div class="card-box">
                    <ul class="nav nav-pills navtab-bg">

                        <li class="nav-item">
                            <a href="{{route('client.profile.index', [app()->getLocale(), Auth::user()->id])}}" class="nav-link">
                                <i class="mdi mdi-face-profile mr-1"></i>{{__('Заявки')}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('client.profile.profileSettings', [app()->getLocale(), Auth::user()->id])}}" class="nav-link  ml-0 active">
                                <i class="mdi mdi-settings-outline mr-1"></i>{{__('Настройки')}}
                            </a>
                        </li>

                       

                    </ul>

                    <div class="tab-content">                        
                
                            <div class="tab-pane show active" id="incomes">
                                
                                <section class="content-header">
                                    <div class="container-fluid">
                                        <div class="row mb-2">

                                        </div>
                                    </div><!-- /.container-fluid -->
                                </section>
                                <section class="content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                <h3 class="card-title">{{__('Настройки профиля')}}</h3>
                                                </div>
                                                
                                                <form action="{{route('client.profile.update', [app()->getLocale(), $user->id ])}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="box-body">
                                                    <div class="row" style="padding: 20px;">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="phone">{{__('Телефон')}}</label>
                                                                <input type="text" class="form-control masked-phone" id="phone" placeholder="" value="{{$user->phone}}" name="phone">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">E-mail<span style="color:red">*</span></label>
                                                                <input type="email" class="form-control" id="email" placeholder="" value="{{$user->email}}" name="email">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">{{__('Имя')}}<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" id="name" placeholder="" value="{{$user->name}}" name="name">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="picture">{{__('Фото')}}<span style="color:red">*</span></label>
                                                                <div class="col-md-6 my-3" style="position: relative;">
                                                                    <img class="w-100" src="{{$user->getFile()}}" alt="">
                                                                    <div class="trash-icon" style="position: absolute;top: 5px;right: 20px;">
                                                                        <a href="{{route('client.profile.profilePictureDestroy', [app()->getLocale(), $user->id])}}"><i style="font-size: 25px;color:red;" class="fa fa-trash"></i></a>
                                                                    </div>
                                                                </div>
                                                                <input type="file" class="form-control" name="picture">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="password">{{__('Пароль')}}</label>
                                                                <input type="password" class="form-control" id="password" placeholder="" name="password">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="box-footer">
                                                                <!-- <a href="{{route('users.index')}}" class="btn btn-default">Назад</a> -->
                                                                <button class="btn btn-warning float-right">{{__('Изменить')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </section>

                            </div>
                            
                    </div> <!-- end card-box-->

            </div> <!-- end col -->
        </div>
    </div>
    </div>


    <style>

    .nav-link.active{
        background-color: #ed5b0d !important;
    }

        @media (max-width: 576px) {
            .profile-card {
                display: block !important;
            }
            .card-body{
                padding: 2rem 0 0 0 ;
            }

            .nav-pills li{
                margin-top: 1.5rem ;
            }

            .navtab-bg li>a {
                background-color: #f7f7f7;
                margin: 0 5px !important;
            }
        }
    </style>

@endsection