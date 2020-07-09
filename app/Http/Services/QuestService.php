<?php

namespace App\Http\Services;

use App\models\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestService extends Service
{
    public function __construct()
    {

    }

    /**
     * Get all quests
     * Return empty array if no quests are present in database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        return [
            'status' => true,
            'tips' => Tip::all(),
            'msg' => 'list of tips',
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
                'msg' => "tip {$id} has been deleted",
            ];
        } else {
            return [
                'status' => false,
                'ErrorCode' => 1,
                'msg' => "user tip {$id} not found",
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
                'msg' => 'tip has been sucessfully created',
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
                'msg' => "tip {$id} has been found",
            ];
        }
        return [
            'status' => false,
            'ErrorCode' => 1,
            'msg' => "tip {$id} was not found",
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
                    'msg' => "tip {$id} has been updated",
                ];
            }
        } else {
            return [
                'status' => false,
                'ErrorCode' => 1,
                'msg' => "tip {$id} was not found",
            ];
        }
    }
}
