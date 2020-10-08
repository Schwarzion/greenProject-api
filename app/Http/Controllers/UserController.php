<?php
namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     * User Service dependancy injection (strong typed)
     *
     * @return void
     */
    public function __construct(UserService $service)
    {
        $this->middleware('auth', ['except' => ['create']]); //Should use it + add exception for create
        $this->userService = $service;
    }

    /**
     * Create a new user
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $res = $this->userService->register($request);
        return response()->json($res, $res['status']);
    }

    /**
     * Get all User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $res = $this->userService->getAll();
        return response()->json($res, $res['status']);
    }

    /**
     * Delete one User
     *
     * @param $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $res = $this->userService->delete($id);
        return response()->json($res, $res['status']);
    }

    /**
     * Get an User
     *
     * @param $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $res = $this->userService->show($id);
        return response()->json($res, $res['status']);
    }

    /**
     * Update User
     *
     * @param Illuminate\Http\Request
     *        $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $res = $this->userService->update($request, $id);
        return response()->json($res, $res['status']);
    }

    public function getUserQuests(Request $request)
    {
        $res = $this->userService->getUserQuests($request);
        return response()->json($res, $res['status']);
    }

    public function addQuest(Request $request, $id)
    {
        $res = $this->userService->addQuest($request, $id);
        return response()->json($res, $res['status']);
    }

    public function removeQuest(Request $request, $id)
    {
        $res = $this->userService->removeQuest($request, $id);
        return response()->json($res, $res['status']);
    }
}
