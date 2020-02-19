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
        //  $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'api_token' => Str::random(60),
        ]);
        return response()->json(['user' => $user]);
    }

    public function register()
    {

    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            return response()->json(['status' => 'authenticated', 'token' => 'exampleToken']);
        } else {
            return response()->json(['status' => 'unauthenticated'], 401);
        }

        // if (Hash::check($request->input('password'), $user->password)) {
        //     $apikey = base64_encode(str_random(40));
        //     User::where('email', $request->input('email'))->update(['api_key' => "$apikey"]);
        //     return response()->json(['status' => 'success', 'api_key' => $apikey]);
        // } else {
        //     return response()->json(['status' => 'fail'], 401);
        // }
    }
}
