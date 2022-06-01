<?php

namespace App\Services\Connection;

use App\Models\User;

class Common
{
    public function __invoke(array $validated)
    {
        $firstUser = User::find($validated['first_user_id']);
        $secondUser = User::find($validated['second_user_id']);

        $firstUserConRec = $firstUser->receivedConnections()->get()->pluck('user_from_id', 'user_from_id');
        $firstUserConAcc = $firstUser->acceptedConnections()->get()->pluck('user_to_id', 'user_to_id');
        $firstUserConIds = $firstUserConRec->concat($firstUserConAcc)->unique()->forget($firstUser->id);

        $secondUserConRec = $secondUser->receivedConnections()->get()->pluck('user_from_id', 'user_from_id');
        $secondUserConAcc = $secondUser->acceptedConnections()->get()->pluck('user_to_id', 'user_to_id');
        $secondUserConIds = $secondUserConRec->concat($secondUserConAcc)->unique()->forget($secondUser->id);

        $commonIds = $firstUserConIds->intersect($secondUserConIds->toArray());

        $commonUsers = User::whereIn('id', $commonIds)->paginate(
            $validated['per_page'] ?? 10,
            ['*'],
            'page',
            $validated['page'] ?? 1
        );

        return view('components.connection_in_common', compact('commonUsers'))->render();
    }
}
