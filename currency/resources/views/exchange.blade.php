    <!-- Stripe payment code  -->
    <?php
// This example sets up an endpoint using the Slim framework.
// Watch this video to get started: https://youtu.be/sGcNPFX1Ph4.


require_once __DIR__.'/../../../vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51ISiPlBG8tWZQZa4RMwlPXnzsMD7KIxbYhxXTaGcamlfhpvxeVkdU1Rr2eBVZSi0iTjf8CNyvZMLRWY30kvuwrb400gzfKu7lb');


  $session = \Stripe\Checkout\Session::create([
      'payment_method_types' => ['card'],
    'line_items' => [[
      'price_data' => [
        'currency' => 'usd',
        'product_data' => [
          'name' => 'شراء عملة اجنبية',
        ],
        'unit_amount' => 20000,
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'https://example.com/success',
    'cancel_url' => 'https://example.com/cancel',
    ]);

  

?>
     
     
     @include('includes.header')

     @include('includes.navbar')
     
     @include('includes.sidebar')
      
     
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

                @if(Auth::user()->hasRole('user'))
                
                <!-- Button trigger modal -->
                
                <button type="button" class="btn btn-twitter" data-bs-toggle="modal" data-bs-target="#exchangeModal">
                  تغير عملة يدوي
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
                   
                    <form action="{{ route('transactions.store') }}" method="post" class="forms-sample">
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
                                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">نوع الهوية</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="id_type" class="form-control"  placeholder="نوع الهوية">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">رقم الهوية</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="id_number" class="form-control"  placeholder="رقم الهوية">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> المبلغ</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="amount" class="form-control"  placeholder=" المبلغ">
                                        </div>
                    
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> نوع العملية</label>
                                        <div class="col-sm-9">
                                        <select name="transaction_type" id="" class="form-control">
                                            <option value="ايداع">ايداع</option>
                                            <option value="سحب"> سحب</option>
                                        </select>
                                        </div>
                    
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> العملة</label>
                                        <div class="col-sm-9">
                                            
                                        <select name="currency" id="" class="form-control">
                                        <option value="">اختار العملة </option>

                                            @foreach($currencies as $currency)
                                            <option value="{{$currency->name}}">{{$currency->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                    
                                    </div>
                                    <button class="btn btn-twitter float-end px-5" type="submit">تم</button>


                                    </form>
                            @include('sweetalert::alert')

                    </div>
                    
                    </div>
                </div>
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

                        <table class="table">

                        <thead>
                            <tr></tr>
                            <tr>
                            
                                <th scope="col">العملة </th>
                                <th scope="col">سعر الشراء </th>
                                <th scope="col">سعر البيع </th>
                                <th scope="col"> المتوسط </th>
                                <th scope="col">تعديل</th>
                                <th scope="col">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currencies as $currency) 
                            <tr>
                                
                                <td>{{$currency->name}}</td>
                                <td>{{$currency->buy_price}}</td>
                                <td>{{$currency->sell_price}}</td>
                                <td>{{($currency->buy_price + $currency->sell_price) / 2}}</td>
                                <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$currency->id}}">
                                تعديل
                                </button> 
                                </td>
                                <td>
                                    <form action="{{route('exchange.destroy' , $currency->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                        <input type="submit" class="btn btn-sm btn-danger" value="حذف">
                                    </form> 
                                </td>    
                            
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{$currency->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                
                                

                            <form action="{{ route('exchange.update', $currency->id) }}" method="POST">

                            @csrf

                                @method('put')
                                
                                <input type="text" name="name" class="form-control mb-3" placeholder=" العملة " value="{{$currency->name}}">
                                <input type="text" name="buy_price" class="form-control mb-3" placeholder="سعر الشراء " value="{{$currency->buy_price}}">
                                <input type="text" name="sell_price" class="form-control mb-3" placeholder="سعر البيع " value="{{$currency->sell_price}}">
                                

                                

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
                    <div class="d-felx justify-content-center">
                        {{ $currencies->links() }}
                    </div>
                        
                    <button type="button" class="btn btn-twitter" data-bs-toggle="modal" data-bs-target="#addModal">
                    اضافة عملة
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          
                          @if ($errors->any())
                              <div class="alert alert-danger">
                                  <strong>عفواً !!!</strong> <br> هناك بعض الاخطاء في الإدخال .<br><br>
                                  <ul  dir="ltr">
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif  

                      <form action="{{ route('exchange.store') }}"  method="post"  autocomplete="off">

                       @csrf
                          
                          <input type="text" name="name" class="form-control mb-3" placeholder=" العملة ">
                          <input type="text" name="buy_price" class="form-control mb-3" placeholder="سعر الشراء ">
                          <input type="text" name="sell_price" class="form-control mb-3" placeholder="سعر البيع ">
                          <button class="btn btn-twitter float-end px-5" type="submit">تم</button>
    
                      </form>

                </div>
                        
                                    

                  
         @extends('includes.footer')
        