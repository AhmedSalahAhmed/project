
@include('manager.includes.header')

@include('manager.includes.navbar')

@include('manager.includes.sidebar')
 
   
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
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
                          <!-- Display message -->

                        @if (session('success'))

                        <div class="alert alert-success">
                            {{ session('success')}}
                        </div>

                        @endif
                    <h4 class="card-title"> الفروع </h4>
                    <!-- <p class="card-description">    <code class="rtl">مدراء</code>البنوك
                    </p> -->
                    <button type="button" class="btn btn-twitter" data-bs-toggle="modal" data-bs-target="#addModal">
                    اضافة فرع جديد
                    </button>
                    <!-- Add Bank Modal -->
                    <!-- Modal -->
                   <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exchangeModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                    
                        <form action="{{ route('branch.store') }}" method="post" class="forms-sample" autocomplete="off">
                            @csrf
                                        
                       
                                       
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> الإسم </label>
                                            <div class="col-sm-9">
                                            <input type="text" name="branch_name" class="form-control"  placeholder=" اسم الفرع  ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> رقم االهاتف </label>
                                            <div class="col-sm-9">
                                            <input type="text" name="phone_number" class="form-control"  placeholder=" رقم الهاتف   ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> الولاية </label>
                                            <div class="col-sm-9">
                                            <input type="text" name="state" class="form-control"  placeholder=" الولاية   ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> المدينة </label>
                                            <div class="col-sm-9">
                                            <input type="text" name="city" class="form-control"  placeholder=" المدينة   ">
                                            </div>
                                        </div>
                                       
                                    
                                      
                                        
                                        <button class="btn btn-twitter float-end px-5" type="submit">تم</button>


                        </form>

                            </div>
                            
                            </div>
                        </div>
                    </div>
                    <!-- end add bank modal -->
                    <table class="table">
                      <thead>
                        <tr>
                          <th>  اسم الفرع </th>
                          <th> المدينة</th>
                          <th> رقم الهاتف</th>
                          <th> تعديل</th>
                          <th> حذف    </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($branches as $branch)

                        <tr>
                          <td class="py-1">
                          {{$branch->branch_name}}
                          </td>
                          <td> {{$branch->city}}</td>
                          
                          <td>{{$branch->phone_number}}</td>
                          <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$branch->id}}">
                                تعديل
                            </button> 
                            </td>
                            <td>
                            <form method="post" action="{{route('branch.destroy',$branch->id)}}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                            </td> 
                        </tr>
                         <!-- Edit Modal -->
                         <div class="modal fade" id="editModal{{$branch->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                
                                

                            <form action="{{ route('branch.update', $branch->id) }}" method="POST">

                            @csrf

                                @method('put')
                                
                                <input type="text" name="branch_name" class="form-control mb-3" placeholder=" اسم الفرع " value="{{$branch->branch_name}}">
                                <input type="text" name="city" class="form-control mb-3" placeholder=" المكان  " value="{{$branch->city}}">
                                <input type="email" name="phone_number" class="form-control mb-3" placeholder=" البريد الإلكتروني " value="{{$branch->phone_number}}">
                                

                                

                                <button class="btn btn-twitter float-end px-5" type="submit">تم</button>

                            </form>

                            </div>
                            
                            </div>
                        </div>
                        </div>
                        <!-- End Edit Modal -->
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>       
                                   

             
@extends('manager.includes.footer')
   