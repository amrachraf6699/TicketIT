<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    use JsonResponse;

    /**
     * Display the user profile.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return $this->ok(200, $user->name . "'s Profile",new UserProfileResource($request->user()));
    }

    /**
     * Update the user profile.
     */
    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update($request->validated());

        return $this->ok(200, 'Profile Updated',new UserProfileResource(auth()->user()));
    }

    /**
     * Update the user password.
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $request->user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return $this->error(422, 'Current Password is incorrect');
        }

        $user->update([
            'password' => $request->password,
        ]);

        return $this->ok(200, 'Your password has been updated successfully',new UserProfileResource(auth()->user()));
    }

    /**
     * Update the user avatar.
     */
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $request->user()->update($request->validated());
        return $this->ok(200, 'Your avatar has been updated successfully',new UserProfileResource(auth()->user()));
    }
}
