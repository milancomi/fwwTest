<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    public function addEvent(Request $request)
    {

        $title = $request->title;
        $startEvent = $request->date."T00:00:01";
        $endEvent = $request->date."T23:59:00";
        // Fastest solution for fixed Event Day time

        $colorEvent  = '#'.mt_rand(100000,999999);
        // random color
        // mt_rand faster solution

        $newTask = Task::create([
            'start'=>$startEvent,
            'end'=>$endEvent,
            'title'=>$title,
            'backgroundColor'=>$colorEvent,
            'classNames'=>'myClass'
        ]);


        return response()->json($newTask);
    }





    public function deleteEvent(Request $request)
    {
        if($request->ajax())
        {
            Task::find($request->event_id)->delete();
        }

    }


    public function updateEvent(Request $request)
    {
        if($request->ajax())
        {
            $task = Task::find($request->event_id);
            $task->update([
                'title'=>$request->event_title,
            ]);
        }
    }
    public function fetchData()
    {

       $events = Task::all();

        return response()->json($events);
    }
}
