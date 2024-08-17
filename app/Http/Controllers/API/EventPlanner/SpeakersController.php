<?php

namespace App\Http\Controllers\API\EventPlanner;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventPlanner\CreateSpeakerRequest;
use App\Http\Resources\UserProfileResource;
use App\Jobs\EventPlanner\CreateSpeakerJob;
use App\Models\User;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpeakersController extends Controller
{
    use JsonResponse;


    public function index(Request $request)
    {
        $speakers = $request->user()->eventPlanner->speakers()->with('user')->get();

        return $this->ok(200,'Speakers fetched successfully', UserProfileResource::collection($speakers->pluck('user')));

    }

    public function store(CreateSpeakerRequest $request)
    {
        $request['password'] = bcrypt('Password');
        $speaker = User::create($request->except('job_title'));

        $event_planner = $request->user()->eventPlanner;


        $event_planner->speakers()->create([
            'job_title' => $request->job_title,
            'user_id' => $speaker->id,
        ]);

        DB::commit();

        CreateSpeakerJob::dispatch($speaker, $event_planner);

        return $this->ok(
            201,
            'Speaker created successfully. Here are the login details. We will notify the speaker too.',
            [
                'username' => $speaker->username,
                'password' => 'Password',
            ]
        );
    }

    public function show(Request $request, User $speaker)
    {
        $speaker = $request->user()->eventPlanner->speakers()->where('user_id', $speaker->id)->first();

        return $this->ok(200,'Speaker fetched successfully', new UserProfileResource($speaker->user));
    }

    public function destroy(Request $request, User $speaker)
    {
        $speaker = $request->user()->eventPlanner->speakers()->where('user_id', $speaker->id)->first();

        $speaker->delete();

        return $this->ok(200,'Speaker deleted successfully');
    }
}
