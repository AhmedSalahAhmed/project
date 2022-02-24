  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="assets/images/bok.webp" alt="profile">
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
            <li class="nav-item">
              <a class="nav-link" href="{{ url('exchange') }}">
                <span class="menu-title">  اسعار الصرف</span>
                <i class="mdi mdi-cash menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('statistics') }}">
                <span class="menu-title"> الإحصائيات</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
                
              </a>
            </li>
            @if(!Auth::user()->hasRole('user'))
            <li class="nav-item">
              <a class="nav-link" href="{{ url('transactions') }}">
                <span class="menu-title"> العمليات</span>
                <i class=" mdi mdi-settings  menu-icon"></i>
                
              </a>
            </li>
            @if(Auth::user()->hasRole('admin'))
            <li class="nav-item">
              <a class="nav-link" href="{{ url('banks') }}">
                <span class="menu-title"> البنوك</span>
                <i class=" mdi mdi-bank  menu-icon"></i>
                
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="{{ url('employees') }}">
                <span class="menu-title"> الموظفين</span>
                <i class=" mdi mdi-account-multiple  menu-icon"></i>
                
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
                  <li class="nav-item"> <a class="nav-link" href="{{ url('employee_report') }}">تقارير الموظفين</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ url('report') }}">تقارير العملات</a></li>
                </ul>
              </div>
            </li>
            @endif
         
          </ul>
        </nav>

        <!-- partial -->
   <div class="main-panel">
     <div class="content-wrapper">