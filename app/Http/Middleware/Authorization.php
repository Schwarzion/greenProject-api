<?php


namespace App\Http\Middleware;


use App\Http\Services\RoleService;
use Closure;
use Illuminate\Http\Request;

class Authorization
{

    /**
     * Create a new authorization middleware instance.
     *
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param null $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        if($role){
            $roles = [];
            $role = explode(' ', (string)$role);
            foreach($role as $value){
                $result = $request->user()->role()->where('role.name', $value)->get()->all();
                if($result){
                    $roles[] = $result;
                }
            }
            if (!$roles) {
                return response()->json(['Message' => 'Unauthorized : You don\'t have the authorizations.'], 403);
            }
        }
        return $next($request);
    }

}