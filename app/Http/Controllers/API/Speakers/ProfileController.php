<?php

namespace App\Http\Controllers\API\Speakers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpeakerProfileResource;
use App\Jobs\CompletedProfileJob;
use App\Jobs\VerifyAccountJob;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();
        $user->load(['speaker', 'speaker.company' , 'speaker.company.user']);

        return $this->ok(200, 'Profile fetched successfully', new SpeakerProfileResource($user));
    }

    public function completeProfile(Request $request)
    {
        $data = $request->validate([
            'bio' => 'required|string',
        ]);

        $user = $request->user();
        $user->speaker()->update($data);

        CompletedProfileJob::dispatch($user);

        return $this->ok(200, 'Profile updated successfully . You can now join events');
    }

    public function verify(Request $request)
    {
        VerifyAccountJob::dispatch(auth()->user());

        return $this->ok(200, 'Verification email sent successfully . Please check your email');
    }
}
