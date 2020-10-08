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
            'status' => 200,
            'quests' => Quest::all(),
            'msg' => 'Liste des quêtes',
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
                'status' => 200,
                'msg' => "La quête {$id} a bien été supprimé",
            ];
        } else {
            return [
                'status' => 400,
                'ErrorCode' => 1,
                'msg' => "La quête {$id} ne peux pas être supprimer, il n'existe peut-être pas",
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
            'expAmount' => 'required|max:1000|integer',
            'minLevel' => 'required|max:50|integer',
            'timeForQuest' => 'required|integer',
            'endDate' => 'required|date'
        ]);

        if ($validator->fails()) {
            return [
                'status' => 400,
                'ErrorCode' => 1,
                'msg' => $validator->errors()->messages(),
            ];
        } else {
            return [
                'status' => 200,
                'quest' => Quest::create($request->input()),
                'msg' => 'La quête a bien été créée',
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
                'status' => 200,
                'quest' => $quest,
                'msg' => "La quête {$id} a été trouvée",
            ];
        }
        return [
            'status' => 400,
            'ErrorCode' => 1,
            'msg' => "La quête {$id} n'a pas été trouvée",
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
                'name' => 'required|max:45',
                'desc' => 'required|max:120',
                'expAmount' => 'required|max:1000|integer',
                'minLevel' => 'required|max:50|integer',
                'timeForQuest' => 'required|integer',
                'endDate' => 'required|date'
            ]);
            if ($validator->fails()) {
                return [
                    'status' => 400,
                    'ErrorCode' => 1,
                    'msg' => $validator->errors()->messages(),
                ];
            } else {
                return [
                    'status' => 200,
                    'quest' => Quest::whereId($id)->update($request->input()),
                    'msg' => "La quête {$id} a été modifiée",
                ];
            }
        } else {
            return [
                'status' => 404,
                'ErrorCode' => 1,
                'msg' => "La quête {$id} n'a pas été trouvée",
            ];
        }
    }
}
