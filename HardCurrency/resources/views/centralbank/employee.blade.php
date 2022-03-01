
@include('centralbank.includes.header')

@include('centralbank.includes.navbar')

@include('centralbank.includes.sidebar')
 
   
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
                    <h4 class="card-title"> الموظفين </h4>
                    <p class="card-description">    <code class="rtl">مدراء</code>البنوك
                    </p>
                    <button type="button" class="btn btn-twitter" data-bs-toggle="modal" data-bs-target="#addModal">
                    اضافة موظف
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
                    
                        <form action="{{ route('employee.store') }}" method="post" class="forms-sample" autocomplete="off">
                            @csrf
                                        
                            <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> البنك</label>
                                            <div class="col-sm-9">
                                                
                                            <select name="bank_id" id="" class="form-select">
                                            <option value="">إختار أحد البنوك المُسَجَلة</option>

                                                @foreach($banks as $bank)
                                                <option value="{{$bank->id}}">{{$bank->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                        
                                        </div>
                                       
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> الإسم </label>
                                            <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control"  placeholder=" اسم مدير البنك ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="floatingInput" class="col-sm-3 col-form-label"> البريد الإلكتروني</label>
                                            <div class="col-sm-9">
                                            <input type="email" name="email" class="form-control" id="floatingInput"  placeholder="البريد الالكتروني ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> تاريخ الميلاد</label>
                                            <div class="col-sm-9">
                                            <input type="date" name="date_of_birth" class="form-control"  placeholder=" تاريخ الميلاد ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> الرقم الوطني</label>
                                            <div class="col-sm-9">
                                            <input type="text" name="national_id" class="form-control"  placeholder=" الرقم الوطني ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> كلمة المرور</label>
                                            <div class="col-sm-9">
                                            <input type="password" name="password" class="form-control"  placeholder=" كلمة المرور ">
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
                          <th>  الموظف </th>
                          <th> اسم البنك </th>
                          <th> البريد الالكتروني    </th>
                          <th> تعديل    </th>
                          <th> حذف    </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($employees as $employee)

                        <tr>
                          <td class="py-1">
                          {{$employee->name}}
                          </td>
                          <td> {{$employee->bank_id}}</td>
                          
                          <td>{{$employee->email}}</td>
                          <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$employee->id}}">
                                تعديل
                            </button> 
                            </td>
                            <td>
                            <form method="post" action="{{route('employee.destroy',$employee->id)}}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                            </td> 
                        </tr>
                         <!-- Edit Modal -->
                         <div class="modal fade" id="editModal{{$employee->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                
                                

                            <form action="{{ route('employee.update', $employee->id) }}" method="POST">

                            @csrf

                                @method('put')
                                
                                <input type="text" name="name" class="form-control mb-3" placeholder=" اسم الموظف " value="{{$employee->name}}">
                                <input type="email" name="email" class="form-control mb-3" placeholder=" البريد الإلكتروني " value="{{$employee->email}}">
                                

                                

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
                                   

             
@extends('centralbank.includes.footer')
   