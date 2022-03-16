@extends('centralbank/layouts.app')

@section('content')




    @if ($errors->any())
    <div class="alert alert-danger">
        عفواً <strong>{{ Auth::user()->name }} !!!</strong> <br> هناك بعض الاخطاء في الإدخال .<br><br>
        <ul dir="ltr">
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
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"> مستخدمي نظام البنك المركزي </h4>
                <p class="card-description"> <code class="rtl">مستخدمي</code>النظام
                </p>
                <button type="button" class="btn login-btn" data-bs-toggle="modal" data-bs-target="#addModal">
                    اضافة مستخدم
                </button>
                <!-- Add Bank Modal -->
                <!-- Modal -->
                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exchangeModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content shadow">
                            <div class="modal-header">

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>


                            </div>
                            <div class="modal-body ">

                                <form action="{{ route('users.store') }}" method="post" class="forms-sample" autocomplete="off">
                                    @csrf



                                    <div class="form-group row">
                                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> الإسم </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control shadow" placeholder=" اسم مدير البنك ">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="floatingInput" class="col-sm-3 col-form-label"> البريد الإلكتروني</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email" class="form-control shadow" id="floatingInput" placeholder="البريد الالكتروني ">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> كلمة المرور</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" class="form-control shadow" placeholder=" كلمة المرور ">
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
                            <th> المستخدم </th>
                            <th> البريد الالكتروني </th>
                            <th> تعديل </th>
                            <th> حذف </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)

                        <tr>
                            <td class="py-1">
                                {{$user->name}}
                            </td>

                            <td>{{$user->email}}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$user->id}}">
                                    تعديل
                                </button>
                            </td>
                            <td>
                                <form method="post" action="{{route('users.destroy',$user->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">



                                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <input type="text" name="name" class="form-control mb-3" placeholder=" اسم المستخدم " value="{{$user->name}}">
                                            <input type="email" name="email" class="form-control mb-3" placeholder=" البريد الإلكتروني " value="{{$user->email}}">
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



@endsection