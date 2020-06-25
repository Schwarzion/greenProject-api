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
     * Return empty array if no user are present in database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        return [
            'status' => true,
            'tips' => Tip::all()
        ];
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
        $delete = Tip::whereId($id)->delete($id);
        if ($delete) {
            return [
                'status' => true,
                'msg' => 'tip has been deleted',
            ];
        } else {
            return [
                'status' => false,
                'ErrorCode' => 1,
                'msg' => 'user tip be deleted, might not exist',
            ];
        }
    }

    /**
     * Add a tip
     *
     * @param Illuminate\Http\Request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function newTip(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'desc' => 'required|max:120',
        ]);
        if ($validator->fails()) {
            return [
                'status' => false,
                'ErrorCode' => 1,
                'msg' => $validator->errors()->messages(),
            ];
        } else {
            return [
                'status' => true,
                'tip' => Tip::create($request->input()),
                'msg' => 'Tip has been sucessfully created',
            ];
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
        $tip = Tip::find($id);
        if ($tip) {
            return [
                'status' => true,
                'tip' => $tip,
                'msg' => 'Tip has been found',
            ];
        }
        return [
            'status' => false,
            'ErrorCode' => 1,
            'msg' => 'Tip was not found',
        ];
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
        $tip = Tip::find($id);
        if ($tip) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:45',
                'desc' => 'required|max:120',
            ]);
            if ($validator->fails()) {
                return [
                    'status' => false,
                    'ErrorCode' => 1,
                    'msg' => $validator->errors()->messages(),
                ];
            } else {
                return [
                    'status' => true,
                    'tip' => Tip::whereId($id)->update($request->input()),
                    'msg' => 'Tip has been found',
                ];
            }
        } else {
            return [
                'status' => false,
                'ErrorCode' => 1,
                'msg' => 'Tip was not found',
            ];
        }
    }
}
