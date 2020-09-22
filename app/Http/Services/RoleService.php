<?php


namespace App\Http\Services;


use App\models\Role;
use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoleService extends Service
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Get all roles
     * Return empty array if no role are present in database
     *
     * @return array
     */
    public function getAll()
    {
        return [
            'status' => 200,
            'quests' => Role::all(),
            'msg' => 'list of roles',
        ];
    }

    /**
     * Delete one role
     *
     * @param $id (int)
     *
     * @return array
     */
    public function delete(int $id)
    {
        $delete = Role::whereId($id)->delete($id);
        if ($delete) {
            $response = [
                'status' => 200,
                'msg' => "Role {$id} has been deleted",
            ];
        } else {
            $response = [
                'status' => 400,
                'ErrorCode' => 1,
                'msg' => "Role {$id} not found",
            ];
        }
        return $response;
    }

    /**
     * Get a role
     *
     * @param $id (int)
     *
     * @return array
     */
    public function show(int $id)
    {
        $quest = Role::find($id);
        if ($quest) {
            $response = [
                'status' => 200,
                'quest' => $quest,
                'msg' => "Role {$id} has been found",
            ];
        }else{
            $response = [
                'status' => 400,
                'ErrorCode' => 1,
                'msg' => "Role {$id} was not found",
            ];
        }
        return $response;
    }

    /**
     * Add a role
     *
     * @param Illuminate\Http\Request
     *
     * @return array
     */
    public function addRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'desc' => 'required|max:120'
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => 400,
                'ErrorCode' => 1,
                'msg' => $validator->errors()->messages(),
            ];
        } else {
            $response = [
                'status' => 200,
                'quest' => Role::create($request->input()),
                'msg' => 'Role has been sucessfully created',
            ];
        }
        return $response;
    }

    /**
     * Update role
     *
     * @param Illuminate\Http\Request
     *        $id (int)
     *
     * @return array
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'desc' => 'required|max:120'
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => 400,
                'msg' => $validator->errors()->messages(),
            ];
        } else {
            $response = [
                'status' => 200,
                'user' => Role::whereId($id)->update($request->input()),
                'msg' => "Role {$id} has been updated",
            ];
        }
        return $response;
    }

    /**
     * Give a role to a user
     * @param $request
     * @param $id
     * @param $roleId
     * @return array
     */
    public function give($request, $id, $roleId)
    {
        $user = User::select('id')->where('id', $id)->first();
        $role = Role::select('id')->where('id', $roleId)->first();
        $result = $user->hasRole()->attach($role);
        if($result){
            $response = [
                'status' => 400,
                'msg' => $user->errors()->messages(),
            ];
        }else {
            $response = [
                'status' => 200,
                'user' => $result,
                'msg' => "Role {$id} has been awarded",
            ];
        }
        return $response;
    }

    /**
     * Remove a user's role
     * @param $request
     * @param $id
     * @param $roleId
     * @return array
     */
    public function remove($request, $id, $roleId)
    {
        if($roleId != 1) {
            $user = User::select('id')->where('id', $id)->first();
            $role = Role::select('id')->where('id', $roleId)->first();
            $result = $user->hasRole()->detach($role);
            if ($result) {
                $response = [
                    'status' => 400,
                    'msg' => $user->errors()->messages()
                ];
            } else {
                $response = [
                    'status' => 200,
                    'user' => $result,
                    'msg' => "Role {$id} has been removed",
                ];
            }
        }else{
            $response = [
                'status' => 200,
                'msg' => "This role is untouchable",
            ];
        }
        return $response;
    }
}