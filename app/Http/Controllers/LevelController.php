<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\LevelService;

class LevelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LevelService $service)
    {
        $this->middleware('auth');
        $this->levelService = $service;
    }

    /**
     * Get all levels
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $res = $this->levelService->getAll();
        return response()->json($res, $res['status']);
    }

    /**
     * Get a Level
     *
     * @param $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $res = $this->levelService->show($id);
        return response()->json($res, $res['status']);
    }

    /**
     * Add a level
     *
     * @param Illuminate\Http\Request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $res = $this->levelService->newLevel($request);
        return response()->json($res, $res['status']);
    }

    /**
     * Delete one level
     *
     * @param $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $res = $this->levelService->delete($id);
        return response()->json($res, $res['status']);
    }

    /**
     * Update Level
     *
     * @param Illuminate\Http\Request
     *        $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $res = $this->levelService->update($request, $id);
        return response()->json($res, $res['status']);
    }
}
