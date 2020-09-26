<?php


namespace App\Http\Controllers;


use App\Http\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    public function __construct(RoleService $roleService)
    {
        $this->middleware('auth');
        $this->middleware('role:ADMIN', ['except' => ['checkRole']]);
        $this->roleService = $roleService;
    }

    /**
     * Get all roles
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json($this->roleService->getAll());
    }

    /**
     * Delete one role
     *
     * @param $id (int)
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        return response()->json($this->roleService->delete($id));
    }

    /**
     * Add a role
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        return response()->json($this->roleService->addRole($request));
    }

    /**
     * Get a Quest
     *
     * @param $id (int)
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        return response()->json($this->roleService->show($id));
    }

    /**
     * Update role
     *
     * @param Request $request
     * @param Illuminate\Http\Request
     *        $id (int)
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        return response()->json($this->roleService->update($request, $id));
    }

    /**
     * @param Request $request
     * @param $id
     * @param $roleId
     * @return JsonResponse
     */
    public function giveRole(Request $request, $id, $roleId)
    {
        return response()->json($this->roleService->give($request, $id, $roleId));
    }

    /**
     * @param Request $request
     * @param $id
     * @param $roleId
     * @return JsonResponse
     */
    public function removeRole(Request $request, $id, $roleId)
    {
        return response()->json($this->roleService->remove($request, $id, $roleId));
    }

    /**
     * @return JsonResponse
     */
    public function checkRole(Request $request, $roleId)
    {
        $user = Auth::user();
        $role = $user->hasRole($roleId);
        if($role){
            $response = response()->json([
                'status' => 200,
                'role' => true,
                'msg' => "User {$user->firstName} {$user->lastName} has role {$role->name}."
            ]);
        }else{
            $response = response()->json([
                'status' => 400,
                'role' => false,
                'msg' => "This role does not exist."
            ]);
        }
        return $response;
    }
}