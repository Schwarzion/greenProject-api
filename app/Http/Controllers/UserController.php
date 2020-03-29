<?php
namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create']]); //Should use it + add exception for create
        $this->userService = new UserService();
    }

    /**
     * Create a new user
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        return $this->userService->create($request);
    }

    /**
     * Get all User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->userService->getAll();
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
        return $this->userService->delete($id);
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
        return $this->userService->show($id);
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
        return $this->userService->update($request, $id);
    }
}
