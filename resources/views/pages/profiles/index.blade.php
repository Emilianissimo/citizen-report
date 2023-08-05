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
                    <div style="width: auto;">
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
                            <a href="{{route('client.profile.index', [app()->getLocale(), Auth::user()->id])}}" class="nav-link ml-0 active">
                                <i class="mdi mdi-face-profile mr-1"></i>{{__('Заявки')}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('client.profile.profileSettings', [app()->getLocale(), Auth::user()->id])}}" class="nav-link ">
                                <i class="mdi mdi-settings-outline mr-1"></i>{{__('Настройки')}}
                            </a>
                        </li>

                       

                    </ul>

                    <div class="tab-content">
                        
                        <div class="tab-pane show active" id="requests">
                            @if($user->organization)
                            <h5 class="mb-3 mt-4 text-uppercase"><i class="mdi mdi-cards-variant mr-1"></i>{{__('Ваши задачи')}}</h5>
                            @else
                            <h5 class="mb-3 mt-4 text-uppercase"><i class="mdi mdi-cards-variant mr-1"></i>{{__('Заявки')}}</h5>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                        <th>{{__('Заголовок')}}</th>
                                        <th>{{__('Дата')}}</th>
                                        <th>{{__('Категория')}}</th>
                                        <th>{{__('Статус')}}</th>
                                        <th>{{__('Важность')}}</th>
                                        <th>{{__('Город')}}</th>
                                        <th>{{__('Заявитель')}}</th>
                                        <th>{{__('Ответственный')}}</th>
                                        <th>{{__('Ссылка')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($requests)
                                        @foreach($requests as $request)
                                        <tr>
                                            <td>{{$request->title}}</td>
                                            <td>{{$request->created_at->toDateString()}}</td>
                                            <td>{{$request->categories[0]->title_ru}}</td>
                                            @if(app()->getLocale() == 'ru')
                                            <td><span class="badge badge-pink">{{$request->status->title_ru}}</span></td>
                                            @elseif(app()->getLocale() == 'uz')
                                            <td><span class="badge badge-info">{{$request->status->title_uz}}</span></td>
                                            @endif
                                            @if($request->urgency == 0)
                                            <td><span class="badge badge-success">{{__('Низкий')}}</span></td>
                                            @elseif($request->urgency == 1)
                                            <td><span class="badge badge-info" >{{__('Средний')}}</span></td>
                                            @elseif($request->urgency == 2)
                                            <td><span class="badge badge-warning">{{__('Высокий')}}</span></td>
                                            @else
                                            <td><span class="badge badge-danger">{{__('Очень высокий')}}</span></td>
                                            @endif
                                            @if(app()->getLocale() == 'ru')
                                            <td>{{$request->region->title_ru}}</td>
                                            @else
                                            <td>{{$request->region->title_uz}}</td>
                                            @endif
                                            <td>{{$request->author->name}}</td>
                                            @if($request->manager !== null)
                                            <td>{{$request->manager->name}}</td>
                                            @else
                                            <td>{{__('Пусто')}}</td>
                                            @endif
                                            <td><a href="{{route('client.requests.show',[app()->getLocale(),$request->slug])}}">{{__('Перейти')}}</a></td>
                                        </tr>
                                        @endforeach
                                        @else

                                        <td style="color:#6c757d;" class="text-center" colspan="9">{{__('Пусто')}}</td>

                                        @endif

                                    </tbody>
                                </table>

                            </div>
                            @if($requests)
                            <nav class="blog-pagination justify-content-center d-flex">
                                <ul class="pagination">
                                    <!-- <li class="page-item">
                                        <a href="#" class="page-link" aria-label="Previous">
                                            <i class="ti-angle-left"></i>
                                        </a>
                                    </li> -->
                                    
                                    <li class="page-item">
                                        {{$requests->links()}}
                                    </li>
                                    
                                    <!-- <li class="page-item">
                                        <a href="#" class="page-link" aria-label="Next">
                                            <i class="ti-angle-right"></i>
                                        </a>
                                    </li> -->
                                    
                                </ul>
                            </nav>
                            
                            @endif

                        </div>

                        <!-- end timeline content-->
                        
                        
                        <div class="tab-pane" id="settings">
                        @if($posts)
                            @foreach($posts as $post)
                            <h5 class="mb-3 mt-4 text-uppercase"><i class="mdi mdi-cards-variant mr-1"></i>{{__('Лента')}}</h5>
                            <div class="container">
                                <a href="single-blog.html">
                                    <div class="card mb-3 p-2">
                                        <div class="d-flex profile-card">
                                            <div class="" style="padding-top: 1.25rem;padding-bottom: 1.25rem">
                                                <img style="width: 100%; height: 13rem;object-fit:cover;object-position: center center;" src="{{$post->firstPic()}}" class="card-img" alt="Изображение">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$post->title}}</h5>
                                                    <p class="card-text">{{$post->text}}</p>
                                                        <ul class="blog-info-link">
                                                            <li><a href="single-blog.html"><i class="fa fa-comments"></i>{{$post->comments()->count()}}</a></li>
                                                            <li><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>{{__('Дата')}}: {{$post->created_at->toDateString()}}</a></li>
                                                        </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            
                            
                            <nav class="blog-pagination justify-content-center d-flex">
                                <ul class="pagination">
                                    
                                    <li class="page-item">
                                        {{$posts->links()}}
                                    </li>
                                    
                                    
                                </ul>
                            </nav>
                            
                        @else

                            <div class="tab-pane" id="settings">
                                <h5 class="mb-3 mt-4 text-uppercase"><i class="mdi mdi-cards-variant mr-1"></i>{{__('Лента постов')}}</h5>
                                <div class="container">
                                    
                                        <div class="card mb-3 p-2">
                                            <div class="d-flex profile-card">
                                                
                                                <div class="col-md-12">
                                                    <div class="card-body">
                                                        <h5 style="color:#6c757d;" class="card-text text-center">{{__('Пусто')}}</h5>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                        @endif 
                        <!-- end settings content-->
                        </div> <!-- end tab-content -->
                            
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