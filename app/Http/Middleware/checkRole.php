<?php

namespace App\Http\Middleware;

use Closure;
// use Auth;
class checkRole
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
   */
   public function handle($request, Closure $next, ... $roles)
   {
      if (is_array($roles)) {
         foreach ($roles as $role) {
            if ($request->user()->jabatan->jabatan == $role) {
               return $next($request);
            }
         }
         return redirect()->back();
      }
      else {
         if ($request->user()->jabatan->jabatan != $roles) {
            return redirect()->back();    
         }   
         return $next($request);
      }
      
      
   }
}
