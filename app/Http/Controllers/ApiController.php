<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class ApiController extends Controller
{
    //
    public function getServerData(Request $request) {
        $isFinished = DB::connection($request->serverKey)->table('status')->select('isFinished')->get()->toArray();
        if($isFinished) return response()->json(['progress' => 100]);
        $currentTimeStamp = time();
        $config = config($request->serverKey);
        if(isset($config['OPENING']) && isset($config['ROUND_TOTAL'])) {
            $fromStart = $currentTimeStamp - $config['OPENING'];
            $progress = max(0, min(100, ($fromStart / $config['ROUND_TOTAL']) * 100));
        } else {
            return response() -> json([
                'error' => 'Required constants not defined in config file.',
            ]);
        }
        // Calculate the time since the round started
        $startTime = date("Y-m-d H:i:s", $config['OPENING']);
        $startTimeStamp = strtotime($startTime);
        $timeDifference = $currentTimeStamp - $startTimeStamp;

        // Calculate days, hours, and minutes
        $days = floor($timeDifference / (60 * 60 * 24));
        $hours = floor(($timeDifference % (60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($timeDifference % (60 * 60)) / 60);

        // Format the time difference based on the scenario
        if ($timeDifference < 0) {
            // If the starting time is in the future
            $formattedTime = sprintf("Round will start in: %d hours", $hours,);
        } elseif ($days >= 1) {
            // If it has been more than 24 hours since the server started
            $formattedTime = sprintf("Round started: %d days ago", $days);
        } else {
            // If it has been less than 24 hours since the server started
            $formattedTime = sprintf("Round started: %d hours ago", $hours);
        }

        return response()->json([
            'progress' => $progress,
            'startTime' => $formattedTime,
        ]);
    }

    public function getTotalPlayers(Request $request) {
        $severKey = $request->serverKey;
        if(!$severKey) return response()->json('Unable to connect DB');
        $result=DB::connection($severKey)->table('users')->select('id')->where([
            [time().' - timestamp', '<', '600'],
            ['tribe', '!=', '0'],
            ['tribe', '!=', '4'],
            ['tribe', '!=', '5']
        ])->get()->count();
        return response()->json(['count' => $result]);
    }
}
