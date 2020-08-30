<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Hyvikk;

class SetLocale {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		App::setLocale(Hyvikk::get('language'));

		return $next($request);
	}
}
