@include('manager.includes.header')

@include('manager.includes.navbar')

@include('manager.includes.sidebar')
 

       <div class="page-header">
         <h3 class="page-title">
         @if ($errors->any())
                         <div class="alert alert-danger">
                         عفواً <strong>{{ Auth::user()->name }} !!!</strong> <br> هناك بعض الاخطاء في الإدخال .<br><br>
                             <ul  dir="ltr">
                                 @foreach ($errors->all() as $error)
                                     <li>{{ $error }}</li>
                                 @endforeach
                             </ul>
                         </div>
                     @endif  

           
           
           
       </div>
       <div class="row">
       <div class="col-lg-12 grid-margin stretch-card">
           <div class="card">
               <div class="card-body">
                   <h4 class="card-title">أسعار الصرف </h4>
               
               
                   @if (session('success'))

                   <div class="alert alert-success">
                       {{ session('success')}}
                   </div>

                   @endif
                <div class="table-responsive">
                <table class="table">

<thead>
    <tr></tr>
    <tr>
    
        <th scope="col">العملة </th>
        <th scope="col">سعر الشراء </th>
        <th scope="col">سعر البيع </th>
        <th scope="col"> المتوسط </th>
        <th scope="col">تعـــديل سعر الصرف</th>
    </tr>
</thead>
<tbody>
    @foreach ($bankcurrencies as $currency) 
    <tr>
        
        <td>{{$currency->currency_name}}</td>
        <td>{{$currency->buy_price}}</td>
        <td>{{$currency->sale_price}}</td>
        <td>{{($currency->buy_price + $currency->sale_price) / 2}}</td>
        <td>
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$currency->id}}">
        تعديل
        </button> 
        </td>
       
    </tr>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal{{$currency->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
        

    <form action="{{ route('managers.update', $currency->id) }}" method="POST">

    @csrf

        @method('put')
        
        <input type="text" name="currency_name" class="form-control mb-3" placeholder=" العملة " value="{{$currency->currency_name}}" disabled="disabled">
        <input type="text" name="buy_price" class="form-control mb-3" placeholder="سعر الشراء " value="{{$currency->buy_price}}">
        <input type="text" name="sale_price" class="form-control mb-3" placeholder="سعر البيع " value="{{$currency->sale_price}}">
        

        

        <button class="btn btn-twitter float-end px-5" type="submit">تم</button>

    </form>
    @include('sweetalert::alert')

    </div>
    
    </div>
</div>
</div>
<!-- End Edit Modal -->
@endforeach
</tbody>
</table> 
                </div>
                   
               <div class="d-felx justify-content-center">
                 
               </div>
@include('manager.includes.footer')
