<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class ApiParentMiddleware
{
    protected $auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        // dd($this->auth->user()->type);
        if($this->auth->user()->type!='parent')
            {
               if ($request->ajax()) {
                return response('Unauthorized.', 401);
                } else {
                return api()->notValid(['errorMsg'=>'Accessed only by parent']);
                }
            }
        return $next($request);
    }
}