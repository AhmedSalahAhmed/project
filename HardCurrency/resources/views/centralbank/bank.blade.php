@extends('centralbank/layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title">
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
</div>
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
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> الاسم المختصر </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="url" class="form-control" placeholder="الاسم المختصر لعنوان ال URL ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">شعار البنك </label>
                                    <div class="col-sm-9">
                                        <input type="file" name="logo" id="logo" class="form-control" placeholder="شعار النك " />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> الولاية</label>
                                    <div class="col-sm-9">
                                        <select name="state" id=""  class="form-select">
                                            <option value="">اختر الولاية</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">المحلية </label>
                                    <div class="col-sm-9">
                                        <select name="state" id="" class="form-select">
                                            <option value="">اختر المحلية</option>
                                        </select>
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



@endsection
