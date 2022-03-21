@extends('manager/layouts.app')

@section('content')

<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="card-header ">
            <h4>تقارير خزينة البنك من العملات الاجنبية
        <a href="bankreports" style="float: left;">رجوع </a>

        </h4>   
            <form action="bankaccountreport" method="get" role="search" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="form-group row">
                        <div class="col-lg-3 ">

                            <select name="currency_id" id="" class="form-select" onchange="select()">
                                <option value=""> اختار العملة </option>

                                @foreach($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->currency_name}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-twitter">بحث</button>

                        </div>
                        
                    </div>
                </div>

            </form>
        </div>
        <div class="col-sm-1 col-md-1">
            <button id="print" class="btn btn-success">طباعة</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (isset($details))

                <div class="print">
                    <table class="table">

                        <thead>
                            <tr></tr>
                            <tr>
                                <th scope="col">العملة </th>
                                <th scope="col">الرمز </th>
                                <th scope="col"> الرصيد </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $account)
                            <tr>

                                <td>{{$account->currency_name}}</td>
                                <td>{{$account->abbreviation}}</td>
                                <td>{{$account->balance}} {{$account->symbol}}</td>


                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>


                @endif
            </div>
        </div>
    </div>
</div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->



@endsection