@extends('bank/layouts.app')

@section('content')
<div class="content-wrapper">

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



            <!-- Button trigger modal -->

            <button type="button" class="btn btn-block login-btn mb-4" data-bs-toggle="modal" data-bs-target="#exchangeModal">
                تغير عملة نقداً
            </button>
            <button type="button" class="btn btn-block btn-success mb-4" data-bs-toggle="modal" data-bs-target="#invoice">
                 الفاتورة
            </button>
            <!-- Modal -->
            <div class="modal fade" id="invoice" tabindex="-1" aria-labelledby="invoiceLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">          
                        <div class="modal-body">
                        
                        <div class="card">
                            <div class="card-header">
                                <span class="float-right">فاتورة تبديل العملة</span>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-4 col-sm-5">
                                    </div>
                                    <div class="col-lg-4 col-sm-5 ml-auto">
                                        @if($last_currency)
                                        <table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left">
                                                        <strong>العميل</strong>
                                                    </td>

                                                    <td class="right">
                                                        {{$last_process->client_name}}
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="left">
                                                        <strong>العملة</strong>
                                                    </td>
                                                    <td class="right">{{$last_currency->currency_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left">
                                                        <strong>المبلغ</strong>
                                                    </td>
                                                    <td class="right">
                                                        <strong>{{$last_process->amount}}{{$last_currency->symbol}}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="left">
                                                        <strong>المبلغ بالجنيه</strong>
                                                    </td>
                                                    <td class="right">
                                                    {{$last_process->sdgamount}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="left">
                                                        <strong>تاريخ المعاملة</strong>
                                                    </td>
                                                    <td class="right">
                                                    {{$last_process->created_at}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exchangeModal" tabindex="-1" aria-labelledby="exchangeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="{{ route('bank.store') }}" method="post" class="forms-sample">
                                @csrf

                                <div class="form-group row">
                                    
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">إسم العميل </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="client_name" class="form-control" placeholder=" إسم العميل" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">رقم الهاتف</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="client_phone" class="form-control" placeholder="رقم الهاتف" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">رقم الهوية</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="id_number" class="form-control" placeholder="رقم الهوية" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> نوع العملة</label>
                                    <div class="col-sm-9">
                                        <select name="bank_currency_id" id="currency" class="form-select">
                                            <option value=""> اختار العملة </option>

                                            @foreach ($bankcurrencies as $bankcurrency)

                                            <option id="option" value="{{$bankcurrency->id}}">{{$bankcurrency->currency_name}}</option>
                                            @endforeach

                                        </select>
                                        <input type="hidden" name="buy_price" id="buyprice" value=""/>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> المبلغ </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="amount" name="amount" class="form-control" placeholder="  المبلغ بالعملة الاجنبية" onkeyup="mult(this.value);"  required>
                                        <!-- <input type="text" id="sdgamount" name="sdgamount" hidden> -->

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> القيمة بالجنيه : </label>
                                    <div class="col-sm-9">
                                        <input style="color: #4688e3; font-weight:bold;" id="sdgamount" type="text" name="sdgamount" class="form-control" placeholder=" المبلغ بالجنيه السوداني" disabled>
                                    </div>
                                </div>
                                <button class="btn btn-twitter float-end px-5" type="submit" >تم</button>
                            </form>
                            @include('sweetalert::alert')
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body login-card">
                    <h4 class="card-title">أسعار الصرف </h4>


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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bankcurrencies as $bankcurrency)
                                <tr>
                                    <td>{{$bankcurrency->currency_name}}</td>
                                    <td>{{$bankcurrency->buy_price}}</td>
                                    <td>{{$bankcurrency->sale_price}}</td>
                                    <td>{{($bankcurrency->buy_price + $bankcurrency->sale_price) / 2}}</td>
                                </tr>
                                @endforeach

                                <script>
                                    onCurrencySelected = (selected) => {
                                        console.log(selected)
                                    }

                                    function mult(value) {
                                        var currency = document.getElementById('currency').value;
                                        var amount = document.getElementById('amount').value;
                                        $.ajax({
                                            type: "get",
                                            url: "{{route('getTotal')}}",
                                            headers: {
                                                "Content-Type": "application/json",
                                                "Accept": "application/json"
                                            },
                                            data: {
                                                currency_id: currency,
                                                total: amount
                                            },
                                            success: (data) => {
                                                console.log(data)
                                                document.getElementById('sdgamount').value = data;
                                                document.getElementById('buyprice').value = data;
                                            },
                                            fail: (error) => {
                                                console.log(error)
                                            }
                                        })

                                    }
                                </script>
                            </tbody>
                        </table>
                    </div>
                 @endsection