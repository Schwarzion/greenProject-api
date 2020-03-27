<?php

namespace App\Http\Controllers;

use App\models\Tip;
use Illuminate\Http\Request;

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
    }

    /**
     * Get all tips
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllTips()
    {
        return response()->json([
            'tips' => Tip::all(),
        ], 200);
    }

    /**
     * Delete one tip
     * 
     * @param $id (int)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTip($id)
    {
        return response()->json([
            Tip::whereId($id)->delete($id),
        ], 200);
    }

    /**
     * Add a tip
     * 
     * @param Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function addTip(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'desc' => 'required',
        ]);
        return response()->json([
            Tip::create($request->input()),
        ], 200);
    }

    /**
     * Get a Tip
     * 
     * @param $id (int)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTip($id)
    {
        return response()->json([
            Tip::findOrFail($id),
        ], 200);
    }

    /**
     * Update tip
     * 
     * @param Illuminate\Http\Request
     *        $id (int)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTip(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'desc' => 'required',
        ]);
        return response()->json([
            Tip::whereId($id)->update($request->input()),
        ], 200);
    }
}
