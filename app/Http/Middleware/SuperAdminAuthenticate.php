<?php


namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class SuperAdminAuthenticate extends Middleware
{
   /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('admin.superadmin');
    }

    protected function authenticate($request, array $guards)
    {
            if ($this->auth->guard('superadmin')->check()) {
                return $this->auth->shouldUse('superadmin');
            } 
      
        $this->unauthenticated($request, $guards);
    }
}
