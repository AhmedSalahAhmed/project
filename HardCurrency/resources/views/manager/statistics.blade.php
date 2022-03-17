@extends('manager/layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-info text-white me-2">
            <i class="mdi mdi-home"></i>
          </span> الإحصائيات
        </h3>

      </div>

      <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
              <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3"> العمليات <i class="mdi mdi-chart-line mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">{{$proccesses}} </h2>
            </div>
          </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
              <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3"> الفروع <i class="mdi mdi-diamond mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">{{$branches}}</h2>
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

      </div>
    </div>
  </div>
</div>


@endsection