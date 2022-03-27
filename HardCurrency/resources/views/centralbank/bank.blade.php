@extends('centralbank/layouts.app')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    
    <div class="card">
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
        <div class="card-body">
            <h4 class="card-title"> البنوك</h4>
            <p class="card-description"> جميع البنوك تحت <code class="rtl">بنك السودان المركزي</code>
            </p>
            <button type="button" class="btn btn-twitter" data-bs-toggle="modal" data-bs-target="#addModal">
                اضافة بنك
            </button>
            <!-- Add Bank Modal -->
            <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exchangeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="{{ route('banks.store') }}" enctype="multipart/form-data" method="post" class="forms-sample" autocomplete="off">
                                @csrf

                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">إسم البنك </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bank_name" class="form-control" placeholder=" إسم البنك" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> الاسم المختصر </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="url" class="form-control" placeholder="الاسم المختصر لعنوان ال URL " required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">شعار البنك </label>
                                    <div class="col-sm-9">
                                        <input type="file" name="logo" id="logo" class="form-control" placeholder="شعار النك " />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> الولاية</label>
                                    <div class="col-sm-9">
                                        <select name="state" id="state" class="form-select mySelectAdd">

                                            <option value="">اختر الولاية</option>
                                            @foreach($states as $state)
                                            <option value="{{$state['value']}}" label="{{$state['label']}}"></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">المحلية </label>
                                    <div class="col-sm-9">
                                        <select name="district" id="locale" class="form-select mySelect2Add">
                                            @foreach (range(1, 18) as $i)
                                            @foreach($locales[0][$i] as $locale)
                                            <option value="{{$i}}" label="{{$locale['label']}}"></option>
                                            @endforeach
                                            @endforeach


                                        </select>
                                    </div>
                                </div>

                                <button class="btn btn-twitter float-end px-5" type="submit">تم</button>


                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- end add bank modal -->
            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th> شعار البنك </th>
                            <th> اسم البنك </th>
                            <th> العنوان </th>
                            <th> تاريخ الإنضمام للنظام </th>
                            <th> تعديل </th>
                            <th> حذف </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banks as $bank)

                        <tr>
                            <td class="py-1">
                                <img src="{{asset('storage/'.$bank->logo)}}" alt="image" />
                            </td>
                            <td> {{$bank->bank_name}}</td>

                            <td>{{$bank->state}}</td>
                            <td>{{$bank->created_at}}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$bank->id}}">
                                    تعديل
                                </button>
                            </td>
                            <td>
                                <form method="post" action="{{route('banks.destroy',$bank->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{$bank->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-bg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">



                                        <form action="{{ route('banks.update', $bank->id) }}" method="post">

                                            @method('put')

                                            @csrf


                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">اسم البنك </label>
                                            <input type="text" id="bank_name{{$bank->id}}" name="bank_name" class="form-control mb-3" placeholder=" اسم البنك " value="{{$bank->bank_name}}" />
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">الولاية </label>
                                            <select onchange="updateSelectChange('{{$bank->id}}', event)" name="state" id="state{{$bank->id}}" class="form-select mySelect">
                                                <option value="">اختر الولاية</option>
                                                @foreach($states as $state)
                                                <option selected="{{$state['value'] == $bank->state?true: false}}" value="{{$state['value']}}" label="{{$state['label']}}"></option>
                                                @endforeach
                                            </select>
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">المحلية </label>
                                            <select name="district" id="locale{{$bank->id}}" class="form-select mySelect2">
                                                @foreach (range(1, 18) as $i)
                                                @foreach($locales[0][$i] as $locale)
                                                <option selected="{{$i == $bank->district?true: false}}" value="{{$i}}" label="{{$locale['label']}}"></option>
                                                @endforeach
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="_token" value="{{ csrf_token() }}" />
                                            <button onclick="submitBanksForm('{{$bank->id}}', event)" class="btn btn-twitter float-end px-5" type="submit">تم</button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Edit Modal -->
                        @endforeach

                    </tbody>
                </table>
                <div>{{$banks->links()}}</div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#state").change(function() {
        console.log("h");
        if ($(this).data('options') === undefined) {
            /*Taking an array of all options-2 and kind of embedding it on the select1*/
            $(this).data('options', $('#locale option').clone());
        }
        var id = $(this).val();
        var options = $(this).data('options').filter('[value=' + id + ']');
        $('#locale').html(options);
    });


    function updateSelectChange(val, e){
        e.preventDefault()
        $("#state"+val).change(function() {
            console.log("h");
            if ($(this).data('options') === undefined) {
                /*Taking an array of all options-2 and kind of embedding it on the select1*/
                $(this).data('options', $('#locale'+val+' option').clone());
            }
            var id = $(this).val();
            var options = $(this).data('options').filter('[value=' + id + ']');
            $('#locale'+ val).html(options);
        });
    }
    
    function submitBanksForm(id, e) {

        console.log(id)

        e.preventDefault()

        const data = {
            bank_name: document.getElementById("bank_name" + id).value,
            state: document.getElementById("state" + id).value,
            district: document.getElementById("locale" + id).value,
            _token: document.getElementById("_token").value
        }

        const formData = new FormData()

        formData.append("bank_name", data.bank_name)
        formData.append("state", data.state)
        formData.append("district", data.district)
        formData.append("_token", data._token)

        console.log(id)
        console.log(data)

        // return
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "banks/" + id + "?_method=put",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: (data) => {
                console.log("data*************")
                console.log(data)
                location.replace("{{route('banks.index')}}")
            },
            error: (error) => {
                location.replace("{{route('banks.index')}}")
                console.log(error.responseJSON)
            }
        })
    }
</script>

@endsection