@extends('manager/layouts.app')

@section('content')

<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="card-header ">
        <h4>تقارير العملات
        <a href="bankreports" style="float: left;">رجوع </a>

            <form action="searchcurrency" method="get" role="search" autocomplete="off">
                @csrf
                <div class="row">

                    <div class="col-lg-4 mg-t-20 mg-lg-t-0" id="id">
                        <p class="mg-b-10"> البحث باسم العملة\او الاسم المختصر</p>
                        <input type="text" class="form-control" id="currency_name" name="currency_name">
                        <button class="btn btn-twitter">بحث</button>

                    </div>

                    <div class="col-lg-3" id="start_at">
                        <label for="exampleFormControlSelect1">من تاريخ</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div><input class="form-control" value="{{ $start_at ?? '' }}" name="start_at" placeholder="YYYY-MM-DD" type="date">
                        </div><!-- input-group -->
                    </div>

                    <div class="col-lg-3" id="end_at">
                        <label for="exampleFormControlSelect1">الي تاريخ</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div><input name="end_at" class="form-control" value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="date">
                        </div><!-- input-group -->
                    </div>

                </div><br>
                <div class="row">
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
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
                    <table id="print-table" class="table  key-buttons text-md-nowrap" style=" text-align: right">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">العملة</th>
                                <th class="border-bottom-0">سعر الشراء </th>
                                <th class="border-bottom-0">سعر البيع </th>


                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($currencies as $currency)


                            <tr>

                                <td>{{ $currency->id }} </td>
                                <td>{{ $currency->currency_name }}&nbsp;&nbsp;&nbsp; {{ $currency->abbreviation }}</td>
                                <td>{{ $currency->buy_price }}</td>
                                <td>{{ $currency->sale_price }}</td>

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