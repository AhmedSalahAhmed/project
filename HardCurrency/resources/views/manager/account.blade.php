@include('manager.includes.header')

@include('manager.includes.navbar')

@include('manager.includes.sidebar')


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
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"> خزينة البنك من العملات الأجنبية
                 
                </h4>

                @if (session('success'))

                <div class="alert alert-success">
                    {{ session('success')}}
                </div>

                @endif
                <div class="table-responsive">
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

                <div class="d-felx justify-content-center">

                </div>
                @include('manager.includes.footer')