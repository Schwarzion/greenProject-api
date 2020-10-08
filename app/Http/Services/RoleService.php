<?php


namespace App\Http\Services;


use App\models\Role;
use App\models\User;
use Illuminate\Http\Request;
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
            'msg' => 'Liste des rôles',
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
                'msg' => "Le rôle {$id} a été supprimé",
            ];
        } else {
            $response = [
                'status' => 400,
                'ErrorCode' => 1,
                'msg' => "Le rôle {$id} n'a pas été trouvé",
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
                'msg' => "Le rôle {$id} a été trouvé",
            ];
        }else{
            $response = [
                'status' => 400,
                'ErrorCode' => 1,
                'msg' => "Le rôle {$id} n'a pas été trouvé",
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
                'msg' => 'Le rôle a bien été créé',
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
            'name' => 'max:45',
            'desc' => 'max:120'
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
                'msg' => "Le rôle {$id} a été modifié",
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
                            'msg' => "Le rôle {$roleName} a été attaché"
                        ];
                    } else {
                        $response = [
                            'status' => 400,
                            'msg' => "Le rôle  {$roleName} ne peux pas être attaché"
                        ];
                    }
                }
                else {
                    $response = [
                        'status' => 400,
                        'msg' => "Le rôle  {$roleName} est déjà attaché"
                    ];
                }
            }else{
                $response = [
                    'status' => 404,
                    'msg' => "Le rôle n'existe pas"
                ];
            }
        }else{
            $response = [
                'status' => 404,
                'msg' => "L'utilisateur n'existe pas"
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
                            'msg' => "Le rôle {$roleName} a été enlevé"
                        ];
                    } else {
                        $response = [
                            'status' => 400,
                            'msg' => "Le rôle {$roleName} ne peux pas être supprimé"
                        ];
                    }
                }
                else {
                    $response = [
                        'status' => 400,
                        'msg' => "L'utilisateur n'a pas le rôle {$roleName}"
                    ];
                }
            }else{
                $response = [
                    'status' => 400,
                    'msg' => "Le rôle n'existe pas"
                ];
            }
        }else{
            $response = [
                'status' => 400,
                'msg' => "L'utilisateur n'existe pas"
            ];
        }
        return $response;
    }
}
