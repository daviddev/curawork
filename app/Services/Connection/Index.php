<?php

namespace App\Services\Connection;

use App\Models\Connection;
use App\Models\User;

class Index
{
    /**
     * @param array $validated
     * @return array
     */
    public function __invoke(array $validated)
    {
        $user = User::find($validated['user_id']);
        switch ($validated['type']) {
            case Connection::TYPE_SUGGESTIONS:
                $connectedUsers = $user->suggestions()->paginate(
                    $validated['per_page'] ?? 10, ['*'], 'page', $validated['page'] ?? 1
                );
                $content = view('components.suggestion', [
                    'suggestions' => $connectedUsers
                ])->render();
                $page = $connectedUsers->currentPage() + 1;
                break;
            case Connection::TYPE_SENT_REQUESTS:
                $connectedUsers = User::with('receivedRequests')
                    ->whereHas('receivedRequests',
                        fn($q) => $q->where('user_from_id', $user->id)
                    )
                    ->paginate(
                        $validated['per_page'] ?? 10, ['*'], 'page', $validated['page'] ?? 1
                    );
                $content = view('components.request', [
                    'requests' => $connectedUsers,
                    'mode' => 'sent',
                ])->render();
                $page = $connectedUsers->currentPage() + 1;
                break;
            case Connection::TYPE_RECEIVED_REQUESTS:
                $connectedUsers = User::with('sentRequests')
                    ->whereHas('sentRequests',
                        fn($q) => $q->where('user_to_id', $user->id)
                    )
                    ->paginate(
                        $validated['per_page'] ?? 10, ['*'], 'page', $validated['page'] ?? 1
                    );
                $content = view('components.request', [
                    'requests' => $connectedUsers,
                    'mode' => 'received',
                ])->render();
                $page = $connectedUsers->currentPage() + 1;
                break;
            case  Connection::TYPE_CONNECTIONS:
                $connectedUsers = $user->connections()->paginate(
                    $validated['per_page'] ?? 10, ['*'], 'page', $validated['page'] ?? 1
                );

                $content = view('components.connection', [
                    'connections' => $connectedUsers
                ])->render();
                $page = $connectedUsers->currentPage() + 1;
                break;
            default:
                $content = '';
        }
        return [
            'content' => $content,
            'page' => $page,
        ];

    }
}
