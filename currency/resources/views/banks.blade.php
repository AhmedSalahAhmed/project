
@include('includes.header')

@include('includes.navbar')

@include('includes.sidebar')
 
   
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> البنوك</h4>
                    <p class="card-description"> جميع البنوك تحت <code class="rtl">{{Auth::user()->name}}</code>
                    </p>
               
                    <table class="table">
                      <thead>
                        <tr>
                          <th> صورة البنك </th>
                          <th> اسم البنك </th>
                          <th> البريد الالكتروني </th>
                          <th> عنوان البنك </th>
                          <th> ادارة    </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="py-1">
                            <img src="../../assets/images/bok.webp" alt="image" />
                          </td>
                          <td> بنك الخرطوم </td>
                          <td>
                                khartoum@bank.com
                          </td>
                          <td>العمارات  , الخرطوم , السودان</td>
                          <td>
                            <button type="button" class="btn btn-success" >
                            تعديل
                            </button> 
                            
                                
                                    <input type="submit" class="btn btn-danger" value="حذف">
                            
                            </td> 
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="../../assets/images/fisal.jpeg" alt="image" />
                          </td>
                          <td>   بنك فيصل الاسلامي السوداني</td>
                          <td>
                            fisal@fisal.com
                          </td>
                          <td>امدرمان  , الخرطوم , السودان</td>
                          <td>
                            <button type="button" class="btn btn-success" >
                            تعديل
                            </button> 
                            
                                
                                    <input type="submit" class="btn btn-danger" value="حذف">
                            
                            </td> 
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="../../assets/images/nile.jpeg" alt="image" />
                          </td>
                          <td> بنك النيل</td>
                          <td>
                            nile@bank.com
                          </td>
                          <td>الخرطوم  , الخرطوم , السودان</td>
                          <td>
                            <button type="button" class="btn btn-success" >
                            تعديل
                            </button> 
                            
                                
                                    <input type="submit" class="btn btn-danger" value="حذف">
                            
                            </td> 
                        </tr>
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>       
                                   

             
@extends('includes.footer')
   