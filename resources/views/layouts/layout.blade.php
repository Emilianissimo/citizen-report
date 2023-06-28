<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="/theme/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="/theme/css/bootstrap.min.css">
    <link rel="stylesheet" href="/theme/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/theme/css/magnific-popup.css">
    <link rel="stylesheet" href="/theme/css/font-awesome.min.css">
    <link rel="stylesheet" href="/theme/css/themify-icons.css">
    <link rel="stylesheet" href="/theme/css/nice-select.css">
    <link rel="stylesheet" href="/theme/css/flaticon.css">
    <link rel="stylesheet" href="/theme/css/gijgo.css">
    <link rel="stylesheet" href="/theme/css/animate.css">
    <link rel="stylesheet" href="/theme/css/slicknav.css">
    <link rel="stylesheet" href="/theme/css/style.css">
    <link rel="stylesheet" href="/theme/css/custom-style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>

        <!-- Кнопка для открытия модального окна -->
        <!-- <button onclick="openModal()">Открыть модальное окно</button> -->

        <!-- Модальное окно -->
        <!-- <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2 class="text-center py-3">Выберите ваш город</h2>
                <div>
                    <select class="citySelect form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="null">Выберите ваш город</option>
                        <option value="Бухара">Бухара</option>
                        <option value="Ташкент">Ташкент</option>
                        <option value="Самарканд">Самарканд</option>
                    </select>
                </div>

                <div style="display: flex;justify-content: end;margin-top: 2rem;" >
                    <button type="button" class="city-button registration-btn btn btn-primary">Выбрать</button>
                </div>

            </div>
        </div> -->

    <header>
        <div class="header-area">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-3">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a  href="index.html">{{__('Главная')}}</a></li>
                                        <li><a href="blog.html">{{__('Заявки')}}</a></li>
                                        <li><a href="shelters.html">{{__('Приюты')}}</a></li>
                                        <li><a href="profile.html">{{__('Профиль')}}</a></li>
                                        <li><a href="profile.html">{{__('Логин')}}</a></li>
                                        <li><a href="profile.html">{{__('Регистрация')}}</a></li>
                                        @yield('locales')
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <!-- footer_start  -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <!-- <div class="footer_widget">
                            <h3 class="footer_title">
                                Contact Us
                            </h3>
                            <ul class="address_line">
                                <li>+555 0000 565</li>
                                <li><a href="#">Demomail@gmail.Com</a></li>
                                <li>700, Green Lane, New York, USA</li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="col-xl-3  col-md-6 col-lg-3">
                        <!-- <div class="footer_widget">
                            <h3 class="footer_title">
                                Our Servces
                            </h3>
                            <ul class="links">
                                <li><a href="#">Pet Insurance</a></li>
                                <li><a href="#">Pet surgeries </a></li>
                                <li><a href="#">Pet Adoption</a></li>
                                <li><a href="#">Dog Insurance</a></li>
                                <li><a href="#">Dog Insurance</a></li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="col-xl-3  col-md-6 col-lg-3">
                        <!-- <div class="footer_widget">
                            <h3 class="footer_title">
                                Quick Link
                            </h3>
                            <ul class="links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms of Service</a></li>
                                <li><a href="#">Login info</a></li>
                                <li><a href="#">Knowledge Base</a></li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3 ">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#" class="text-dark text-bold">
                                    Shelters
                                </a>
                            </div>
                            <p class="address_text"> Everywhere
                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-pinterest"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer_end  -->


    <!-- JS here -->
    <script src="/theme/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="/theme/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="/theme/js/popper.min.js"></script>
    <script src="/theme/js/bootstrap.min.js"></script>
    <script src="/theme/js/owl.carousel.min.js"></script>
    <script src="/theme/js/isotope.pkgd.min.js"></script>
    <script src="/theme/js/ajax-form.js"></script>
    <script src="/theme/js/waypoints.min.js"></script>
    <script src="/theme/js/jquery.counterup.min.js"></script>
    <script src="/theme/js/imagesloaded.pkgd.min.js"></script>
    <script src="/theme/js/scrollIt.js"></script>
    <script src="/theme/js/jquery.scrollUp.min.js"></script>
    <script src="/theme/js/wow.min.js"></script>
    <script src="/theme/js/nice-select.min.js"></script>
    <script src="/theme/js/jquery.slicknav.min.js"></script>
    <script src="/theme/js/jquery.magnific-popup.min.js"></script>
    <script src="/theme/js/plugins.js"></script>
    <script src="/theme/js/gijgo.min.js"></script>

    <!--contact js-->
    <script src="/theme/js/contact.js"></script>
    <script src="/theme/js/jquery.ajaxchimp.min.js"></script>
    <script src="/theme/js/jquery.form.js"></script>
    <script src="/theme/js/jquery.validate.min.js"></script>
    <script src="/theme/js/mail-script.js"></script>

    <script src="/theme/js/main.js"></script>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            disableDaysOfWeek: [0, 0],
        //     icons: {
        //      rightIcon: '<span class="fa fa-caret-down"></span>'
        //  }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }

        });
        var timepicker = $('#timepicker').timepicker({
         format: 'HH.MM'
     });

        // Открыть модальное окно

        function launchModal(){
            if($('.headerCitySelect').val() == 'null'){
                document.getElementById("myModal").style.display = "block";
            }
            
        }

        // Закрыть модальное окно
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        document.addEventListener('DOMContentLoaded', function() {
            $('.city-button').on('click', function(){
                var selectedCity = $('.citySelect').val()
                $('.headerCitySelect').val(selectedCity)
                closeModal()
            })
        })


    </script>

</body>

</html>
