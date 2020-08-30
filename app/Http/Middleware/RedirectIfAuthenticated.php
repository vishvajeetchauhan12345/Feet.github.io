<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {

	public function handle($request, Closure $next, $guard = null) {
		if (!$this->alreadyInstalled()) {
			return redirect("/install");
		}
		if (Auth::guard($guard)->check()) {
			return redirect('/');
		}

		return $next($request);
	}

	public function alreadyInstalled() {
		return file_exists(storage_path('installed'));
	}
}
