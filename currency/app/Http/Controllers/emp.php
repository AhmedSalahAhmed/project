<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use PDF;
class emp extends Controller {
    // Display user data in view
    public function showEmployees(){
      $employee = User::all();
      return view('pdf_view', compact('employee'));
    }
    // Generate PDF
    public function createPDF() {
      // retreive all records from db

      $data = User::all();
      $data->toArray();
        
      // share data to view
      view()->share('employee',$data);
      $pdf = PDF::loadView('pdf_view', compact('data'));
      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');
    }
}