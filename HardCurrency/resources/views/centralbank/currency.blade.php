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
                <h4 class="card-title">العملات المعتمدة لدى بنك السودان المركزي </h4>


                @if (session('success'))

                <div class="alert alert-success">
                    {{ session('success')}}
                </div>

                @endif

                <button type="button" class="btn login-btn" data-bs-toggle="modal" data-bs-target="#addModal">
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
                                    <ul dir="ltr">
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <form action="{{ route('currency.store') }}" method="post" autocomplete="off">

                                    @csrf

                                    <input type="text" name="currency_name" class="form-control mb-3" placeholder=" العملة ">
                                    <input type="text" name="abbreviation" class="form-control mb-3" placeholder=" الرمز ">
                                    <input type="text" name="symbol" class="form-control mb-3" placeholder="العلامة  ">
                                    <button class="btn btn-twitter float-end px-5" type="submit">تم</button>

                                </form>
                                @include('sweetalert::alert')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

                <div class="table-responsive">

                    <table class="table">

                        <thead>
                            <tr>
                                <th scope="col">العملة </th>
                                <th scope="col">الرمز </th>
                                <th scope="col">العلامة </th>
                                <th scope="col">تعـــديل </th>
                                <th scope="col"> حذف العملة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currencies as $currency)
                            <tr>

                                <td>{{$currency->currency_name}}</td>
                                <td>{{$currency->abbreviation}}</td>
                                <td>{{$currency->symbol}}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$currency->id}}">
                                        تعديل
                                    </button>
                                </td>


                                <td>

                                    <form method="post" action="{{route('currency.destroy',$currency->id)}}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                    </form>
                                    @include('sweetalert::alert')

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



                                            <form id="editForm" method="post" action="{{ route('currency.update', $currency->id) }}" >
                                                @csrf
                                                @method('put')


                                                <input id="currency_name{{$currency->id}}" type="text" name="currency_name" class="form-control mb-3" placeholder=" العملة " value="{{$currency->currency_name}}" disabled="disabled"/>
                                                <input id="abbreviation{{$currency->id}}" type="text" name="abbreviation" class="form-control mb-3" placeholder="سعر الشراء " value="{{$currency->abbreviation}}"/>
                                                <input id="symbol{{$currency->id}}" type="text" name="symbol" class="form-control mb-3" placeholder="سعر البيع " value="{{$currency->symbol}}"/>
                                                <input id="_token" type="hidden" value="{{ csrf_token() }}"/>

                                                <input onclick="submitForm('{{$currency->id}}', event)" class="btn btn-twitter float-end px-5" value="تم" type="submit"/>

                                            </form>
                                            @include('sweetalert::alert')

                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-felx justify-content-center">
                    {{ $currencies->links() }}
                </div>

                <script>
                    const submitForm = (id, e) => {

                        console.log(id)

                        e.preventDefault()

                        const data = {
                            abbreviation: document.getElementById("abbreviation"+id).value,
                            symbol: document.getElementById("symbol"+id).value,
                            currency_name: document.getElementById("currency_name"+id).value,
                            _token: document.getElementById("_token").value
                        }

                        const formData = new FormData()

                        formData.append("abbreviation", data.abbreviation)
                        formData.append("symbol", data.symbol)
                        formData.append("currency_name", data.currency_name)
                        formData.append("_token", data._token)
                        console.log(id)
                        console.log(data)
                        $.ajax({
                            type:"post",
                            url:"currency/"+ id + "?_method=put",
                            data: formData,
                            contentType: false,
                            processData: false,
                            cache: false,
                            dataType: 'json',
                            success:(data) => {
                                console.log("data*************")
                                console.log(data)
                                location.replace("{{route('currency.index')}}")
                            },
                            error:(error)=>{
                                location.replace("{{route('currency.index')}}")
                                console.log(error.responseJSON)
                            }
                        })
                    }


                </script>

@endsection
