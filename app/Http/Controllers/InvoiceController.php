<?php

namespace App\Http\Controllers;

use App\Invoice;
use Carbon\Carbon;
use App\Student;
use App\Membership_Level;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $students = Student::whereIn('stud_id',['M1981113016705iqbal1'])->whereNotNull('level_id')->get()->unique('email');

        $student = $students[0];

        $invoice = Invoice::where('student_id', $student->id)->first();
        
        $content = Membership_Level::where('level_id', $student->level_id)->first();

        $current_date = Carbon::now()->toFormattedDateString();

        return view('invoice.invoice', compact('content', 'student', 'current_date', 'invoice'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        return view('invoice.success');
    }

    public function fail()
    {
        return view('invoice.fail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
