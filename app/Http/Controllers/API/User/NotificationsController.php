<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationsResource;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    use JsonResponse;


    public function index(Request $request)
    {
        return $this->ok(200, "Here're your notifications", NotificationsResource::collection($request->user()->notifications));
    }

    public function read(Request $request, $notification)
    {
        $notification = $request->user()->notifications()->where('id', $notification)->firstOrFail();
        
        $notification->markAsRead();
        return $this->ok(200, 'Notification marked as read', new NotificationsResource($notification));
    }
}
