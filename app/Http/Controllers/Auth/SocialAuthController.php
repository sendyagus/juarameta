<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialAuthController extends Controller
{
    private const SUPPORTED_PROVIDERS = ['google', 'apple'];

    public function redirect(string $provider): RedirectResponse
    {
        if (! $this->isSupportedProvider($provider)) {
            abort(404);
        }

        $driver = Socialite::driver($provider);

        if ($provider === 'apple') {
            $driver->with(['response_mode' => 'form_post']);
        }

        return $driver->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        if (! $this->isSupportedProvider($provider)) {
            abort(404);
        }

        try {
            $driver = Socialite::driver($provider);

            if ($provider === 'apple') {
                $driver->stateless();
            }

            $socialUser = $driver->user();
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('login')->with('error', 'Login dengan ' . ucfirst($provider) . ' gagal. Silakan coba lagi.');
        }

        $email = $socialUser->getEmail();

        if (! $email) {
            return redirect()->route('login')->with('error', 'Akun ' . ucfirst($provider) . ' tidak mengirimkan email.');
        }

        $user = User::query()
            ->where(function ($query) use ($provider, $socialUser) {
                $query->where('provider_name', $provider)
                    ->where('provider_id', $socialUser->getId());
            })
            ->orWhere('email', $email)
            ->first();

        if (! $user) {
            $user = User::query()->create([
                'name' => $socialUser->getName() ?: Str::before($email, '@'),
                'email' => $email,
                'password' => Hash::make(Str::random(32)),
                'role' => 'user',
                'provider_name' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
            ]);
        } else {
            $user->forceFill([
                'name' => $user->name ?: Str::before($email, '@'),
                'provider_name' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
            ])->save();
        }

        Auth::login($user, true);

        return redirect()->intended(route('home'));
    }

    private function isSupportedProvider(string $provider): bool
    {
        return in_array($provider, self::SUPPORTED_PROVIDERS, true);
    }
}

