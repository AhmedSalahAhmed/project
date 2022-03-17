@extends('manager/layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">

    <div class="card mg-b-20">
        <form action="processreport" method="get" role="search" autocomplete="off">
            @csrf
            <div class="col-lg-12 grid stretch-card">
                <div class="card-body">


                    <div class="card-title">تقارير عمليات
                        @foreach($banks as $bank)
                        {{$bank->bank_name}}
                        @endforeach
                        
                        <a href="bankreports" style="float: left;">رجوع </a>

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
                        <div class="col-sm-3 ">

                            <select name="branch_id" id="" class="form-select" onchange="select()">
                                <option value=""> الفرع </option>

                                @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 ">

                            <select name="employee_id" id="" class="form-select" onchange="select()">
                                <option value=""> الموظف </option>

                                @foreach($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->employee_name}}</option>
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
                        </div>
                        <div class="col-sm-3 ">

                            <button class="btn btn-twitter">بحث</button>

                        </div>

                    </div>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            @if (isset($details))

            <div id="print">
                <table class="table">
                    <thead>
                        <tr>
                            <th> العميل </th>
                            <th> المبلغ </th>
                            <th>العملة </th>
                            <th> الموظف </th>
                            <th> الفرع</th>
                            <th> تاريخ المعاملة </th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($processes as $process)

                        <tr>
                            <td> {{$process->client_name}}</td>


                            <td> {{$process->amount}} {{$process->symbol}}</td>


                            <td class="py-1">
                                {{$process->currency_name}}
                            </td>
                            <td>
                                {{$process->employee_name}}
                            </td>
                            <td>
                                {{$process->branch_name}}
                            </td>
                            <td>
                                {{$process->created_at}}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>


            @endif
        </div>

        <div class="col-sm-1 col-md-1 mt-4 mb-4">
            <button id="printBtn" class="btn btn-success">طباعة</button>

        </div>

    </div>
</div>



@endsection