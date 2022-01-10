<?php

namespace App\Http\Controllers;

use App\Zoom;
use App\Student;
use Illuminate\Http\Request;
use App\Services\ZoomService;
use Session;

class ZoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $webinars = Zoom::paginate(10);

        return view('zoom.index', compact('webinars'));
    }

    public function search(Request $request)
    {
        $query = $request->search;
        $webinars = Zoom::where('topic', 'LIKE','%'.$query.'%')
            ->orWhere('start_time', 'LIKE','%'.$query.'%')
            ->orWhere('end_time', 'LIKE','%'.$query.'%')
            ->paginate(10);
        return view('zoom.index', compact('webinars', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zoom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'topic' => 'required|min:3',
            'start' => 'required|min:3',
            'end' => 'required|min:3',
            'password' => 'required|min:3',
        ]);

        $webinarDetails = ZoomService::createWebinar($request);


        $webinar_id = $webinarDetails->id;

        $start_url = $webinarDetails->start_url;

        $join_url = $webinarDetails->join_url;

        $webinar = new Zoom();
        $webinar->topic = $validated['topic'];
        $webinar->start_time = $validated['start'];
        $webinar->end_time = $validated['end'];
        $webinar->password = $validated['password'];
        $webinar->webinar_id = $webinar_id;
        $webinar->start_url = $start_url;
        $webinar->join_url = $join_url;
        
        $webinar->save();

        return redirect('/zoom');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zoom  $zoom
     * @return \Illuminate\Http\Response
     */
    public function showParticipants(Zoom $zoom, $webinarId)
    {
        $webinarDetails = ZoomService::getListRegistree($webinarId);

        if(!isset($webinarDetails->registrants)){

            $students = $zoom->students()->paginate(10);
            
            return view('zoom.participants', compact('students', 'zoom', 'webinarId'));
            
        }else{
            // Session::put('Link expired', 'Expired');
            $participants = $webinarDetails->registrants;

            $participantEmails = array();

            foreach($participants as $participant){
                $participantEmails[] = $participant->email;
            }

            $filterStudents = Student::whereIn('email', $participantEmails)->get();

            foreach($filterStudents as $filterStudent){

                $checkStudent = $zoom->students()->where('student_id',$filterStudent->id)->get();
            
                if($checkStudent->isEmpty()){
                    $zoom->students()->attach($filterStudent->id);
                }
            }
            
            $students = $zoom->students()->paginate(10);

            return view('zoom.participants', compact('students', 'zoom', 'webinarId'));
        }

    }

    public function participantSearch(Request $request, Zoom $zoom, $webinarId)
    {
        $webinarDetails = ZoomService::getListRegistree($webinarId);

        $query = $request->search;

        if(!isset($webinarDetails->registrants)){

            $students = $zoom->students()->where('email', 'LIKE','%'.$query.'%')->paginate(10);
            // dd($students);
            
            return view('zoom.participants', compact('students', 'query', 'zoom', 'webinarId'));
            
        }else{
            // Session::put('Link expired', 'Expired');
            $participants = $webinarDetails->registrants;

            $participantEmails = array();

            foreach($participants as $participant){
                $participantEmails[] = $participant->email;
            }

            $filterStudents = Student::whereIn('email', $participantEmails)->get();

            foreach($filterStudents as $filterStudent){

                $checkStudent = $zoom->students()->where('student_id',$filterStudent->id)->get();
            
                if($checkStudent->isEmpty()){
                    $zoom->students()->attach($filterStudent->id);
                }
            }
            
            $students = $zoom->students()->where('email', 'LIKE','%'.$query.'%')->paginate(10);

            return view('zoom.participants', compact('students', 'query', 'zoom', 'webinarId'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zoom  $zoom
     * @return \Illuminate\Http\Response
     */
    public function edit(Zoom $zoom)
    {
        return view('zoom.edit', compact('zoom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zoom  $zoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zoom $zoom)
    {
        $webinarDetails = ZoomService::updateWebinar($request, $zoom->webinar_id);

        $zoom->topic = $request->topic;
        $zoom->start_time = $request->start;
        $zoom->end_time = $request->end;
        $zoom->password = $request->password;
        $zoom->save();

        return redirect('/zoom');
    }

    public function del(Zoom $zoom)
    {	
		return view("zoom.delete", compact("zoom"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zoom  $zoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zoom $zoom)
    {
        ZoomService::destroyWebinar($zoom->webinar_id);
        $zoom->delete();

        return redirect("zoom")->with('success', 'Zoom webinar has been deleted successfully.');
    }
}
