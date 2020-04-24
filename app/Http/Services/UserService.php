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
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        //Return empty array if no user are present in database
        return response()->json(User::all(), 200);
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
            return response()->json([
                'user has been deleted',
            ], 200);
        } else {
            return response()->json([
                'user cannot be deleted, might not exist',
            ], 400);
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
            'sexe' => 'required|boolean',
            'phone' => 'required|max:10|alpha_num',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'ErrorCode' => 1,
                'error' => $validator->errors()->messages(),
            ], 400);
        } else {
            $user = User::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'alias' => $request->input('email'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'postalCode' => $request->input('postalCode'),
                'birthday' => $request->input('birthday'),
                'sexe' => $request->input('sexe'),
                'phone' => $request->input('phone'),
            ]);

            if ($user->save()) {
                return response()->json([
                    'user' => $user,
                ], 200);
            } else {
                return response()->json([
                    "Cannot register user",
                ], 409);
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
            return response()->json([
                'user' => $user,
            ], 200);
        }
        return response()->json([
            'User was not found',
        ], 404);
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
            'sexe' => 'min:1|boolean',
            'phone' => 'min:10|max:10|alpha_num',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'ErrorCode' => 1,
                'error' => $validator->errors()->messages(),
            ], 400);
        } else {
            return response()->json([
                'edited user' => User::whereId($id)->update($request->input()),
            ], 200);
        }
    }
}
