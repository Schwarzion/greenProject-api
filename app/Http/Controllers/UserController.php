<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        //Midleware use example to protect controller access form unauthenticated users
        //this->middleware('auth:api'); //Should use it + add exception for create
    }

    /**
     * Create a new user
     *
     * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required|max:30|alpha_dash',
            'lastName' => 'required|max:30|alpha_dash',
            'alias' => 'required|max:20|unique:user,alias',
            'email' => 'required|max:89|email|unique:user,email',
            'password' => 'required|max:50',
            'address' => 'required|max:60',
            'city' => 'required|max:30|alpha_dash',
            'postalCode' => 'required|max:5|alpha_num',
            'birthday' => 'required|date|before:today',
            'sexe' => 'required|boolean',
            'phone' => 'required|max:10|alpha_num',
            //todo : add password confirmation ('confirmed')
        ]);

        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'api_token' => Str::random(60),
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
            return response()->json(['message' => 'User sucessfully registered', 'user' => $user]);
        } else {
            return response()->json(['message' => 'Cannot register user'], 409);
        }

    }

}
