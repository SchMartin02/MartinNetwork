<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class OnlineController extends Controller
{
    public function index(): View
    {
        // Return the view (blade) `example`, and pass an onlineUsers array to the view which calls the onlineUsers function
        return view('user', [
            'onlineUsers' => $this->onlineUsers(),
        ]);
    }

    /*
     * I made a few tiny changes to the example code:
     * - I made the function private, since we don't need to call it from anywhere except this controller.
     * - I added ?Collection as its return type, since the function returns a Collection *OR* null (hence why the ?)
     */
    private function onlineUsers(): ?Collection
    {
        // Get the array of users
        $users = Cache::get('online-users');
        if (!$users) {
            return null;
        }

        // Add the array to a collection, so you can pluck the IDs
        $onlineUsers = collect($users);
        // Get all users by ID from the DB (1 very quick query)
        $dbUsers = User::find($onlineUsers->pluck('id')->toArray());

        // Prepare the return array
        $displayUsers = [];

        // Iterate over the retrieved DB users
        foreach ($dbUsers as $user) {
            // Get the same user as this iteration from the cache
            // so that we can check the last activity.
            // firstWhere() is a Laravel collection method.
            $onlineUser = $onlineUsers->firstWhere('id', $user['id']);
            // Append the data to the return array
            $displayUsers[] = [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->image,
                // This Bool operation below, checks if the last activity
                // is older than 3 minutes and returns true or false,
                // so that if it's true you can change the status color to orange.
                'away' => $onlineUser['last_activity_at'] < now()->subMinutes(3),
            ];
        }
        return collect($displayUsers);
    }
}
