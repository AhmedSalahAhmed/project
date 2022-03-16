@extends('manager/layouts.app')

@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header ">
                <form action="searchcurrency" method="get" role="search" autocomplete="off">
                    @csrf
                    <div class="row">

                        <!-- <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">تحديد نوع الفواتير</p><select class="form-control select2" name="type"
                                required>
                                <option value="{{ $type ?? 'حدد نوع الفواتير' }}" selected>
                                    {{ $type ?? 'حدد نوع الفواتير' }}
                                </option>

                                <option value="bank"> مدير بنك</option>
                                <option value="user">  موظف بنك</option>

                            </select>
                        </div>col-4 -->


                        <div class="col-lg-4 mg-t-20 mg-lg-t-0" id="id">
                            <p class="mg-b-10"> البحث باسم العملة\او الاسم المختصر</p>
                            <input type="text" class="form-control" id="currency_name" name="currency_name">
                            <button class="btn btn-twitter">بحث</button>

                        </div><!-- col-4 -->

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

<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('printThis.js')}}"></script>
<script>
    $(document).on('click', 'button', function() {
        var table = $('#print-table');

        $('.print').printThis({
            importCSS: true,
            header: "<h4 style='text-align:center;'> <?php echo date('Y-m-d'); ?> </h4><h3 style='text-align:center;'>تقرير اسعار العملات</h3>",
            
            doctypeString: '<div><h2  style="text-align:center;">بسم الله الرحمن الرحيم</h2>@foreach($banks as $bank)<h1 style="text-align:center;"> {{$bank->bank_name}} </h1> <img style="width:10%; text-align:right;" src={{asset("storage/".$bank->logo)}} alt="profile" /> @endforeach',
            copyTagClasses: true,
        });
    });

    $(document).ready(function() {

        $('input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'type_div') {
                $('#id').hide();
                $('#type').show();
                $('#start_at').show();
                $('#end_at').show();
            } else {
                $('#id').show();
                $('#type').hide();
                $('#start_at').hide();
                $('#end_at').hide();
            }
        });


    });
</script>

<script>

</script>



@endsection