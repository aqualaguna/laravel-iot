<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
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
		$subcribeAt = new Carbon($user->subcribe_at);
		if ($user->subcribe_type == 'monthly' || $user->subcribe_type == 'yearly') {
			if ($user->subcribe_type == 'monthly') {
				if ($subcribeAt->diffInDays(Carbon::now()) >= 30) {//if expire
					if ($user->credit > 200000)
						$user->credit -= 200000;
					else {
						$user->subcribe_type = 'trial';
						$user->subcribe_at = null;
						$user->save();
						abort(400, 'User Credit is not Enough');
					}
					$user->subcribe_at = Carbon::now()->toDateTimeString();
					$user->save();
				}
			}
			else{
				if ($subcribeAt->diffInDays(Carbon::now()) >= 365) {
					if ($user->credit > 2000000)
						$user->credit -= 2000000;
					else {
						$user->subcribe_type = 'trial';
						$user->subcribe_at = null;
						$user->save();
						abort(400, 'User Credit is not Enough');
					}
					$user->subcribe_at = Carbon::now()->toDateTimeString();
					$user->save();
				}
			}
		}
		else if (!$user->islifetime) {
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
