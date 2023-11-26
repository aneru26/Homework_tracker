<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

     /**
     * Override the authenticate method to include session expiration check.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return mixed
     */
    protected function authenticate($request, array $guards)
    {
        if ($this->sessionExpired()) {
            Auth::logout();
            Session::flash('session-expired', 'Your session has expired. Please log in again.');
            return $this->redirectTo($request);
        }

        parent::authenticate($request, $guards);
    }

    /**
     * Check if the user's session has expired.
     *
     * @return bool
     */
    protected function sessionExpired()
    {
        $lastActivity = session('last_activity', 0);
        $timeout = config('session.lifetime') * 60;

        return time() - $lastActivity > $timeout;
    }
}
