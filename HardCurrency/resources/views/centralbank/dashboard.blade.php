@include('centralbank.includes.header')

@include('centralbank.includes.navbar')
@include('centralbank.includes.sidebar')

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-info text-white me-2">
      <i class="mdi mdi-home"></i>
    </span> الإحصائيات
  </h3>
  <form  action="{{route('statistics.store')}}" method="post">
    @csrf
    <select name="currency_id" id="" class="form-select">
      <option value="">اختار عملة</option>

      @foreach($currencies as $currency)
      <option value="{{$currency->id}}">{{$currency->currency_name}}</option>
      @endforeach
    </select>
    <br>
    <button type="submit" class="btn btn-twitter">حساب العملة في كل البنوك</button>
  </form>
</div>
<div class="row">
  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-gradient-danger card-img-holder text-white">
      <div class="card-body">
        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3"> عدد البنوك المستخدمة <i class="mdi mdi-chart-line mdi-24px float-right"></i>
        </h4>
        <h2 class="mb-5">{{$banks}} </h2>
        <!-- <h6 class="card-text">زيادة بنسبة 60%</h6> -->
      </div>
    </div>
  </div>

  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-gradient-success card-img-holder text-white">
      <div class="card-body">
        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3">صافي الدخل الشهري <i class="mdi mdi-diamond mdi-24px float-right"></i>
        </h4>
        <h2 class="mb-5">{{$sdgamount}}</h2>
        <!-- <h6 class="card-text">زيادة بنسبة 5%</h6> -->
      </div>
    </div>
  </div>

  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-gradient-info card-img-holder text-white">
      <div class="card-body">

        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3">اجمالي مخزون العملة <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
        </h4>
        <h2 class="mb-5">{{$balance}}</h2>
        <!-- <h6 class="card-text"> نقصان بنسبة 10%</h6> -->
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-7 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="clearfix">
          <h4 class="card-title float-left">أكثر العملات تداولاً</h4>
          <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
        </div>
        <canvas id="visit-sale-chart" class="mt-4"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-5 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">معدل العمليات</h4>
        <canvas id="traffic-chart"></canvas>
        <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
      </div>
    </div>
  </div>
</div>



@extends('centralbank.includes.footer')