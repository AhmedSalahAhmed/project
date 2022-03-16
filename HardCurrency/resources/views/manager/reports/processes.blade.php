@extends('manager/layouts.app')

@section('content')

<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="card-header ">
            <form action="processreport" method="get" role="search" autocomplete="off">
                @csrf
                <div class="row">




<div class="card-header">تقارير العمليات الخاصة بالبنك</div>
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
                                <option value=""> اختار العملة </option>

                                @foreach($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->currency_name}}</option>
                                @endforeach
                            </select>
                           
                            
                            
                        </div>
                        <div class="col-sm-3 ">

                            <button class="btn btn-twitter">بحث</button>

                           
                            
                            
                        </div>
                        
                    </div>
                    <!-- <div class="col-lg-4 mg-t-20 mg-lg-t-0" id="id">
                        <p class="mg-b-10"> البحث باسم العملة\او الاسم المختصر</p>
                        <input type="text" class="form-control" id="currency_name" name="currency_name">
                        <button class="btn btn-twitter">بحث</button>

                    </div>col-4 -->


                    <!-- <div class="col-lg-3" id="start_at">
                        <label for="exampleFormControlSelect1">من تاريخ</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div><input class="form-control" value="{{ $start_at ?? '' }}" name="start_at" placeholder="YYYY-MM-DD" type="date">
                        </div>
                    </div>

                    <div class="col-lg-3" id="end_at">
                        <label for="exampleFormControlSelect1">الي تاريخ</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div><input name="end_at" class="form-control" value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="date">
                        </div>
                    </div> -->

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