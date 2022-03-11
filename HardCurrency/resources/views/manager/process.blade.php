@include('manager.includes.header')

@include('manager.includes.navbar')

@include('manager.includes.sidebar')


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
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
            <!-- Display message -->

            @if (session('success'))

            <div class="alert alert-success">
                {{ session('success')}}
            </div>

            @endif
            <h4 class="card-title"> العمليات </h4>
            <!-- <p class="card-description">    <code class="rtl">مدراء</code>البنوك
                    </p> -->

            <table class="table">
                <thead>
                    <tr>
                        <th> العميل </th>
                        <th> المبلغ </th>
                        <th>العملة </th>
                        <th> الموظف </th>
                        <th> الفرع</th>
                        <th> تاريخ المعاملة  </th>


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
    </div>
</div>



@extends('manager.includes.footer')