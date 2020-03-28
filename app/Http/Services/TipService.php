<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\models\Tip;

class TipService extends Service
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
            Tip::all(),
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
    public function create(Request $request)
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
    public function show(int $id)
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
    public function update(Request $request, int $id)
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
