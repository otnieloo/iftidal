<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDivision
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next, $division)
  {

    if (auth()->check()) {
      $user = auth()->user();

      if ($user->role->division == $division) {
        return $next($request);
      }

      return abort(403);
    }

    return redirect()->route("login");
  }
}
