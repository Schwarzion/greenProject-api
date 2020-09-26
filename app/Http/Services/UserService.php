<?php

namespace App\Http\Services;

use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'msg ' => 'list of user',
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
                'msg ' => "user {$id} has been deleted",
            ];
        } else {
            return [
                'status' => 404,
                'msg' => "user {$id} cannot be deleted, might not exist",
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
                    'msg' => 'user has been successfully created',
                ];
            } else {
                return [
                    'status' => false,
                    'ErrorCode' => 400,
                    'msg' => 'cannot save user',
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
                'msg' => "user {$id} has been found",
            ];
        }
        return [
            'status' => 404,
            'msg' => "user {$id} was not found",
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
            return [
                'status' => 200,
                'user' => User::whereId($id)->update($request->input()),
                'msg' => "user {$id} has been updated",
            ];
        }
    }
}
