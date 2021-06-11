<?php
/**
 * Created by PhpStorm.
 * User: brech
 * Date: 3/04/2020
 * Time: 15:04
 */

namespace App\Http\Middleware;

use Closure;
class Verantwoordelijke
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->verantwoordelijke) {
            return $next($request);
        }
        return abort(403, 'Alleen verantwoordelijke kunnen de avond plannen!');
    }
}
