<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestToJoinRequest;
use App\Jobs\RequestToJoinJob;
use App\Models\EventPlannerRequest;
use Illuminate\Http\Request;

class JoinRequestController extends Controller
{
    public function index()
    {
        return view('join-request');
    }

    public function store(RequestToJoinRequest $request)
    {
        $request = EventPlannerRequest::create($request->all());

        RequestToJoinJob::dispatch($request);

        return redirect()->route('check-join-request',$request);
    }

    public function check(Request $request)
    {
        if($request->has('id'))
        {

            $request->validate([
                'id' => 'required|uuid'
            ],[
                'id.required' => 'Please enter your request ID',
                'id.uuid' => 'Invalid request ID'
            ]);

            $join_request = EventPlannerRequest::where('uuid',$request->id)
                ->with('notes')
                ->firstOrFail();

            return view('check-join-request-result',compact('join_request'));
        }

        return view('check-join-request');

    }
}
