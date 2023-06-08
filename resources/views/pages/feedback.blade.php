<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{__('Отправить сообщение')}}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <section class="ds-feedback-page d-flex">
        <div class="ds-bg-primary-rounded"></div>
        <div class="w-50 no-ph"></div>
    </section>
    <div class="ds-feedback-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 mt-5">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    <a href="/" class="d-flex align-items-center text-decoration-none text-white fz-big back-arrow">
                        <i class="fa fa-arrow-left ds-arrow-feedback"></i>
                        <span class="ds-back-feedback">{{__('Вернуться назад')}}</span>
                    </a>
                </div>
                <div class="mt-3"></div>
                <div class="col-md-7 col-12 mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-9 col-10">
                            <form action="{{route('sendFeedback', app()->getLocale())}}" method="POST">
                                <p class="text-center fz-big" style="font-weight: 500">{{__('Заказать обратный звонок')}}</p>
                                @csrf
                                <input requireв placeholder="{{__('Имя, Фамилия')}}" name="name" type="text">
                                <br><br>
                                <input required placeholder="{{__('Номер телефона')}}" name="email_or_phone" type="text">
                                <br><br>
                                <div class="ds-radios">
                                    <label>
                                        <input value="clinic_visit" type="radio" @if($type == 'clinic_visit') checked @endif name="type">
                                        <span>{{__('Записаться на прием')}}</span>
                                    </label>
                                    <label>
                                        <input value="home_visit" type="radio" @if($type == 'home_visit') checked @endif name="type">
                                        <span>{{__('Вызвать врача на дом')}}</span>
                                    </label>
                                    <label>
                                        <input value="callback" type="radio" @if($type == 'callback') checked @endif name="type">
                                        <span>{{__('Заказать звонок')}}</span>
                                    </label>
                                </div>
                                <br>
                                <textarea name="text" placeholder="{{__('Оставить комментарий...')}}"></textarea>
                                <br><br>
                                <p class="text-center">
                                    <button class="ds-btn-simple ds-btn-primary">{{__('Отправить')}}</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-2 col-md-12">
                    <ul class="navbar-nav">
                        <li class="nav-item smaller-pad">
                            <a class="nav-link p-0" href="#">
                                <div class="circle-bg">
                                    <img src="/images/instagram.svg" alt="">
                                </div>
                            </a>
                        </li>
                        <li class="nav-item smaller-pad">
                            <a class="nav-link p-0" href="#">
                                <div class="circle-bg">
                                    <img src="/images/facebook.svg" alt="">
                                </div>
                            </a>
                        </li>
                        <li class="nav-item smaller-pad">
                            <a class="nav-link p-0" href="#">
                                <div class="circle-bg">
                                    <img src="/images/telegram.svg" alt="">
                                </div>
                            </a>
                        </li>
                        <li class="nav-item smaller-pad">
                            <a class="nav-link p-0" href="#">
                                <div class="circle-bg">
                                    <img src="/images/mail.svg" alt="">
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>