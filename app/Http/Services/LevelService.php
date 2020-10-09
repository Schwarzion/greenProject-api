<?php

namespace App\Http\Services;

use App\models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LevelService extends Service
{
    public function __construct()
    {
    }

    /**
     * Get all levels
     * Return empty array if no levels are present in database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        return [
            'status' => 200,
            'levels' => Level::all(),
            'msg' => 'list of levels',
        ];
    }

    /**
     * Get a Level
     *
     * @param $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $level = Level::find($id);
        if ($level) {
            return [
                'status' => 200,
                'level' => $level,
                'msg' => "level {$id} has been found",
            ];
        }
        return [
            'status' => 404,
            'msg' => "level {$id} was not found",
        ];
    }

    /**
     * Add a level
     *
     * @param Illuminate\Http\Request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function newLevel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45|unique:level,name',
            'desc' => 'required|max:120',
            'levelExpAmount' => 'required|max:1000000',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 400,
                'msg' => $validator->errors()->messages(),
            ];
        } else {
            return [
                'status' => 200,
                'level' => Level::create($request->input()),
                'msg' => 'level has been sucessfully created',
            ];
        }
    }

    /**
     * Delete one level
     *
     * @param $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        $delete = Level::whereId($id)->delete($id);
        if ($delete) {
            return [
                'status' => 200,
                'msg' => "level {$id} has been deleted",
            ];
        } else {
            return [
                'status' => 400,
                'msg' => "level {$id} not found",
            ];
        }
    }


    /**
     * Update level
     *
     * @param Illuminate\Http\Request
     *        $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $level = Level::find($id);
        if ($level) {
            $validator = Validator::make($request->all(), [
                'name' => 'min:2|max:45',
                'desc' => 'min:2|max:120',
                'levelExpAmount' => 'min:0|max:1000000',
            ]);
            if ($validator->fails()) {
                return [
                    'status' => 400,
                    'msg' => $validator->errors()->messages(),
                ];
            } else {
                $level = Level::whereId($id)->update($request->input());
                return [
                    'status' => 200,
                    'level' => Level::find($id),
                    'msg' => "level {$id} has been updated",
                ];
            }
        } else {
            return [
                'status' => 404,
                'msg' => "level {$id} was not found",
            ];
        }
    }
}
