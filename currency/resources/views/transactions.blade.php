
@include('includes.header')

@include('includes.navbar')

@include('includes.sidebar')
 
   
               <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  @if(Auth::user()->hasRole('bank')) 

                  <h4 class="card-title">جميع معاملات الموظفين  </h4>
                    @endif
                  @if(Auth::user()->hasRole('admin')) 

                    <h4 class="card-title">جميع المعاملات مع البنوكـ</h4>

                    <p class="card-description"> البنوك <code class="rtl">تحت بنك السودان المركزي</code>
                    </p>
                    @endif
                    <table class="table">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> 
                               اسم العميل
<!--                           
                         @if(Auth::user()->hasRole('admin')) 
                          اسم البنك
                         
                         @endif
                         @if(Auth::user()->hasRole('bank')) 
                          اسم الموظف
                         
                         @endif -->
                         </th>
                          <th> نوع العملية </th>
                          <th> القيمة </th>
                          <th> العملة </th>
                          <th> التاريخ </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($transactions as $transaction) 

                        <tr>
                          <td> {{$transaction->id}}</td>
                          <td> {{$transaction->client_name}}</td>
                          <td>
                            @if($transaction->transaction_type == 'ايداع')
                          <label class="badge badge-gradient-success">{{$transaction->transaction_type}}</label>
                            @elseif($transaction->transaction_type == 'سحب')
                          <label class="badge badge-gradient-danger">{{$transaction->transaction_type}}</label>
                            @endif
                        </td>     
                          <td> 
                            
                            {{$transaction->amount}}
                          </td>
                          <td> {{$transaction->currency}}</td>
                          <td> {{$transaction->created_at}}</td>
                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                                   
                   
                                   

             
@extends('includes.footer')
   