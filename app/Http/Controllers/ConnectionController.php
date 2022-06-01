<?php

namespace App\Http\Controllers;

use App\Http\Requests\Connection\CommonConnectionRequest;
use App\Http\Requests\Connection\IndexConnectionRequest;
use App\Http\Requests\Connection\StoreConnectionRequest;
use App\Http\Resources\Connection\StoreConnectionResource;
use App\Models\Connection;
use App\Models\User;
use App\Services\Connection\Common;
use App\Services\Connection\Index;
use Illuminate\Http\JsonResponse;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexConnectionRequest $request
     * @param Index $index
     * @return JsonResponse
     */
    public function index(IndexConnectionRequest $request, Index $index)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        $data = $index($validated);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreConnectionRequest $request
     * @return JsonResponse
     */
    public function store(StoreConnectionRequest $request)
    {
        $validated = $request->validated();
        $validated['user_from_id'] = auth()->id();

        $connection = Connection::create($validated);
        $message = __('response.connection.created');

        return (new StoreConnectionResource($connection))
            ->additional(compact('message'))
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function update( $id)
    {
        auth()->user()->receivedRequests()
            ->whereUserFromId($id)
            ->update(['status' => Connection::STATUS_ACCEPTED]);

        $message = __('response.connection.updated');

        return response()->json(compact('message'));
    }

    /**
     * Get connection type's counts.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function countConnectionsByType()
    {
        $connectionTypesCounts['suggestions'] = auth()->user()->suggestions()->count();
        $connectionTypesCounts['sent_requests'] = auth()->user()->sentRequests->count();
        $connectionTypesCounts['received_requests'] = auth()->user()->receivedRequests->count();
        $connectionTypesCounts['connections'] = auth()->user()->connections()->count();

        return response()->json($connectionTypesCounts);
    }

    /**
     * Get common connections between two users.
     *
     * @param CommonConnectionRequest $request
     * @param Common $common
     * @return JsonResponse
     */
    public function commonConnections(CommonConnectionRequest $request, Common $common)
    {
        $validated = $request->validated();
        $validated['first_user_id'] = auth()->id();

        $content = $common($validated);

        return response()->json(['content' => $content]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user_to_id
     * @return JsonResponse
     */
    public function destroy($user_to_id)
    {
        Connection::where([
            'user_from_id' => auth()->id(),
            'user_to_id' => $user_to_id
        ])->orWhere([
            'user_from_id' => $user_to_id,
            'user_to_id' => auth()->id()
        ])->first()->delete();

        $message = __('response.connection.deleted');

        return response()->json(compact('message'));
    }
}
