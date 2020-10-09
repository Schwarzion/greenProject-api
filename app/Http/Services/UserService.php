<?php

namespace App\Http\Services;

use App\models\User;
use App\models\Level;
use App\models\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserService extends Service
{
    public function __construct()
    {
    }

    /**
     * Get all tips
     * Return empty array if no user are present in database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {

        return [
            'status' => 200,
            'users' => User::all(),
            'msg ' => 'Liste des utilisateurs',
        ];
    }

    /**
     * Delete one tip
     *
     * @param $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        $delete = User::whereId($id)->delete($id);
        if ($delete) {
            return [
                'status' => 200,
                'msg ' => "L'utilisateur {$id} a bien été supprimé",
            ];
        } else {
            return [
                'status' => 404,
                'msg' => "L'utilisateur {$id} ne peux pas être supprimer, il n'existe peut-être pas",
            ];
        }
    }

    /**
     * Add a User
     *
     * @param Illuminate\Http\Request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $checkAlias = User::where('alias', $request->input('alias'))->get();
        if ($checkAlias->first()) {
            return [
                'status' => 409,
                'msg' => ['alias' => ["Cet alias est déjà pris"]],
            ];
        }

        $checkEmail = User::Where('email', $request->input('email'))->get();
        if ($checkEmail->first()) {
            return [
                'status' => 409,
                'msg' => ['email' => ["Cet email est déjà pris"]],
            ];
        }

        $validator = Validator::make($request->all(), [
            'firstName' => 'required|max:30|alpha_dash',
            'lastName' => 'required|max:30|alpha_dash',
            'alias' => 'required|max:20|unique:user,alias',
            'email' => 'required|max:89|email|unique:user,email',
            'password' => 'required|max:50',
            'confirmPassword' => 'required|max:50',
            'address' => 'required|max:60',
            'city' => 'required|max:30|alpha_dash',
            'postalCode' => 'required|max:5|alpha_num',
            'birthday' => 'required|date|before:today',
            'sexe' => 'required|alpha_num',
            'phone' => 'required|max:10|alpha_num',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 400,
                'msg' => $validator->errors()->messages(),
            ];
        } else {
            $user = User::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'alias' => $request->input('alias'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'postalCode' => $request->input('postalCode'),
                'birthday' => $request->input('birthday'),
                'sexe' => $request->input('sexe'),
                'phone' => $request->input('phone'),
            ]);
            if ($user->save()) {
                return [
                    'status' => 200,
                    'user' => $user,
                    'msg' => "L'utilisateur a été créé",
                ];
            } else {
                return [
                    'status' => 400,
                    'msg' => "Impossible d'enregistrer l'utilisateur",
                ];
            }
        }
    }

    /**
     * Get a Tip
     *
     * @param $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $user = User::find($id);
        if ($user) {
            return [
                'status' => 200,
                'user' => $user,
                'msg' => "L'utilisateur {$id} a été trouvé",
            ];
        }
        return [
            'status' => 404,
            'msg' => "L'utilisateur {$id} n'a pas été trouvé",
        ];
    }

    /**
     * Update user
     *
     * @param Illuminate\Http\Request
     *        $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'min:3|max:30|alpha_dash',
            'lastName' => 'min:3|max:30|alpha_dash',
            'alias' => 'min:3|max:20|unique:user,alias',
            'email' => 'min:3|max:89|email|unique:user,email',
            'password' => 'min:3|max:50',
            'confirmPassword' => 'min:3|max:50',
            'address' => 'min:3|max:60',
            'city' => 'min:3|max:30|alpha_dash',
            'postalCode' => 'min:5|max:5|alpha_num',
            'birthday' => 'date|before:today',
            'sexe' => 'min:1|alpha_num',
            'phone' => 'min:10|max:10|alpha_num',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 400,
                'msg' => $validator->errors()->messages(),
            ];
        } else {
            $user = User::whereId($id)->update($request->input());
            if ($user) {
                return [
                    'status' => 200,
                    'user' => User::find($id),
                    'msg' => "L'utilisateur {$id} à bien été modifié",
                ];
            }
        }
    }

    public function getUserQuests(Request $request)
    {
        return [
            'status' => 200,
            'quests' => Auth::user()->quest,
            'msg' => "Liste des quêtes utilisateur",
        ];
    }

    /**
     * Attach a quest to user
     *
     * @param Request $request
     * @param int $questId
     * @return array
     */
    public function addQuest(Request $request, $questId)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $quest = Quest::find($questId);
        $hasQuest = $user->hasQuest($questId);
        if ($hasQuest != null) {
            return [
                'status' => 409,
                'msg' => "La quête est déjà attribuée",
            ];
        } else {
            $date = new \DateTime();
            $expireTimestamp = $date->getTimestamp() + $quest->timeForQuest;
            $expire = $date->setTimestamp($expireTimestamp);
            $user->quest()->attach($questId, ['expire' => $expire, 'status' => 1]);
            return [
                'status' => 200,
                'msg' => "La quête a bien été ajoutée",
            ];
        }
    }

    /**
     * Remove a quest from user
     *
     * @param Request $request
     * @param int $questId
     * @return array
     */
    public function removeQuest(Request $request, $questId)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $hasQuest = $user->hasQuest($questId);
        if ($hasQuest == null) {
            return [
                'status' => 404,
                'msg' => "La quête n'est pas attribuée",
            ];
        } else {
            $user->quest()->detach($questId);
            return [
                'status' => 200,
                'msg' => "La quête a bien été enlevé",
            ];
        }
    }

    /**
     * Get current user
     * 
     * @return array
     */
    public static function updateUserLevel()
    {
        $getCurrentUser = Auth::user();
        $currentUserExp = $getCurrentUser['exp'];
        $userLevel = Level::where('levelExpAmount', '<=', $currentUserExp)->get()->last();
        $newUserLevel = [
            'level' => $userLevel['id'],
        ];
        if ($getCurrentUser['level'] == $userLevel['id']) {
            $result = false;
        }else{
            $result = $getCurrentUser->update($newUserLevel);
        }

        if ($result == true) {
            return [
                'status' => 200,
                'user' => $getCurrentUser['id'],
                'New level' => $userLevel,
            ];
        } else {
            return [
                'status' => 400,
                'msg' => 'Can\'t update the current user with the id ' . $getCurrentUser['id'],
            ];
        }
    }
}
