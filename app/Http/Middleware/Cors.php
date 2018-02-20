<?php
/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 12/01/2018
 * Time: 2:36
 */

namespace App\Http\Middleware;

use Closure;


class Cors
{
    public function handle($request, Closure $next)
    {
        return $next ($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}