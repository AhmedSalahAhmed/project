@extends('manager/layouts.app')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
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
            <h4 class="card-title"> الموظفين </h4>
            <!-- <p class="card-description">    <code class="rtl">مدراء</code>البنوك
                    </p> -->
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

                            <form action="{{ route('employees.store') }}" method="post" class="forms-sample" autocomplete="off">
                                @csrf



                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> الإسم </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="employee_name" class="form-control" placeholder=" اسم الموظف  ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> البنك</label>
                                    <div class="col-sm-9">

                                        <select name="branch_id" id="" class="form-select">
                                            <option value="">إختار أحد الفروع المُسَجَلة</option>

                                            @foreach($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="floatingInput" class="col-sm-3 col-form-label"> البريد الإلكتروني</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="البريد الالكتروني ">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> كلمة المرور</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" class="form-control" placeholder=" كلمة المرور ">
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
                        <th> الموظف </th>
                        <th> الفرع </th>
                        <th> البريد الالكتروني </th>
                        <th> تعديل </th>
                        <th> حذف </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)

                    <tr>
                        <td class="py-1">
                            {{$employee->employee_name}}
                        </td>
                        <td> {{$employee->branch_name}}</td>

                        <td>{{$employee->email}}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$employee->id}}">
                                تعديل
                            </button>
                        </td>
                        <td>
                            <form method="post" action="{{route('employees.destroy',$employee->id)}}">
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



                                    <form action="{{ route('employees.update', $employee->id) }}" method="POST">

                                        @csrf

                                        @method('put')

                                        <input type="text" name="employee_name" class="form-control mb-3" placeholder=" اسم الموظف " value="{{$employee->employee_name}}">
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


@endsection