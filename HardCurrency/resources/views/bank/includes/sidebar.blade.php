  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile ">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            @foreach($banks as $bank)

            <img src="{{asset('storage/'.$bank->logo)}}" alt="profile" />
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{ $bank->bank_name}}</span>
            @endforeach

          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('bank/dashboard')}}">
          <span class="menu-title"> اسعار الصرف</span>
          <i class="mdi mdi-cash menu-icon"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{url('bank/transaction')}}">
          <span class="menu-title"> العمليات</span>
          <i class=" mdi mdi-settings  menu-icon"></i>

        </a>
      </li>



    </ul>
  </nav>

  <!-- partial -->
  