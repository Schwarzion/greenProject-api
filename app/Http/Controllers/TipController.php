<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\TipService;

class TipController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->tipService = new TipService();
    }

    /**
     * Get all tips
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->tipService->getAll();
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
        return $this->tipService->delete($id);
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
        return $this->tipService->newTip($request);
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
        return $this->tipService->show($id);
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
        return $this->tipService->update($request, $id);
    }
}
