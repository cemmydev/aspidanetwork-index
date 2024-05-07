<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //
    public function getServerData(Request $request) {
        $isFinished = DB::connection($request->serverKey)->table('status')->select('isFinished');
        if($isFinished) return response()->json(['progress' => 100]);
        
    }
}
