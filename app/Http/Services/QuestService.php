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
            'quests' => Quest::all(),
            'msg' => 'list of quests',
        ];
    }

    /**
     * Delete one quest
     *
     * @param $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        $delete = Quest::whereId($id)->delete($id);
        if ($delete) {
            return [
                'status' => true,
                'msg' => "quest {$id} has been deleted",
            ];
        } else {
            return [
                'status' => false,
                'ErrorCode' => 1,
                'msg' => "quest {$id} not found",
            ];
        }
    }

    /**
     * Add a quest
     *
     * @param Illuminate\Http\Request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function newQuest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'desc' => 'required|max:120',
            'expAmount' => 'required|max:11|integer',
            'minLevel' => 'required|max:11|integer',
            'timeForQuest' => '',
            'endDate' => 'required|date'
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
                'quest' => Quest::create($request->input()),
                'msg' => 'quest has been sucessfully created',
            ];
        }
    }

    /**
     * Get a Quest
     *
     * @param $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $quest = Quest::find($id);
        if ($quest) {
            return [
                'status' => true,
                'quest' => $quest,
                'msg' => "quest {$id} has been found",
            ];
        }
        return [
            'status' => false,
            'ErrorCode' => 1,
            'msg' => "quest {$id} was not found",
        ];
    }

    /**
     * Update quest
     *
     * @param Illuminate\Http\Request
     *        $id (int)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $quest = Quest::find($id);
        if ($quest) {
            $validator = Validator::make($request->all(), [
                'name' => 'max:45',
                'desc' => 'max:120',
                'expAmount' => 'max:11|integer',
                'minLevel' => 'max:11|integer',
                'timeForQuest' => '',
                'endDate' => 'date'
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
                    'quest' => Quest::whereId($id)->update($request->input()),
                    'msg' => "quest {$id} has been updated",
                ];
            }
        } else {
            return [
                'status' => false,
                'ErrorCode' => 1,
                'msg' => "quest {$id} was not found",
            ];
        }
    }

    public function assignQuestToUser() 
    {

    }

    public function getDeadline()
    {
        
    }
}
