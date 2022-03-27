@extends('centralbank/layouts.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card mg-b-20">
        <form action="processesreport" method="get" role="search" autocomplete="off">
            @csrf
            <div class="col-lg-12 grid stretch-card">
                <div class="card-body">
                    <div class="card-title">تقارير حسابات البنوك
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3" id="start_at">
                            <div class="input-group">
                                <label for="exampleFormControlSelect1">من </label>
                                <input class="form-control" value="{{ $start_at ?? '' }}" name="start_at" placeholder="YYYY-MM-DD" type="date">
                            </div>
                        </div>
                        <div class="col-lg-3" id="end_at">
                            <div class="input-group">
                                <label for="exampleFormControlSelect1">الي </label>

                                <input name="end_at" class="form-control" value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <!-- <div class="col-sm-3 ">

                            <select name="bank_id" id="" class="form-select" onchange="select()">
                                <option value=""> البنك </option>

                                @foreach($banks as $bank)
                                <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 ">

                            <select name="currency_id" id="" class="form-select" onchange="select()">
                                <option value=""> العملة </option>

                                @foreach($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->currency_name}}</option>
                                @endforeach
                            </select>
                        </div> -->
                        <div class="col-sm-3 ">

                            <button class="btn btn-twitter">بحث</button>

                        </div>

                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <div class="printAccount">
                <table class="table rtl talbe-bordered">
                    <thead>
                        <tr></tr>
                        <tr>
                            <th scope="col">العملة </th>
                            <th scope="col">الرمز </th>
                            <th scope="col">البنك </th>
                            <th scope="col"> الرصيد </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($process as $account)
                            <td>{{$account->currency_name}}</td>
                            <td>{{$account->abbreviation}}</td>
                            <td>{{$account->bank_name}}</td>
                            <td>{{$account->amount}} {{$account->symbol}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-1 col-md-1 mt-4 mb-4">
            <button class="btn btn-success accountPrint">طباعة</button>
        </div>
    </div>
</div>
@endsection