  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{asset('assets/images/cbos.jpeg')}}" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                  <span class="text-secondary text-small">{{ Auth::user()->email}}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            @if(Auth::user()->type == ('admin'))
            <li class="nav-item">
              <a class="nav-link" href="{{url('centralbank/users')}}">
                <span class="menu-title"> مستخدمي النظام </span>
                <i class=" mdi mdi-account-multiple  menu-icon"></i>
                
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="{{url('centralbank/banks')}}">
                <span class="menu-title"> البنوك</span>
                <i class=" mdi mdi-bank  menu-icon"></i>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('centralbank/managers')}}">
                <span class="menu-title"> مدراء البنوك</span>
                <i class=" mdi mdi-account-multiple  menu-icon"></i>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('centralbank/currency')}}">
                <span class="menu-title">   العملات</span>
                <i class="mdi mdi-cash menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('centralbank/price')}}">
                <span class="menu-title">  اسعار العملات</span>
                <i class="mdi mdi-chart-areaspline menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('centralbank/bankaccounts')}}">
                <span class="menu-title">  حسابات البنوك </span>
                <i class="mdi mdi-cash-multiple menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('centralbank/statistics') }}">
                <span class="menu-title"> الإحصائيات</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
                
              </a>
            </li>
       
            
            <!-- Reports list -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">التقارير</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-message menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="#">تقارير الموظفين</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">تقارير العملات</a></li>
                </ul>
              </div>
            </li>
         
          </ul>
        </nav>

        <!-- partial -->
   <div class="main-panel">
     <div class="content-wrapper">