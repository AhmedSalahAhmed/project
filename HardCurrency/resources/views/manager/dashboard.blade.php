@extends('manager/layouts.app')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
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

                <h4 class="card-title"> العملات الأجنبية التي يتعامل بها@foreach($banks as $bank)
                
                {{$bank->bank_name}}
                @endforeach

                </h4>

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
                                <th scope="col">تعـــديل سعر الصرف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bankcurrencies as $bankcurrency)
                            <tr>

                                <td>{{$bankcurrency->currency_name}}</td>
                                <td>{{$bankcurrency->buy_price}}</td>
                                <td>{{$bankcurrency->sale_price}}</td>
                                <td>{{($bankcurrency->buy_price + $bankcurrency->sale_price) / 2}}</td>

                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$bankcurrency->id}}">
                                        تعديل
                                    </button>
                                </td>

                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{$bankcurrency->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">



                                            <form action="{{ route('manager.update', $bankcurrency->id) }}" method="POST">

                                                @csrf

                                                @method('put')

                                                <input type="text" id="currency_name{{$bankcurrency->id}}" name="currency_name" class="form-control mb-3" placeholder=" العملة " value="{{$bankcurrency->currency_name}}" disabled="disabled">
                                                <input type="text" id="buy_price{{$bankcurrency->id}}" name="buy_price" class="form-control mb-3" placeholder="سعر الشراء " value="{{$bankcurrency->buy_price}}">
                                                <input type="text" id="sale_price{{$bankcurrency->id}}" name="sale_price" class="form-control mb-3" placeholder="سعر البيع " value="{{$bankcurrency->sale_price}}">
                                                <input  id="_token" type="hidden" value="{{ csrf_token() }}"/>

                                                <button onclick="submitPriceFormManager('{{$bankcurrency->id}}', event)" class="btn btn-twitter float-end px-5" type="submit">تم</button>

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

                </div>
            </div>
        </div>
<script>
        const submitPriceFormManager = (id, e) => {

            console.log(id)

            e.preventDefault()

            const data = {
                currency_name: document.getElementById("currency_name"+id).value,
                buy_price: document.getElementById("buy_price"+id).value,
                sale_price: document.getElementById("sale_price"+id).value,
                _token: document.getElementById("_token").value
            }

            const formData = new FormData()

            formData.append("currency_name", data.currency_id)
            formData.append("buy_price", data.buy_price)
            formData.append("sale_price", data.sale_price)
            formData.append("_token", data._token)

            console.log(id)
            console.log(data)

            // return
            $.ajax({
                type:"post",
                url:"manager/"+ id + "?_method=put",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'json',
                success:(data) => {
                    console.log("data*************")
                    console.log(data)
                    location.replace("{{route('manager.index')}}")
                },
                error:(error)=>{
                    location.replace("{{route('manager.index')}}")
                    console.log(error.responseJSON)
                }
            })
            }
</script>

        @endsection