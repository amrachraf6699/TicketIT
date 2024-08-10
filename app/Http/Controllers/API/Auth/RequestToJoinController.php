<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestToJoinRequest;
use App\Jobs\RequestToJoinJob;
use App\Models\EventPlannerRequest;
use App\Traits\JsonResponse;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class RequestToJoinController extends Controller
{
    use JsonResponse;
    /**
     * Handle the incoming request.
     */
    public function __invoke(RequestToJoinRequest $request)
    {
        $EventPlannerRequest = EventPlannerRequest::create($request->validated());

        RequestToJoinJob::dispatch($EventPlannerRequest);

        return $this->ok
        (
            201,
            'Your Request has been recorded . You can check the status and updatus of the request by mail or by the following link',
            ['check-join-request-link' => route('check-join-request',[$EventPlannerRequest])]
        );
    }
}
