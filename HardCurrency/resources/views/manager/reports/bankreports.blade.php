@extends('manager/layouts.app')

@section('content')

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
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">تقارير
                @foreach($banks as $bank)
                {{$bank->bank_name}}
                @endforeach
            </h4>

            @if (session('success'))

            <div class="alert alert-success">
                {{ session('success')}}
            </div>

            @endif
            <div class="row">
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <h4 class="font-weight-normal mb-3"> العمليات
                            </h4>
                            <h2 class="mb-5">جميع العمليات في البنك </h2>
                            <a href="processreport" class="btn login-btn">افتح التقرير</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                        <div class="card-body">
                            <h4 class="font-weight-normal mb-3"> العملات
                            </h4>
                            
                            <h2 class="mb-5"> تقارير اسعار الصرف  </h2>
                            <a href="searchcurrency" class="btn btn-danger">افتح التقرير</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-info card-img-holder text-white">
                        <div class="card-body">

                            <h4 class="font-weight-normal mb-3">  الخزينة
                            </h4>
                            <h2 class="mb-5"> خزينة البنك من العملات الاجنبية</h2>
                            <a href="bankaccountreport" class="btn login-btn">افتح التقرير</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">

            </div>

        </div>
    </div>
</div>
@endsection