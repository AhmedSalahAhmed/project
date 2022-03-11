@include('centralbank.includes.header')

@include('centralbank.includes.navbar')

@include('centralbank.includes.sidebar')


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> البنوك</h4>
            <p class="card-description"> جميع البنوك تحت <code class="rtl">بنك السودان المركزي</code>
            </p>
            <button type="button" class="btn btn-twitter" data-bs-toggle="modal" data-bs-target="#addModal">
                اضافة بنك
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

                            <form action="{{ route('banks.store') }}" enctype="multipart/form-data" method="post" class="forms-sample">
                                @csrf

                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">إسم البنك </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bank_name" class="form-control" placeholder=" إسم البنك">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">البريد الالكتروني </label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control" placeholder=" البريد الالكتروني">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">رقم الهاتف </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" class="form-control" placeholder=" رقم الهاتف">
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> نوع الفرع</label>
                                            <div class="col-sm-9">
                                            <select name="type" id="" class="form-control">
                                                <option value="branch">فرع </option>
                                                <option value="main">الرئاسة</option>
                                            </select>
                                            </div> -->

                                <!-- </div> -->
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">شعار البنك </label>
                                    <div class="col-sm-9">
                                        <input type="file" name="logo" id="logo" class="form-control" placeholder="شعار النك "/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> الولاية</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="state" class="form-control" placeholder="الولاية "/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">المدينة </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="city" class="form-control" placeholder=" المدينة">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">المحلية </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="district" class="form-control" placeholder=" المحلية">
                                    </div>
                                </div>

                                <button class="btn btn-twitter float-end px-5" type="submit">تم</button>


                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- end add bank modal -->
            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th> شعار البنك </th>
                            <th> اسم البنك </th>
                            <th> البريدالإلكتروني </th>
                            <th> العنوان </th>
                            <th> تاريخ الإنضمام للنظام </th>
                            <th> تعديل </th>
                            <th> حذف </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banks as $bank)

                        <tr>
                            <td class="py-1">
                                <img src="{{asset('storage/'.$bank->logo)}}" alt="image" />
                            </td>
                            <td> {{$bank->bank_name}}</td>
                            <td> {{$bank->email}}</td>

                            <td>{{$bank->state}}</td>
                            <td>{{$bank->created_at}}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$bank->id}}">
                                    تعديل
                                </button>
                            </td>
                            <td>
                                <form method="post" action="{{route('banks.destroy',$bank->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{$bank->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-bg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">



                                        <form action="{{ route('banks.update', $bank->id) }}" method="POST">

                                            @csrf

                                            @method('put')

                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">اسم البنك </label>
                                            <input type="text" name="bank_name" class="form-control mb-3" placeholder=" اسم البنك " value="{{$bank->bank_name}}">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">البريد الالكتروني </label>
                                            <input type="text" name="email" class="form-control mb-3" placeholder=" العنوان " value="{{$bank->email}}">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">الهاتف </label>
                                            <input type="text" name="phone" class="form-control mb-3" placeholder=" العنوان " value="{{$bank->phone}}">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">الولاية </label>
                                            <input type="text" name="state" class="form-control mb-3" placeholder=" العنوان " value="{{$bank->state}}">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">المدينة </label>
                                         
                                           <input type="text" name="city" class="form-control mb-3" placeholder=" العنوان " value="{{$bank->city}}">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">المحلية </label>
                                        
                                           <input type="text" name="district" class="form-control mb-3" placeholder=" العنوان " value="{{$bank->district}}">




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
                <div>{{$banks->links()}}</div>
            </div>
        </div>
    </div>
</div>



@extends('centralbank.includes.footer')