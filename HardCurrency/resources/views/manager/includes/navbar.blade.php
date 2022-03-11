 <!-- partial:partials/_navbar.html -->
 <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row ">
   @foreach($banks as $bank)

   <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
     <span class="navbar-brand brand-logo">مدير الفرع الرئيسي</span>
     <a class="navbar-brand brand-logo-mini">

       <img src="{{asset('storage/'.$bank->logo)}}" alt="profile" /></a>
   </div>
   @endforeach
   <div class="navbar-menu-wrapper d-flex align-items-stretch">
   <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
       <span class="mdi mdi-menu"></span>
     </button>
     <ul class="navbar-nav navbar-nav-right">
       @foreach($banks as $bank)

       <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
         <span class="navbar-brand brand-logo"> {{Auth::user()->manager_name}} </span>
         <a class="navbar-brand brand-logo-mini">

       </div>
       @endforeach

       <div>

         <form method="POST" action="{{ route('logout') }}">
           @csrf

           <li class="nav-item rtl" style="float: left;">



             <button class="btn btn-danger"><i class="mdi mdi-logout  menu-icon"></i></button>
           </li>
         </form></a>
       </div>
       </li>



     </ul>
   
   </div>
 </nav>
 <!-- partial -->
 <div class="container-fluid page-body-wrapper">