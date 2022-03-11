 <!-- partial:partials/_navbar.html -->
 <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row ">
   @foreach($banks as $bank)

   <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
     <span class="navbar-brand brand-logo"> {{$bank->bank_name}} </span>
     <a class="navbar-brand brand-logo-mini" href="index.html">

       <img src="{{asset('storage/'.$bank->logo)}}" alt="profile" /></a>
   </div>
   @endforeach
   <div class="navbar-menu-wrapper d-flex align-items-stretch">
     <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
       <span class="mdi mdi-menu"></span>
     </button>

     <ul class="navbar-nav navbar-nav-right">

       <li class="nav-item nav-profile dropdown">
         <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">

           <div class="nav-profile-text">
             <p class="mb-1 text-black">{{ Auth::user()->manager_name}}</p>
           </div>
         </a>
         <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">

           <form method="POST" action="{{ route('logout') }}">
             @csrf


             <a href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">

               {{ __('تسجيل خروج') }}
             </a>
           </form></a>
         </div>
       </li>



     </ul>
     <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
       <span class="mdi mdi-menu"></span>
     </button>
   </div>
 </nav>
 <!-- partial -->
 <div class="container-fluid page-body-wrapper">