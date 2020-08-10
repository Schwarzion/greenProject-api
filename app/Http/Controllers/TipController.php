<?php

namespace App\Http\Controllers;

use App\Http\Services\TipService;
use Illuminate\Http\Request;

class TipController extends Controller
{
    /**
     * Create a new controller instance.
     * Tip Service dependancy injection (strong typed)
     *
     * @return void
     */
    public function __construct(TipService $service)
    {
        $this->middleware('auth');
        $this->tipService = $service;
    }

    /**
     * Get all tips
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $res = $this->tipService->getAll();
        return response()->json($res, $res->status);
    }

    /**
     * Delete one tip
     *
     * @param $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $res = $this->tipService->delete($id);
        return response()->json($res, $res->status);
    }

    /**
     * Add a tip
     *
     * @param Illuminate\Http\Request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $res = $this->tipService->newTip($request);
        return response()->json($res, $res['status']);
    }

    /**
     * Get a Tip
     *
     * @param $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $res = $this->tipService->show($id);
        return response()->json($res, $res['status']);
    }

    /**
     * Update tip
     *
     * @param Illuminate\Http\Request
     *        $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $res = $this->tipService->update($request, $id);
        return response()->json($res, $res['status']);
    }
}
