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
        $startEvent = $request->start."T00:00:00";
        $endEvent = $request->end."T00:00:00";
        // Fastest solution for fixed Event Day time

        $colorEvent  = '#'.mt_rand(100000,999999);
        // random color
        // mt_rand faster solution

        $newTask = Task::create([
            'start'=>$startEvent,
            'end'=>$endEvent,
            'title'=>$title,
            'backgroundColor'=>$colorEvent
        ]);


        return response()->json($newTask);
    }


    public function fetchData()
    {

       $events = Task::all();

        return response()->json($events);



        return response()->json([
            ["title"=>"Musko sisanje Slavko",
            "start"=>"2020-07-14T09:30:00",
            "end"=>"2020-07-14T10:15:00",
        ],
        ["title"=>"Zensko sisanje Zorica",
        "start"=>"2020-07-14T10:30:00",
        "end"=>"2020-07-14T12:15:00"
    ]
            ]);
    }    //
}
