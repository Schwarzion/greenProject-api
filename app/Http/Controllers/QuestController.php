<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\TipService;

class QuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(QuestService $service)
    {
        $this->middleware('auth');
        $this->questService = $service;
    }

    /**
     * Get all quests
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->questService->getAll());
    }

    /**
     * Delete one quest
     * 
     * @param $id (int)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        return response()->json($this->questService->delete($id));
    }

    /**
     * Add a quest
     * 
     * @param Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        return response()->json($this->questService->newQuest($request));
    }

    /**
     * Get a Quest
     * 
     * @param $id (int)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json($this->questService->show($id));
    }

    /**
     * Update Quest
     * 
     * @param Illuminate\Http\Request
     *        $id (int)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {   
        return response()->json($this->questService->update($request, $id));
    }
}
