@include('centralbank.includes.header')

@include('centralbank.includes.navbar')
@include('centralbank.includes.sidebar')

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
        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3"> متوسط السحب اليومي <i class="mdi mdi-chart-line mdi-24px float-right"></i>
        </h4>
        <h2 class="mb-5">$ 15,0000</h2>
        <h6 class="card-text">زيادة بنسبة 60%</h6>
      </div>
    </div>
  </div>
  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-gradient-info card-img-holder text-white">
      <div class="card-body">
        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3">متوسط الإيداع اليومي <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
        </h4>
        <h2 class="mb-5">$ 45,6334 </h2>
        <h6 class="card-text"> نقصان بنسبة 10%</h6>
      </div>
    </div>
  </div>
  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-gradient-success card-img-holder text-white">
      <div class="card-body">
        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3">صافي الأرباح الشهرية <i class="mdi mdi-diamond mdi-24px float-right"></i>
        </h4>
        <h2 class="mb-5">95,5741</h2>
        <h6 class="card-text">زيادة بنسبة 5%</h6>
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
          

<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div id="pieChart" style="height: 360px; width: 100%;">
      </div>
    </div>
    <div class="col-md-6">
      <div id="columnChart" style="height: 360px; width: 100%;">
      </div>
    </div>
  </div>
</div>


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
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">آخر المعاملات</h4>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th> الموظف </th>
                <th> العملية </th>
                <th> الحالة </th>
                <th> التاريخ </th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <img src="assets/images/faces/face1.jpg" class="me-2" alt="image"> صديق عبدالله
                </td>
                <td> ايداع عملة اجنبية </td>
                <td>
                  <label class="badge badge-gradient-success">تمت</label>
                </td>
                <td>
                
                </td>

              </tr>
              <tr>
                <td>
                  <img src="assets/images/faces/face2.jpg" class="me-2" alt="image"> سارة عمر
                </td>
                <td> ايداع عملة اجنبية </td>
                <td>
                  <label class="badge badge-gradient-warning">جاري التنفيذ</label>
                </td>
               

              </tr>
              <tr>
                <td>
                  <img src="assets/images/faces/face3.jpg" class="me-2" alt="image"> احمد صلاح الدين
                </td>
                <td> تحويل عبر بطاقة فيزا </td>
                <td>
                  <label class="badge badge-gradient-info"> ايقاف مؤقت</label>
                </td>
                <td> Dec 16, 2017 </td>

              </tr>
              <tr>
                <td>
                  <img src="assets/images/faces/face4.jpg" class="me-2" alt="image"> عبد الكريم عمر
                </td>
                <td> سحب عملة اجنبية </td>
                <td>
                  <label class="badge badge-gradient-danger">رُفِضت</label>
                </td>
                <td> Dec 3, 2017 </td>

              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


@extends('centralbank.includes.footer')