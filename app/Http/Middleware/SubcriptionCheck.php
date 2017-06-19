<?php

namespace App\Http\Middleware;

use Closure;

class SubcriptionCheck {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		//do something
		$user = $request->user();
		if (!$user->islifetime) {
			if ($user->credit > 100) {
				$user->credit -= 100;
				$user->api_call_count++;
				$user->save();
			}
			else {
				abort(400, 'User Credit is not enough!');
			}
		}

		return $next($request);
	}
}
