<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @foreach($branches as $branch)

    <title>

        {{ $branch->branch_name}}
    </title>
    @endforeach
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <style>
        * {
            font-family: "Tajawal", sans-serif !important;
        }
    </style>

    <link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon" />
    <!-- Icons css -->
    <link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
    <!--  Custom Scroll bar-->
    <link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />
    -->
    <link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">

</head>

<body>
    <div class="container-scroller rtl">

        <nav class="navbar navbar-expand-custom navbar-mainbg fixed-top">
            <p class="right">


            <div class="nav-profile-image">
                @foreach($banks as $bank)

                <img src="{{asset('storage/'.$bank->logo)}}" style="width: 44px;
                height: 44px;
                border-radius: 100%;" class="profileimage" alt="profile" />
                @endforeach

                <!--change to offline or busy as needed-->
            </div>

            <div class="nav-profile-text d-flex flex-column " style="color: white;font-weight:bold;">
                @foreach($banks as $branch)

                <span class="font-weight-bold mb-2"> {{ $branch->bank_name}} </span>
                @endforeach
            </div>



            </p>
            <a class="navbar-brand navbar-logo" href="#"></a>
            <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ml-auto">
                    <div class="hori-selector">
                        <div class="left"></div>
                        <div class="right"></div>
                    </div>

                    <li class="nav-item">
                        <a class="nav-link" href="dashboard"><i class="fas fa-tachometer-alt"></i>شراء عملة اجنبية</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="transaction"><i class="far fa-calendar-alt"></i>العمليات</a>
                    </li>


                </ul>

            </div>

            <div class="nav-profile-text d-flex flex-column " style="color: white;font-weight:bold;">
                @foreach($branches as $branch)

                <span class="font-weight-bold mb-2 "> فرع {{ $branch->branch_name}}</span>
                @endforeach
            </div>
            <form method="get" action="{{ route('employee.logout') }}">
                @csrf
                <a class="logout" href="route('employee.logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    <i class="fa-regular fa-user"></i>
                    تسجيل خروج
                </a>
            </form>
        </nav>
        <!-- partial -->
        <div id="content" class="container page-body-wrapper">
            @yield('content')

        </div>
    </div>
    </div>

    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
            <span class="text-muted d-block text-end text-sm-start d-sm-inline-block">Copyright © oot.com 2022</span>
        </div>
    </footer>


    <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


    <!-- plugins:js -->
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->

    <script>
        $('.nav-link').click(function(event) {
            // Avoid the link click from loading a new page
            event.preventDefault();
            // Load the content from the link's href attribute
            window.history.pushState('', '', $(this).attr('href'))
            $('.page-body-wrapper').load($(this).attr('href'));
        });


        $('.editForm').submit(function(event) {
            // Avoid the link click from loading a new page
            event.preventDefault();
            // Load the content from the link's href attribute
            $('.page-body-wrapper').load($(this).attr('action'));
        });
    </script>

    <script src="{{asset('assets/all.min.js')}}"></script>
    <script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <!-- End custom js for this page -->
</body>

</html>