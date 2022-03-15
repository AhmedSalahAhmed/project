 <!-- partial:partials/_navbar.html
 <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row ">
   <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
     <span class="navbar-brand brand-logo">

       @foreach($banks as $bank)
       {{$bank->bank_name}}
       @endforeach

     </span>
     <a class="navbar-brand brand-logo-mini" href="index.html"> <img src="{{asset('storage/'.$bank->logo)}}" alt="profile" />
     </a>
   </div>
   <div class="navbar-menu-wrapper d-flex align-items-stretch">
     <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
       <span class="mdi mdi-menu"></span>
     </button>

     <ul class="navbar-nav navbar-nav-right">

       <li class="nav-item nav-profile dropdown">
         <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">

           <div class="nav-profile-text">
             <p class="mb-1 text-black"> {{ Auth::user()->employee_name }}</p>
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
 partial
 <div class="container-fluid page-body-wrapper"> -->

 <nav class="navbar navbar-expand-custom navbar-mainbg fixed-top">
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
         <a class="nav-link" void(0) href="dashboard"><i class="fas fa-tachometer-alt"></i>شراء عملة اجنبية</a>
       </li>
      
       
       <li class="nav-item">
         <a class="nav-link" href="">
         </a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="transaction"><i class="far fa-calendar-alt"></i>العمليات</a>
       </li>
   
       <li class="nav-item">
         <a class="nav-link" href="javascript:void(0);"><i class="far fa-copy"></i>Documents</a>
       </li>
    
      
     </ul>
   </div>
 </nav>
 <!-- partial -->
 <div class="container-fluid page-body-wrapper"> 
