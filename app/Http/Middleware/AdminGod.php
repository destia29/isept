<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;

use Closure;

class AdminGod
{
    /**
    * The Guard implementation.
    *
    * @var Guard
    */
    protected $auth;

    /**
    * Create a new middleware instance.
    *
    * @param  Guard  $auth
    * @return void
    */
    public function __construct(Guard $auth)
    {
      $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     public function handle($request, Closure $next)
     {
       if ($this->auth->guest()) {
           if ($request->ajax()) {
               return response('Unauthorized.', 401);
           } else {
               return redirect()->guest('/isclunila/login');
           }
       }
       else if(!empty($this->auth->user()->deleted_at)){
         return redirect('/isclunila/login')->with('error','Your account has been suspended');
       }
       else if($this->auth->user()->id_role != 1){
         return redirect('/isclunila/login')->with('error','You do not have permissions to access this page');
       }

       return $next($request);

      }
