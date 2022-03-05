@include('centralbank.includes.header')

@include('centralbank.includes.navbar')

@include('centralbank.includes.sidebar')


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
                <div class="row">
                    <h4 class="card-title">العملات المعتمدة لدى بنك السودان المركزي </h4>
                    <h4 class="card-title float-left"> <?php echo date('Y-m-d'); ?> </h4>
                </div>


                @if (session('success'))

                <div class="alert alert-success">
                    {{ session('success')}}
                </div>

                @endif



                <div class="table-responsive">

                    <table class="table">

                        <thead>
                            <tr>
                                <th scope="col"> اسم العملة </th>
                                <th scope="col"> الرمز </th>
                                <th scope="col">سعر البيع </th>
                                <th scope="col">سعر الشراء </th>
                                <th scope="col">اليوم </th>

                                <th scope="col">تعـــديل </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>


                                @foreach ($prices as $price)

                                <td>{{$price->currency->currency_name}}</td>
                                <td>1 {{$price->currency->abbreviation}}</td>
                                <td>{{$price->buy_price}}</td>
                                <td>{{$price->sale_price}}</td>
                                <td>{{$price->currency_date}}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$price->id}}">
                                        تعديل
                                    </button>
                                </td>



                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{$price->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">



                                            <form action="{{ route('price.store', $price->id) }}" method="POST">

                                                @csrf

                                                <input type="hidden" name="currency_id" class="form-control mb-3" placeholder=" العملة  " value="{{$price->currency_id}}">
                                                <input type="text" name="currency_id" class="form-control mb-3" placeholder=" العملة  " value="{{$price->currency->currency_name}}" disabled>
                                                <input type="text" name="buy_price" class="form-control mb-3" placeholder="سعر الشراء " value="{{$price->buy_price}}">
                                                <input type="text" name="sale_price" class="form-control mb-3" placeholder="سعر البيع " value="{{$price->sale_price}}">




                                                <button class="btn btn-twitter float-end px-5" type="submit">تم</button>

                                            </form>
                                            @include('sweetalert::alert')

                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>





                @extends('centralbank.includes.footer')