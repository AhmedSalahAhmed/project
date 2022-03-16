@extends('manager/layouts.app')

@section('content')

<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="card-header ">
            <form action="bankaccountreport" method="get" role="search" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="form-group row">
                        <div class="col-sm-3 ">

                            <select name="currency_id" id="" class="form-select" onchange="select()">
                                <option value=""> اختار العملة </option>

                                @foreach($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->currency_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="cole-sm-3">
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