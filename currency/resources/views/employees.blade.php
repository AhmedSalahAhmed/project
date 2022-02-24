
@include('includes.header')

@include('includes.navbar')

@include('includes.sidebar')
 
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   
                    <h4 class="card-title"> الموظفين</h4>
                    <p class="card-description"> موظفي <code class="rtl">بنك الخرطوم</code>
                    </p>
                    <button type="button" class="btn btn-twitter" data-bs-toggle="modal" data-bs-target="#exampleModal">
                 اضافة موظف
                </button>
                <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">الاسم</th>
                                    <th class="border-bottom-0">البريد الالكتروني </th>
                                    <th class="border-bottom-0"> العنوان </th>
                                    <th class="border-bottom-0">رقم الهاتف  </th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                              @foreach($role as $r)
                              @if($r->user_id == '')
                              <td>ahmed</td>
                                    <tr>
                                        <td>{{ $r->user_type }} </td>
                                       
                                    </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                        <div class="d-felx justify-content-center">
                        </div>
                  </div>
                </div>
            </div>
              

@extends('includes.footer')
