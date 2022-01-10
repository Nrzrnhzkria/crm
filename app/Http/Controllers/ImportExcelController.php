<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Product;
use App\Package;
use App\Email;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Offer;
use Auth;

class ImportExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($product_id, $package_id)
    {
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
		$offer = Offer::orderBy('id','asc')->get();
        $data = Student::orderBy('id','desc')->paginate(15);
		$emails = Email::all();
        $count = 1;

        return view('admin.reports.importexcel', compact('data', 'product', 'package', 'offer', 'count', 'emails'));
    }

    public function import(Request $request, $product_id, $package_id )
    {
        
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();

        $prd_id = $product->product_id;
        $pkd_id = $package->package_id;
		$user_id = Auth::user()->user_id;

        Excel::import(new StudentImport($prd_id, $pkd_id, $user_id), request()->file('file'));

        return redirect('view/buyer/'.$product_id.'/'.$package_id)->with('importsuccess', 'The file has been inserted to queue, it may take a while to successfully import.');
    }

    public function export()
    {
        return Excel::download(new StudentExport, 'Students.xlsx');
    }
}
