<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PDF;


class EmployeeReport extends Controller
{
    public function index(){

        return view('reports.employees_report');
           
       }

       public function Search_employees(Request $request){

        $rdio = $request->rdio;
    
        
            
        
    //  في حالة البحث بنوع الفاتورة
        
        if ($rdio == 1) {
           
              $start_at = date($request->start_at);
              $end_at = date($request->end_at);
              
              $employees = User::whereBetween('created_at',[$start_at,$end_at])->get();
              return view('reports.employees_report',compact('start_at','end_at', 'employees'))->withDetails($employees);

        } 
        
    //====================================================================
        
    // في البحث برقم الفاتورة
        else {
        $employees = User::select('*')->where('id','=',$request->id)->get();
        return view('reports.employees_report', compact('employees'))->withDetails($employees);
        
        }
    
        /////////////////////////////////////

           
     // في حالة البحث بنوع الفاتورة
        
    //     if ($rdio == 1) {
           
           
    //  // في حالة عدم تحديد تاريخ
    //         if ($request->type && $request->start_at =='' && $request->end_at =='') {
                
    //            $employees = User::select('*')->where('Status','=',$request->type)->get();
    //            $type = $request->type;
    //            return view('reports.employees_report',compact('type'))->withDetails($employees);
    //         }
            
    //         // في حالة تحديد تاريخ استحقاق
    //         else {
               
    //           $start_at = date($request->start_at);
    //           $end_at = date($request->end_at);
    //           $type = $request->type;
              
    //           $employees = User::whereBetween('e_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
    //           return view('reports.employees_report',compact('type','start_at','end_at'))->withDetails($employees);
              
    //         }
    
     
            
    //     } 
        
    // //====================================================================
        
    // // في البحث برقم الفاتورة
    //     else {
            
    //         $employees = User::select('*')->where('id','=',$request->id)->get();
    //         return view('reports.employees_report')->withDetails($employees);
            
    //     }
    
         
        }
        public function createPDF(Request $request) {
            // retreive all records from db
            // $employees = User::select('*')->where('id','=',$request->id)->get();
            // share employees to view
           // retreive all records from db
           $data = User::all();
           // share data to view
           view()->share('employee',$data);
           $pdf = PDF::loadView('employees_report', $data);
           // download PDF file with download method
           return $pdf->download('pdf_file.pdf');
          }
     
}
