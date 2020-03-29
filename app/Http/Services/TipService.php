<?php

namespace App\Http\Services;

use App\models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'desc' => 'required|max:120',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'ErrorCode' => 1,
                'error' => $validator->errors()->messages(),
            ], 400);
        } else {
            return response()->json([
                Tip::create($request->input()),
            ], 200);
        }
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'desc' => 'required|max:120',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'ErrorCode' => 1,
                'error' => $validator->errors()->messages(),
            ], 400);
        } else {
            return response()->json([
                Tip::whereId($id)->update($request->input()),
            ], 200);
        }
    }
}
