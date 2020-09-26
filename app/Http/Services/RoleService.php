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
                'msg' => 'Role {$id} has been updated',
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
        $user = User::find($id);
        if($user){
            $user = $user->first();
            $hasRole = $user->hasRole($roleId);

            $roleName =  Role::find($roleId);
            if($roleName){
                $roleName = $roleName->name;
                if(!$hasRole) {
                    $result = $user->role()->attach($roleId);
                    if ($result) {
                        $response = [
                            'status' => 200,
                            'msg' => "Role {$roleName} has been awarded"
                        ];
                    } else {
                        $response = [
                            'status' => 400,
                            'msg' => "The role {$roleName} can not be awarded"
                        ];
                    }
                }
                else {
                    $response = [
                        'status' => 400,
                        'msg' => "The role {$roleName} is already awarded"
                    ];
                }
            }else{
                $response = [
                    'status' => 400,
                    'msg' => "This role does not exist"
                ];
            }
        }else{
            $response = [
                'status' => 400,
                'msg' => "This user does not exist"
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
        $user = User::find($id);
        if($user){
            $user = $user->first();
            $hasRole = $user->hasRole($roleId);
            $roleName =  Role::find($roleId);
            if($roleName){
                $roleName = $roleName->name;
                if($hasRole) {
                    $result = $user->role()->detach($roleId);
                    if ($result) {
                        $response = [
                            'status' => 200,
                            'msg' => "Role {$roleName} has been removed"
                        ];
                    } else {
                        $response = [
                            'status' => 400,
                            'msg' => "The role {$roleName} can not be removed"
                        ];
                    }
                }
                else {
                    $response = [
                        'status' => 400,
                        'msg' => "User does not have {$roleName} role"
                    ];
                }
            }else{
                $response = [
                    'status' => 400,
                    'msg' => "This role does not exist"
                ];
            }
        }else{
            $response = [
                'status' => 400,
                'msg' => "This user does not exist"
            ];
        }
        return $response;
    }
}
