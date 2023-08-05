@extends('layouts.layout')

@section('title')
{{'Запросы'}}
@endsection

@section('locales')
@foreach(config('app.available_locales') as $locale)
    <li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale, 'id' => $organization->id]) }}"> <img src="/images/{{$locale}}.png" @if(app()->getLocale() == $locale) class="flag-bigger" @else class="flag" @endif alt=""> </a></li>
@endforeach
@endsection

@section('content')

    <div class="mx-5 mt-5">
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card-box text-center">

                    <img src="{{$organization->getFile()}}" class="rounded-circle avatar-xl img-thumbnail" alt="profile-image">

                    <h4 class="mb-0">{{$organization->title}}</h4>

                    <div class="text-left mt-3">
                        
                        <p class="text-muted mb-2 font-13"><strong>{{__('Название')}}:</strong> <span class="ml-2">{{$organization->title}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>{{__('Телефон')}} :</strong><span class="ml-2">{{$organization->phone}}</span></p>

                        @if($organization)
                        @foreach($organization->regions as $region)
                            <p class="text-muted mb-1 font-13"><strong>{{__('Город')}} :</strong> <span class="ml-2">{{$region->getTitle(app()->getLocale())}}</span></p>
                        @endforeach
                        @endif
                        <p class="text-muted mb-2 font-13"><strong>{{__('Адрес')}} :</strong><span class="ml-2">{{$organization->address}}</span></p>
                    </div>
                    
                        
                        <ul class="social-list list-inline mt-3 mb-0">
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-purple text-purple"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="fab fa-google"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="fab fa-github"></i></a>
                        </li>
                        </ul>

                </div>
                 <!-- end card-box -->
                
                <div class="card-box">
                    <h4 class="header-title">{{__('Реквизиты')}}</h4>

                    <p class="text-muted mb-2 font-13"><strong>{{__('Номер карты')}} :</strong> <span class="ml-2">{{$organization->main_card_number}}</span></p>

                </div> 
                <!-- end card-box-->
                
            </div> <!-- end col-->

            <div class="col-lg-8 col-xl-8">
                <div class="card-box">
                    <ul class="nav nav-pills navtab-bg">

                        <li class="nav-item">
                            <a href="{{route('client.posts', [app()->getLocale(),$organization->id])}}"class="nav-link ml-0 active">
                                <i class="mdi mdi-settings-outline mr-1"></i>{{__('Лента')}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('client.organization.getRequests', [app()->getLocale(),$organization->id])}}"class="nav-link">
                                <i class="mdi mdi-face-profile mr-1"></i>{{__('Заявки')}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('client.organization.getIncomes', [app()->getLocale(),$organization->id])}}"class="nav-link">
                                <i class="mdi mdi-settings-outline mr-1"></i>{{__('Приходы')}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('client.organization.getConsumptions', [app()->getLocale(),$organization->id])}}"class="nav-link">
                                <i class="mdi mdi-settings-outline mr-1"></i>{{__('Расходы')}}
                            </a>
                        </li>

                    </ul>

                    <div class="tab-content ">

                        <div class="tab-pane  show active" id="settings">
                            @if($posts)
                            <h5 class="mb-3 mt-4 text-uppercase"><i class="mdi mdi-cards-variant mr-1"></i>{{__('Лента постов')}}</h5>
                                @foreach($posts as $post)
                                <div class="container">
                                    <a href="{{route('client.posts.show', ['locale'=>app()->getLocale(), 'id'=>$organization->id,'slug' => $post->slug])}}">
                                        <div class="card mb-3 p-2">
                                            <div class="d-flex profile-card">
                                                <div class="" style="padding-top: 1.25rem;padding-bottom: 1.25rem">
                                                    <img style="width: 100%; height: 13rem;object-fit:cover;object-position: center center;" src="{{$post->firstPic()}}" class="card-img" alt="Изображение">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$post->title}}</h5>
                                                        <p class="card-text">{!! $post->text !!}</p>
                                                            <ul class="blog-info-link">
                                                                <li><a href="{{route('client.posts.show', ['locale'=>app()->getLocale(), 'id'=>$organization->id,'slug' => $post->slug])}}"><i class="fa fa-comments"></i>{{$post->comments()->count()}}</a></li>
                                                                <li><a href="{{route('client.posts.show', ['locale'=>app()->getLocale(), 'id'=>$organization->id,'slug' => $post->slug])}}"><i class="fa fa-calendar" aria-hidden="true"></i>Дата: {{$post->created_at->toDateString()}}</a></li>
                                                            </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                                
                                @if($posts)
                                <nav class="blog-pagination justify-content-center d-flex">
                                    <ul class="pagination">
                                        {{$posts->links()}}
                                    </ul>
                                </nav>
                                @endif
                                
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

                        </div> <!-- end tab-content -->
                        
                        <div class="tab-pane" id="requests">

                            <div class="table-responsive">
                                <table class="table table-borderless mb-0 mt-3">
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
                                    <tbody class="requests-tbody">
                                        @if($requests)
                                        @foreach($requests as $request)
                                        <tr class="requests-tr">
                                            <td>{{$request->title}}</td>
                                            <td>{{$request->created_at->toDateString()}}</td>
                                            @if(app()->getLocale() == 'ru')
                                            <td>{{$request->categories[0]->title_ru}}</td>
                                            @else
                                            <td>{{$request->categories[0]->title_uz}}</td>
                                            @endif
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
                                            <td>пусто</td>
                                            @endif
                                            <td><a href="{{route('client.requests.show',[app()->getLocale(),$request->slug])}}">{{__('Перейти')}}</a></td>
                                        </tr>
                                        @endforeach
                                        @else

                                        <td style="color:#6c757d;" class="text-center" colspan="9">пусто</td>

                                        @endif

                                    </tbody>
                                </table>

                                @if($requests)
                                <nav class="blog-pagination justify-content-center d-flex">
                                    <ul class="pagination">
                                        {{$requests->links()}}
                                    </ul>
                                </nav>
                                @endif

                            </div>

                        </div>

                        <!-- end timeline content-->
                        

                            <div class="tab-pane" id="incomes">
                                
                                <section class="content mt-2">
                                    <div class="row">
                                        <div class="col-12">
                                            
                                                
                                                <!-- /.card-header -->
                                                <div class="table-responsive">

                                                    <table id="example3" class="table table-borderless mb-0">
                                                        <thead class="thead-light">
                                                        <tr>
                                                        <th>От кого</th>
                                                        <th>Текст</th>
                                                        <th>Сумма</th>
                                                        <th>Картинка</th>
                                                        <th>Дата</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($incomes as $income)
                                                        <tr>
                                                            <td>{!!$income->from!!}</td>
                                                            <td>{!!$income->text!!}</td>
                                                            <td>{{$income->amount}}</td>
                                                            <td><img src="{{$income->getFile()}}" style="width: 200px" alt=""></td>
                                                            <td>{{$income->created_at->toDateString()}}</td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            
                                        <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </section>

                                @if($incomes)
                                <nav class="blog-pagination justify-content-center d-flex">
                                    <ul class="pagination">
                                        {{$incomes->links()}}
                                    </ul>
                                </nav>
                                @endif

                            </div>

                            <div class="tab-pane" id="consumptions">
                                
                                <section class="content mt-2">
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="table-responsive">
                                                    <table id="example3" class="table table-borderless mb-0">
                                                        <thead>
                                                        <tr>
                                                        <th>Текст</th>
                                                        <th>Сумма</th>
                                                        <th>Картинка</th>
                                                        <th>Дата</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($consumptions as $consumption)
                                                        <tr>
                                                            <td>{!!$consumption->text!!}</td>
                                                            <td>{{$consumption->amount}}</td>
                                                            <td><img src="{{$consumption->getFile()}}" style="width: 200px" alt=""></td>
                                                            <td>{{$consumption->created_at->toDateString()}}</td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                            </div>

                                        <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </section>

                                @if($consumptions)
                                <nav class="blog-pagination justify-content-center d-flex">
                                    <ul class="pagination">
                                        <!-- <li class="page-item">
                                            <a href="#" class="page-link" aria-label="Previous">
                                                <i class="ti-angle-left"></i>
                                            </a>
                                        </li> -->
                                        <!-- <li class="page-item">
                                            <a href="#" class="page-link">1</a>
                                        </li> -->
                                        {{$consumptions->links()}}
                                        <!-- <li class="page-item active">
                                            <a href="#" class="page-link">2</a>
                                        </li> -->
                                        <!-- <li class="page-item">
                                            <a href="#" class="page-link" aria-label="Next">
                                                <i class="ti-angle-right"></i>
                                            </a>
                                        </li> -->
                                    </ul>
                                </nav>
                                @endif

                            </div>
                            
                    </div> 

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
