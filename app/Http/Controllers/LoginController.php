<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\AbstractUser;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends \App\Http\Controllers\Auth\LoginController
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            /** @var AbstractUser $user */
            $user = Socialite::driver('github')->user();
        } catch (\Exception $exception) {
            Log::alert('SOCIALITE LOGIN', ['exception' => $exception]);

            flash()->error('An error encountered performing the requested operation');

            return redirect()->intended('/home');
        }

        try {
            /** @var User $createdUser */
            $createdUser = User::firstOrCreate([
                'github_id' => $user->getId(),
                'email' => $user->getEmail()
            ], [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'username' => $user->getNickname(),
                'github_id' => $user->getId(),
                'avatar' => $user->getAvatar(),
            ]);
        } catch (\Exception $exception) {
            Log::alert('AUTH', ['exception' => $exception]);

            flash()->error('An error encountered performing the requested operation');

            return redirect()->intended('/home');
        }

        $createdUser->update(['last_login' => new \DateTime()]);

        Auth::login($createdUser, false);

        return redirect()->intended('/home');
    }
}
