@extends('layouts.layout')

@section('title')
Shelters
@endsection

@section('locales')
@foreach(config('app.available_locales') as $locale)
    <li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale]) }}"> <img src="/images/{{$locale}}.png" @if(app()->getLocale() == $locale) class="flag-bigger" @else class="flag" @endif alt=""> </a></li>
@endforeach
@endsection

@section('content')
<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider slider_bg_1 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="slider_text">
                        <h3>{{__('Животное в опасности?')}} <br> <span>Shelters</span></h3>
                        <p>{{__('Ассоцация помощи бездомным животным.')}}</p>
                        <!-- <a href="contact.html" class="boxed-btn4">Contact Us</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="dog_thumb d-none d-lg-block">
            <img src="/theme/img/banner/dog.png" alt="">
        </div>
    </div>
</div>
<!-- slider_area_end -->

<!-- service_area_start  -->
<div class="service_area">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-7 col-md-10">
                <div class="section_title text-center mb-95">
                    <h3>{{__("Наша цель")}}</h3>
                    <p>{{__('Забота о каждом бездомным животным.')}}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="single_service">
                        <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                            <div class="service_icon">
                                <img src="/theme/img/service/service_icon_1.png" alt="">
                            </div>
                        </div>
                        <div class="service_content text-center">
                        <h3>{{__('Передержка')}}</h3>
                        <p>{{__('Наши шелтеры находят животных и дают им кров, медицину и питание')}}</p>
                        </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_service active">
                        <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                            <div class="service_icon">
                                <img src="/theme/img/service/service_icon_2.png" alt="">
                            </div>
                        </div>
                        <div class="service_content text-center">
                        <h3>{{__('Подыскивание новых хозяев')}}</h3>
                        <p>{{__('Каждому питомцу подбираются добрые руки и отслеживается процесс адаптации')}}</p>
                        </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_service">
                        <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                            <div class="service_icon">
                                <img src="/theme/img/service/service_icon_3.png" alt="">
                            </div>
                        </div>
                        <div class="service_content text-center">
                        <h3>{{__('Помощь по вашим заявкам')}}</h3>
                        <p>{{__('Есть о чем сообщить? Нужна защита животному? Оно ходит по улицам и ведет себя агрессивно? Создайте запрос в специальной форме!')}}</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- service_area_end -->

<!-- pet_care_area_start  -->
<div class="pet_care_area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-6">
                <div class="pet_thumb">
                    <img src="/theme/img/about/pet_care.png" alt="">
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1 col-md-6">
                <div class="pet_info">
                    <div class="section_title">
                        <h3><span>{{__('Животное')}} </span> <br>
                            {{__('в опасности?')}}</h3>
                        <p>{{__('С животным плохо обращаются хозяева? Оно бродит по улицам и может быть опасно? Стая собак? Сообщите шелтерам в вашем регионе!')}}</p>
                        <a href="#" class="boxed-btn3">{{__('Сообщить!')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- pet_care_area_end  -->

<!-- adapt_area_start  -->
<div class="adapt_area">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-5">
                <div class="adapt_help">
                    <div class="section_title">
                        <h3><span>{{__('Каждое животное')}}</span>
                            {{__('Имеет право жить')}}</h3>
                        <p>{{__('Не дадим службам и другим травить и убивать животных!')}}</p>
                        <a href="#report-place" class="boxed-btn3">{{__('Сообщить!')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="adapt_about">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="single_adapt text-center">
                                <img src="/theme/img/adapt_icon/1.png" alt="">
                                <div class="adapt_content">
                                    <h3 class="counter">{{$organizations->count()}}</h3>
                                    <p>{{__('Организаций')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="single_adapt text-center">
                                <img src="/theme/img/adapt_icon/3.png" alt="">
                                <div class="adapt_content">
                                    <h3><span class="counter">{{$requests->count()}}</span></h3>
                                    <p>{{__("Заявок")}}</p>
                                </div>
                            </div>
                            <div class="single_adapt text-center">
                                <img src="/theme/img/adapt_icon/2.png" alt="">
                                <div class="adapt_content">
                                    <h3><span class="counter">{{$users->count()}}</span></h3>
                                    <p>{{__('Неравнодушных')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- adapt_area_end  -->

<!-- team_area_start  -->
    <div class="team_area">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-6 col-md-10">
                    <div class="section_title text-center mb-95">
                        <h3>{{__('Организации')}}</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($organizationsSet as $organization)
                <div class="col-lg-4 col-md-6">
                    <div class="single_team">
                        <a href="{{route('client.posts', ['locale'=>app()->getLocale(), 'id'=>$organization->id])}}">
                            <div class="thumb">
                                <img src="{{$organization->getFile()}}" alt="">
                            </div>
                            <div class="member_name text-center">
                                <div class="mamber_inner">
                                    <h4>{{$organization->title}}</h4>
                                    <p>{{$organization->phone}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- report area  -->

<!-- testmonial_area_start  -->
<div class="testmonial_area">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-6 col-md-10">
                <div class="section_title text-center mb-95">
                    <h3>{{__('Цитаты умных людей')}}</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="textmonial_active owl-carousel">
                    <div class="testmonial_wrap">
                        <div class="single_testmonial d-flex align-items-center">
                            <div class="test_thumb">
                                <img src="/theme/img/testmonial/o085.jpg" alt="">
                            </div>
                            <div class="test_content">
                                <h4>{{__('Иеремия Бентам')}}</h4>
                                <span>{{__('Английский философ')}}</span>
                                <p>{{__('Следует спрашивать не о том, могут ли животные мыслить или говорить, а о том, могут ли они страдать.')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="testmonial_wrap">
                        <div class="single_testmonial d-flex align-items-center">
                            <div class="test_thumb">
                                <img src="/theme/img/testmonial/768.jpg" alt="">
                            </div>
                            <div class="test_content">
                                <h4>{{__('Карел Чапек')}}</h4>
                                <span>{{__('Писатель')}}</span>
                                <p>{{__('Когда животное бьют, глаза его приобретают человеческое выражение. Сколько же должен был выстрадать человек, прежде чем стал человеком.')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="testmonial_wrap">
                        <div class="single_testmonial d-flex align-items-center">
                            <div class="test_thumb">
                                <img src="/theme/img/testmonial/123.jpg" alt="">
                            </div>
                            <div class="test_content">
                                <h4>{{__('Джером Клапка Джером')}}</h4>
                                <span>{{__('Писатель')}}</span>
                                <p>{{__('Собака — очень необычное создание; она никогда не пристает с расспросами, какое у тебя настроение, ее не интересует, богат ты или беден, глуп или умен, грешник или святой. Ты ее друг. Ей этого достаточно.')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- testmonial_area_end  -->
@endsection