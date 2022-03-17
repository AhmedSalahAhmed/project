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
            <div class="row">
                <h4 class="card-title">العملات المعتمدة لدى بنك السودان المركزي </h4>
                <h4 class="card-title float-left"> <?php echo date('Y-m-d'); ?> </h4>
            </div>


            @if (session('success'))

            <div class="alert alert-success">
                {{ session('success')}}
            </div>

            @endif



            <div class="table-responsive">

                <table class="table">

                    <thead>
                        <tr>
                            <th scope="col"> اسم العملة </th>
                            <th scope="col"> الرمز </th>
                            <th scope="col">سعر البيع </th>
                            <th scope="col">سعر الشراء </th>
                            <th scope="col">اليوم </th>

                            <th scope="col">تعـــديل </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>


                            @foreach ($prices as $price)

                            <td>{{$price->currency->currency_name}}</td>
                            <td>{{$price->currency->abbreviation}}</td>
                            <td>{{$price->buy_price}}</td>
                            <td>{{$price->sale_price}}</td>
                            <td>{{$price->currency_date->format('m-d-Y')}}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$price->id}}">
                                    تعديل
                                </button>
                            </td>



                        </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{$price->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">



                                        <form action="{{ route('price.store', $price->id) }}" method="POST">

                                            @csrf

                                            <input id="currency_id{{$price->id}}" type="hidden" name="currency_id" class="form-control mb-3" placeholder=" العملة  " value="{{$price->currency_id}}">
                                            <input name="currency_id" type="text" class="form-control mb-3" placeholder=" العملة  " value="{{$price->currency->currency_name}}" disabled>
                                            <input id="buy_price{{$price->id}}" type="text" name="buy_price" class="form-control mb-3" placeholder="سعر الشراء " value="{{$price->buy_price}}">
                                            <input id="sale_price{{$price->id}}" type="text" name="sale_price" class="form-control mb-3" placeholder="سعر البيع " value="{{$price->sale_price}}">
                                            <input id="_token" type="hidden" value="{{ csrf_token() }}" />




                                            <button onclick="submitPriceForm('{{$price->id}}', event)" class="btn btn-twitter float-end px-5" type="submit">تم</button>

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
        </div>
    </div>

    <script>
        const submitPriceForm = (id, e) => {

            console.log(id)

            e.preventDefault()

            const data = {
                currency_id: document.getElementById("currency_id" + id).value,
                buy_price: document.getElementById("buy_price" + id).value,
                sale_price: document.getElementById("sale_price" + id).value,
                _token: document.getElementById("_token").value
            }

            const formData = new FormData()

            formData.append("currency_id", data.currency_id)
            formData.append("buy_price", data.buy_price)
            formData.append("sale_price", data.sale_price)
            formData.append("_token", data._token)

            console.log(id)
            console.log(data)

            // return
            $.ajax({
                type: "post",
                url: "price",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'json',
                success: (data) => {
                    console.log("data*************")
                    console.log(data)
                    location.replace("{{route('price.index')}}")
                },
                error: (error) => {
                    location.replace("{{route('price.index')}}")
                    console.log(error.responseJSON)
                }
            })
        }
    </script>


    @endsection