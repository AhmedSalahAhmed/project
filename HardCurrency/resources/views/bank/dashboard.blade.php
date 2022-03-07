@include('bank.includes.header')

@include('bank.includes.navbar')

@include('bank.includes.sidebar')
 

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

           
           
           <!-- Button trigger modal -->
           
           <button type="button" class="btn btn-twitter" data-bs-toggle="modal" data-bs-target="#exchangeModal">
             تغير عملة نقداً
           </button>
         
               <button id ="checkout-button" class="btn btn-success" type="button">تحويل عبر بطاقة </button>

           <!-- Modal -->
           <div class="modal fade" id="exchangeModal" tabindex="-1" aria-labelledby="exchangeModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
               
                   <form action="{{ route('bank.store') }}" method="post" class="forms-sample">
                       @csrf
                                   
                   <div class="form-group row">
                                       <label for="exampleInputEmail2" class="col-sm-3 col-form-label">إسم العميل </label>
                                       <div class="col-sm-9">
                                       <input type="text" name="client_name" class="form-control"  placeholder=" إسم العميل">
                                       </div>
                                   </div>
                                   <div class="form-group row">
                                       <label for="exampleInputEmail2" class="col-sm-3 col-form-label">رقم الهاتف</label>
                                       <div class="col-sm-9">
                                       <input type="text" name="client_phone" class="form-control"  placeholder="رقم الهاتف">
                                       </div>
                                   </div>
                                  
                                   <div class="form-group row">
                                       <label for="exampleInputEmail2" class="col-sm-3 col-form-label">رقم الهوية</label>
                                       <div class="col-sm-9">
                                       <input type="text" name="id_number" class="form-control"  placeholder="رقم الهوية">
                                       </div>
                                   </div>
                                   <div class="form-group row">
                                       <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> نوع العملة</label>
                                       <div class="col-sm-9">
                                       <select name="bank_currency_id" id="currency" class="form-select">
                                            <option value="">   اختار العملة   </option>

                                            @foreach ($bankcurrencies as $bankcurrency) 
                                           
                                           <option id="option" value="{{$bankcurrency->currency_id}}">{{$bankcurrency->currency_name}}</option>
                                            <option type="input" name="buy_price" id="buyprice"value="{{$bankcurrency->buy_price}}" hidden>
                                            @endforeach

                                       </select>
                                       </div>
                   
                                   </div>
                                   <div class="form-group row">
                                       <label for="exampleInputEmail2" class="col-sm-3 col-form-label">  المبلغ  </label>
                                       <div class="col-sm-9">
                                       <input type="text" name="amount" class="form-control"  placeholder="  المبلغ بالعملة الاجنبية" onkeyup="mult(this.value);">
                                       <input type="text" id="sdgamount" name="sdgamount"hidden>

                                       </div>
                   
                                   </div>
                                   <div class="form-group row">
                                       <label  for="exampleInputEmail2" class="col-sm-3 col-form-label">  المجموع  :  </label>
                                       <div class="col-sm-9">
                                       <input id="total" type="text" name="total" class="form-control" placeholder=" المبلغ بالجنيه السوداني" disabled>
                                       </div>
                   
                                   </div>
                              
                                   
                                   <button class="btn btn-twitter float-end px-5" type="submit">تم</button>


                                   </form>
                           @include('sweetalert::alert')

                   </div>
                   
                   </div>
               </div>
           </div>
         
         
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
    </tr>
</thead>
<tbody>
    @foreach ($bankcurrencies as $bankcurrency) 
    <tr>
        
        <td>{{$bankcurrency->currency_name}}</td>
        <td>{{$bankcurrency->buy_price}}</td>
        <td>{{$bankcurrency->sale_price}}</td>
        <td>{{($bankcurrency->buy_price + $bankcurrency->sale_price) / 2}}</td>
        
       
    </tr>
@endforeach

    <!-- Edit Modal
    <div class="modal fade" id="editModal{{$bankcurrency->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
        

    <form action="{{ route('bank.update', $bankcurrency->id) }}" method="POST">

    @csrf

        @method('put')
        
        <input type="text" name="currency_name" class="form-control mb-3" placeholder=" العملة " value="{{$bankcurrency->currency_name}}" disabled="disabled">
        <input type="text" name="buy_price" class="form-control mb-3" placeholder="سعر الشراء " value="{{$bankcurrency->buy_price}}">
        <input type="text" name="sale_price" class="form-control mb-3" placeholder="سعر البيع " value="{{$bankcurrency->sale_price}}">

        <button class="btn btn-twitter float-end px-5" type="submit">تم</button>

    </form>
    @include('sweetalert::alert')

    </div>
    
    </div>
</div>
</div> -->
<!-- End Edit Modal -->
<script>
                       function mult(value){
                           var buy = document.getElementById('buyprice').value;
                           var x =  value*buy;

                           document.getElementById('total').value = x+' جنيه  ';
                           document.getElementById('sdgamount').value = x;
                        //    var select = document.getElementById('currency');
                        //    var opt = select.options[select.selectedIndex].value;
                        //    if($currency->id == opt)
                        //    {

                          
                        //    }
                       }
                   </script>
</tbody>
</table> 
                </div>
                  
               

              
@include('bank.includes.footer')
