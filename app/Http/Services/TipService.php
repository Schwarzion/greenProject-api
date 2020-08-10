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
            'status' => 200,
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
                'status' => 200,
                'msg' => "tip {$id} has been deleted",
            ];
        } else {
            return [
                'status' => 404,
                'msg' => "tip {$id} not found",
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
            'name' => 'required|max:45|unique:tip,name',
            'desc' => 'required|max:120',
        ]);
        if ($validator->fails()) {
            print('FAILED');
            return [
                'status' => 400,
                'msg' => $validator->errors()->messages(),
            ];
        } else {
            print('DID NOT FAILED');
            return [
                'status' => 200,
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
                'status' => 200,
                'tip' => $tip,
                'msg' => "tip {$id} has been found",
            ];
        }
        return [
            'status' => 404,
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
                'name' => 'min:2|max:45',
                'desc' => 'min:2|max:120',
            ]);
            if ($validator->fails()) {
                return [
                    'status' => 400,
                    'msg' => $validator->errors()->messages(),
                ];
            } else {
                $tip = Tip::whereId($id)->update($request->input());
                return [
                    'status' => 200,
                    'tip' => Tip::find($id),
                    'msg' => "tip {$id} has been updated",
                ];
            }
        } else {
            return [
                'status' => 404,
                'msg' => "tip {$id} was not found",
            ];
        }
    }
}
