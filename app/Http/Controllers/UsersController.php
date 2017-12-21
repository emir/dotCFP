<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Http\Requests\UpdateUserProfile;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $users = User::latest()->paginate();

        return response()->view('users.index', compact('users'));
    }

    /**
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return response()->view('users.show', compact('user'));
    }

    /**
     * @param User $user
     * @return Response
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function edit(Request $request, User $user): Response
    {
        $conference = Conference::findBySlugOrFail($request->route('subdomain'));

        return response()->view('users.edit', compact('user', 'conference'));
    }

    /**
     * @param UpdateUserProfile $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserProfile $request, User $user): RedirectResponse
    {
        $user->bio = $request->get('bio');
        $user->airport_code = $request->get('airport_code');
        $user->twitter_handle = $request->get('twitter_handle');
        $user->url = $request->get('url');
        $user->desire_transportation = $request->get('desire_transportation', 0);
        $user->desire_accommodation = $request->get('desire_accommodation', 0);
        $user->is_sponsor = $request->get('is_sponsor', 0);

        $user->saveOrFail();

        flash()->success('You have successfully updated your profile!');

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function roleAction(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'role' => 'required|in:admin,reviewer,user'
        ]);

        $user->update(['role' => $request->get('role')]);

        return response()->json([], 204);
    }
}
