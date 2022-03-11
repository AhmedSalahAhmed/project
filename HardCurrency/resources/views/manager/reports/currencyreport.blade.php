
@include('manager.includes.header')

@include('manager.includes.navbar')

@include('manager.includes.sidebar')
 
   
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


                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="id">
                            <p class="mg-b-10"> البحث باسم العملة المختصر</p>
                            <input type="text" class="form-control" id="currency_name" name="currency_name">

                        </div><!-- col-4 -->


                  
                    </div><br>

                    <div class="row">
                    <div class="col-sm-1 col-md-1">
                    <button class="btn btn-twitter">بحث</button>

                        </div>
                    
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <div class="col-sm-1 col-md-1">
                            <button class="btn btn-success print-window">طباعة</button>
                            <input type="button" value="click"
                    onclick="printDiv()"> 
                        </div>
                    </div>

                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive" id="GFG">
                    @if (isset($details))
                        <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">العملة</th>
                                    <th class="border-bottom-0">سعر الشراء </th>
                                    <th class="border-bottom-0">سعر البيع </th>
                                    <th class="border-bottom-0"> الرصيد </th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                
                             
                                @foreach ($currencies as $currency)
                                
                                   
                                    <tr>
                                       
                                        <td>{{ $currency->id }} </td>
                                        <td>{{ $currency->currency_name }}&nbsp;&nbsp;&nbsp; {{ $currency->abbreviation }}</td>
                                        <td>{{ $currency->buy_price }}</td>
                                        <td>{{ $currency->sale_price }}</td>
                                        <td>{{ $currency->balance }}    {{ $currency->symbol }}</td>
                                       
                                    </tr>
                                    
                               @endforeach
                            </tbody>
                        </table>

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

<script>
    $(document).ready(function() {

        // $('#id').hide();

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

        $('.print-window').click(function() {
             window.print();
        });
    });
    
        function printDiv() {
            var divContents = document.getElementById("GFG").innerHTML;
            var a = window.open('', '', 'height=900, width=1100');
            a.document.write('<html>');
            // a.document.write("<body dir='rtl' > <h1>  اسعار العملات <br><ul class='nav'><li class='nav-item nav-profile'><a href='#'' class='nav-link'><div class='nav-profile-image'><img src='{{asset('assets/images/cbos.jpeg')}}' alt='profile'><span class='login-status online'></span><!--change to offline or busy as needed--></div><div class='nav-profile-text d-flex flex-column'><span class='font-weight-bold mb-2'>{{ Auth::user()->name }}</span><span class='text-secondary text-small'>{{ Auth::user()->email}}</span></div><i class='mdi mdi-bookmark-check text-success nav-profile-badge'></i></a></li>');
            a.document.write("<body dir='rtl' > <h1>  اسعار العملات <br></h1>@foreach($banks as $bank)<ul class='nav'><li class='nav-item nav-profile'><a href='#'' class='nav-link'><div class='nav-profile-image'><img src='{{asset('storage/'.$bank->logo)}}'  alt='profile' /><span class='login-status online'></span><!--change to offline or busy as needed--></div><div class='nav-profile-text d-flex flex-column'><span class='font-weight-bold mb-2'>{{ Auth::user()->name }}</span><span class='text-secondary text-small'>{{ Auth::user()->email}}</span></div><i class='mdi mdi-bookmark-check text-success nav-profile-badge'></i></a></li></ul>@endforeach");
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    
</script>


          
@extends('manager.includes.footer')
   