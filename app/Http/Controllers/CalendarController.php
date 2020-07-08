<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class CalendarController extends Controller
{



    public function fetchData()
    {

    //    $events = Task::all();
    //     dd($events);
        return response()->json([
            ["title"=>"Musko sisanje Slavko",
            "start"=>"2020-07-14T09:30:00",
            "end"=>"2020-07-14T10:15:00"
        ],
        ["title"=>"Zensko sisanje Zorica",
        "start"=>"2020-07-14T10:30:00",
        "end"=>"2020-07-14T12:15:00"
    ]
            ]);
    }    //
}
