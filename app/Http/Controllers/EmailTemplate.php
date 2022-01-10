<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;

class EmailTemplate extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emailsTemplate = Email::paginate(10);
        return view('emailsTemplate.index', compact('emailsTemplate'));
    }

    public function search(Request $request)
    {
        $query = $request->search;
        $emailsTemplate = Email::where('name', 'LIKE','%'.$query.'%')->paginate(10);
        return view('emailsTemplate.index', compact('emailsTemplate', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('emailsTemplate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|min:3',
            'content' => 'required|min:3',
            'title' => 'required|min:3',
            'date' => 'required|date',
        ]);

        $mail = new Email();
        $mail->name = $validated['name'];
        $mail->content = $validated['content'];
        $mail->title = $validated['title'];
        $mail->date = $validated['date'];
        
        $mail->save();

        return redirect('/emailtemplate');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emailTemplate = Email::where('id', $id)->first();
        return view('emailsTemplate.show', compact('emailTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emailTemplate = Email::where('id', $id)->first();
        return view('emailsTemplate.edit', compact('emailTemplate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $emailTemplate = Email::where('id', $id)->first();
        $emailTemplate->name = $request->name;
        $emailTemplate->content = $request->content;
        $emailTemplate->title = $request->title;
        $emailTemplate->date = $request->date;
        $emailTemplate->save();

        return redirect('/emailtemplate');
    }

    public function del($id)
    {
        $emailTemplate = Email::where("id", $id)->first();
		
		return view("emailsTemplate.delete", compact("emailTemplate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {

        $mail = Email::where('id', $id)->first();

        $mail->delete();

        return redirect("emailtemplate")->with('success', 'Template information has been deleted successfully.');
    }
}
