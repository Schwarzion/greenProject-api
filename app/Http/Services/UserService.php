<?php

namespace App\Http\Services;

use App\models\User;
use Illuminate\Http\Request;
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
        return response()->json([
            User::all(),
        ], 200);
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
        return response()->json([
            User::whereId($id)->delete($id),
        ], 200);
    }

    /**
     * Add a User
     *
     * @param Illuminate\Http\Request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
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
            return response()->json([
                User::create($request->input()),
            ], 200);
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
        return response()->json([
            User::findOrFail($id),
        ], 200);
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
            return response()->json([
                User::whereId($id)->update($request->input()),
            ], 200);
        }
    }
}
