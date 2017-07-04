<?php

namespace App\Http\Controllers;

use App\Tag;
use App\UserDetail;
use App\Entry;
use App\Service\EventService;
use App\Http\Requests\Event\GetEventDataRequest;
use App\Http\Requests\Participant\DeleteParticipantRequest;
use App\Http\Requests\Participant\GetParticipantsRequest;
use App\Http\Requests\Participant\StoreParticipantRequest;
use App\Http\Requests\Participant\UpdateEvaluateRequest;
use App\Participant;
use Illuminate\Http\Request;
use Log;
use App\Event;
use App\Service\AuthService;

class EventController extends Controller
{
    // EventService登録
    private $event_service = null;
    private $auth = null;

    public function __construct(EventService $event_service, AuthService $auth)
    {
        $this->event_service = $event_service;
        $this->auth = $auth;
    }

    /**
     * イベントの一覧を取得
     *
     * @param Request $request
     * @return Response
     */
    public function getEvents(Request $request)
    {
        $count = 10; // TODO 後で良い感じの設定クラスに分割?
        if ($request->input('count')) {
            $count = $request->input('count');
        }
        $events = Event::all()
            ->take($count);
        return response()->json(['events' => $events], 200);
    }

    /**
     * 指定イベントの情報を取得
     *
     * @param  int $id
     * @return Response
     */
    public function getEvent($id)
    {
        $event = Event::find($id);

        if ($event == null) {
            return response()->json([], 404);
        }

        return response()->json(['event' => $event], 200);
    }

    /**
     * イベントを追加する
     * 認証していないユーザが追加しようとした場合403を返す
     * @param Request $request
     * @return json
     */
    public function storeEvent(Request $request)
    {

        $user = $request->user();

        if ($user == null) {
            return response()->json([], 403);
        }

        $event = new Event;
        $event->title = $request->input('event.title');
        $event->catch_image = $request->input('event.catch_image');
        $event->place = $request->input('event.place');
        $event->day = $request->input('event.day');
        $event->genre = $request->input('event.genre');
        $event->tag = $request->input('event.tag');
        $event->content = $request->input('event.content');
        $event->save();


        return response()->json($event, 200);
    }

    /**
     * イベントを更新する
     *
     * @param Request $request
     * @param $id
     *
     * @return json
     */
    public function updateEvent(Request $request, $id)
    {

        $event = Event::find($id);

        if ($event == null) {
            return response()->json([], 404);
        }

        $user = $request->user();

        if ($user == null) {
            return response()->json([], 403);
        }

        $event->title = $request->input('event.title');
        $event->catch_image = $request->input('event.catch_image');
        $event->place = $request->input('event.place');
        $event->day = $request->input('event.day');
        $event->genre = $request->input('event.genre');
        $event->tag = $request->input('event.tag');
        $event->content = $request->input('event.content');
        $event->save();

        return response()->json($event, 200);
    }


    /**
     * 指定イベントを削除
     *
     * @param $request
     * @param $id
     * @return json
     */
    public function deleteEvent(Request $request, $id)
    {
        $event = Event::find($id);
        if ($event == null) {
            return response()->json([], 404);
        }

        $user = $request->user();

        if ($user == null) {
            return response()->json([], 403);
        }

        $event->delete();

        return response()->json([], 200);
    }

    /**
     * 指定イベントの主催者一覧を取得
     *
     * @param $id
     * @return json
     */
    public function getOrganizers($id)
    {
        $event = Event::find($id);
        if ($event == null) {
            return response()->json([], 404);
        }


        $organizers = $event->organizers;

        if ($organizers == null || collect($organizers)->isEmpty()) {
            // 主催者が無いイベントはあり得ないのでログを残す
            Log::emergency("主催者がイベントに紐付いていない例外が発生");
            return response()->json([], 404);
        }

        return response()->json(['organizers' => $organizers], 200);
    }

    /**
     *
     */
    public function getEntries($id)
    {
        $event = Event::find($id);
        if ($event == null) {
            return response()->json([], 404);
        }

        $entries = $event->entries;

        if ($entries == null || collect($entries)->isEmpty()) {
            // 参加枠がないのはおかしいはずなのでログを残す
            Log::emergency("参加枠がイベントに紐付いていない例外が発生");
            return response()->json([], 404);
        }

        return response()->json(['entries' => $entries], 200);
    }

    public function storeEntry(Request $request, $id)
    {
        $user = $request->user();

        if ($user == null) {
            return response()->json([], 403);
        }

        $event = Event::find($id);

        if ($event == null) {
            return response()->json([], 404);
        }

        $entry = new Entry;
        $entry->event_entry_name = $request->input('entry.name');
        $entry->event_entry_max_num = $request->input('entry.max_num');
        $entry->event_entry_now_num = 0;
        $event->entries()->save($entry);

        return response()->json(['entry' => $entry], 200);

    }

    public function updateEntry(Request $request, $id, $entry_id)
    {
        $user = $request->user();

        if ($user == null) {
            // ログイン出来ていない場合
            return response()->json([], 403);
        }

        $event = Event::find($id);

        if ($event == null) {
            // イベントが見つからない場合
            return response()->json([], 404);
        }

        $organizer = $event->organizers->where('user_id', $id);

        if ($organizer == null) {
            // 指定ユーザが管理者ではない場合
            return response()->json([], 403);
        }

        $entry = $event->entries->where('id', $entry_id)->first();

        if ($entry == null) {
            // イベントに指定の参加枠が無い場合
            return response()->json([], 404);
        }

        $entry->event_entry_name = $request->input('entry.name');
        $entry->event_entry_max_num = $request->input('entry.max_num');
        $entry->save();

        return response()->json(['entry' => $entry], 200);
    }

    public function deleteEntry(Request $request, $id, $entry_id)
    {
        $user = $request->user();

        if ($user == null) {
            // ログイン出来ていない場合
            return response()->json([], 403);
        }

        $event = Event::find($id);

        if ($event == null) {
            // イベントが見つからない場合
            return response()->json([], 404);
        }

        $organizer = $event->organizers->where('user_id', $id);

        if ($organizer == null) {
            // 指定ユーザが管理者ではない場合
            return response()->json([], 403);
        }

        $entry = $event->entries->where('id', $entry_id)->first();

        if ($entry == null) {
            // イベントに指定の参加枠が無い場合
            return response()->json([], 404);
        }

        $entry->delete();

        return response()->json([], 200);
    }

    public function getRegisterEvents(Request $request) {

        $user =$this->auth->getLoginUser();

        if ($user == null) {
            return response()->json([], 403);
        }

        $participants = Participant::where('user_id', $user->id)->get();

        $returnData = array();
        $i = 0;
        foreach ($participants as $participant) {
            $entry = $participant->entry;
            $event = $entry->event;

            $returnEvent = array();
            $returnEvent['id'] = $event->id;
            $returnEvent['title'] = $event->title;
            $returnEvent['catch_image'] = $event->catch_image;
            $returnEvent['place'] = $event->place;
            $returnEvent['day'] = $event->day;

            $returnEntry = array();
            $returnEntry['name'] = $entry->event_entry_name;

            $returnData[$i]['event'] = $returnEvent;
            $returnData[$i]['entry'] = $returnEntry;

            ++$i;
        }

        return response()->json(['events' => $returnData], 200);

    }

    public function getParticipants(GetParticipantsRequest $request, $id, $entry_id)
    {
        $event = Event::find($id);

        if ($event == null) {
            return response()->json([], 404);
        }

        $entry = $event->entries->where('id', $entry_id)->first();

        if ($entry == null) {
            return response()->json([], 404);
        }

        $participants = $entry->participants->sortByDesc("created_at")->take($entry->event_entry_max_num);

        return response()->json(['participants' => $participants], 200);
    }

    public function storeParticipant(StoreParticipantRequest $request, $id, $entry_id)
    {
        $user =$this->auth->getLoginUser();
        if ($user == null) {
            return response()->json([], 403);
        }

        $event = Event::find($id);

        $entry = $event->entries->where('id', $entry_id)->first();

        if (!$this->event_service->checkUserDetailColumn($user->detail)) {
            return response()->json([], 403);
        }

        $participant = new Participant;
        $participant->event_id = $event->id;
        $participant->user_id = $user->id;
        $participant->entry_id = $entry_id;
        $participant->event_evaluate = 0;

        $entry->participants()->save($participant);
        $entry->event_entry_now_num = $entry->participants()->count();
        $entry->save();
        return response()->json(['participant' => $participant], 200);
    }

    public function deleteParticipant(DeleteParticipantRequest $request, $id, $entry_id, $participant_id)
    {
        $user =$this->auth->getLoginUser();
        if ($user == null) {
            return response()->json([], 403);
        }

        if ($user->id != $participant_id) {
            // ユーザと削除しようとしているユーザが違う場合
            return response()->json([], 403);
        }

        $event = Event::find($id);

        if ($event == null) {
            // イベントが見つからない場合
            return response()->json([], 404);
        }

        $entry = $event->entries->where('id', $entry_id)->first();

        if ($entry == null) {
            // 参加枠が見つからない場合
            return response()->json([], 404);
        }

        $participant = $entry->participants->where('user_id', $participant_id)->first();

        if ($participant == null) {
            // 指定した参加者が居ない場合
            return response()->json([], 404);
        }

        $participant->delete();
        $entry->event_entry_now_num = $entry->participants()->count();
        $entry->save();
        return response()->json([], 200);
    }

    public function updateEvaluate(UpdateEvaluateRequest $request, $id, $entry_id, $participant_id)
    {
        $user = $request->user();

        if ($user == null) {
            // ログイン出来ていない場合
            return response()->json([], 403);
        }

        if ($user->id != $participant_id) {
            // 認証ユーザと変更するユーザが違う場合
            return response()->json([], 403);
        }

        $event = Event::find($id);

        if ($event == null) {
            // イベントが見つからない場合
            return response()->json([], 404);
        }

        $entry = $event->entries->where('id', $entry_id)->first();

        if ($entry == null) {
            // 参加枠が見つからない場合
            return response()->json([], 404);
        }

        $participant = $entry->participants->where('user_id', $participant_id)->first();

        if ($participant == null) {
            // 指定した参加者が居ない場合
            return response()->json([], 404);
        }

        $participant->event_evaluate = $request->input('evaluate');
        $participant->save();

        return response()->json([], 200);
    }

    public function getEventData(GetEventDataRequest $request, $event_id)
    {

        $user = $request->user();

        $event = Event::find($event_id);
        $returnData['created_at'] = $event->created_at->format('Y-m-d H:i:s');
        $returnData['updated_at'] = $event->updated_at->format('Y-m-d H:i:s');
        $returnData['event_id'] = $event->id;

        $detailData = array();
        $returnJoinEntry = array();

        $i = 0;
        $returnOrganizers = array();
        $organizers = $event->organizers;
        foreach ($organizers as $organizer) {
            $returnOrganizers[$i]['user_id'] = $organizer->user_id;

            $user_detail = UserDetail::find($organizer->user_id);
            $returnOrganizers[$i]['display_name'] = $user_detail->display_name;
            ++$i;
        }
        $detailData['organizers'] = $returnOrganizers;

        $i = 0;
        $returnEntries =  array();
        $entries = $event->entries;
        foreach ($entries as $entry) {
            $returnEntries[$i]['id'] = $entry->id;
            $returnEntries[$i]['name'] = $entry->event_entry_name;
            $returnEntries[$i]['max_num'] = $entry->event_entry_max_num;
            $returnEntries[$i]['current_num'] = $entry->event_entry_now_num;

            foreach ($entry->participants as $participant) {
                if ($participant->user_id == $user->id) {
                    $returnJoinEntry['id'] = $entry->id;
                }
            }
            ++$i;
        }
        $detailData['entries'] = $returnEntries;

        $detailData['genre'] = $event->genre;
        $detailData['eye_catch_image'] = $event->catch_image;
        $detailData['day'] = $event->day;
        $detailData['start_time'] = $event->start_time;
        $detailData['end_time'] = $event->end_time;
        $detailData['title'] = $event->title;
        $detailData['place'] = $event->place;
        $detailData['place_title'] = $event->place_title;
        $detailData['content'] = $event->content;
        $detailData['join_pay'] = $event->join_pay;

        $timeSchedulesData = array();
        $timeSchedules = $event->time_schedules()->orderBy('time', 'asc')->get();
        $i = 0;
        foreach ($timeSchedules as $timeSchedule) {
            $date = date_create($timeSchedule->time);
            $timeSchedulesData[$i]['time'] = date_format($date, 'H:i');
            $timeSchedulesData[$i]['content'] = $timeSchedule->content;
            ++$i;
        }
        $detailData['time_schedules'] = $timeSchedulesData;

        $returnData['detail'] = $detailData;

        $tagData = array();
        $tagIds = explode(",", $event->tag);
        $i = 0;
        foreach ($tagIds as $tagId) {
            $tag = Tag::find($tagId);
            $tagData[$i]['id'] = intval($tagId);
            $tagData[$i]['tag'] = $tag->tag;
            ++$i;
        }
        $returnData['tags'] = $tagData;

        if (!empty($returnJoinEntry)) {
            $returnData['join_entry'] = $returnJoinEntry;
        }

        return response()->json(['event' => $returnData], 200);
    }

    public function getParticipantsList(Request $request, $event_id) {
        $event = Event::find($event_id);

        $i = 0;
        $returnOrganizers = array();
        $organizers = $event->organizers;
        foreach ($organizers as $organizer) {
            $returnOrganizers[$i]['user_id'] = $organizer->user_id;
            $returnOrganizers[$i]['comment'] = $organizer->comment;
            $returnOrganizers[$i]['priority_ranking'] = $organizer->priority_ranking;
            ++$i;
        }
        $returnData['organizers'] = $returnOrganizers;

        $i = 0;
        $returnEntries = array();
        $entries = $event->entries;
        foreach ($entries as $entry) {
            $entry_max_num = $entry->event_entry_max_num;
            $returnEntries[$i]['id'] = $entry->id;
            $returnEntries[$i]['name'] = $entry->event_entry_name;
            $returnEntries[$i]['max_num'] = $entry_max_num;
            $returnEntries[$i]['current_num'] = $entry->event_entry_now_num;

            $j = 0;
            $returnParticipants = array();
            $returnSubstituteParticipants = array();
            $participants = $entry->participants()->orderBy('created_at', 'asc')->get();
            foreach ($participants as $participant) {
                if ($j < $entry_max_num) {
                    $returnParticipants[$j]['user_id'] = $participant->user_id;
                } else {
                    $returnSubstituteParticipants[$j - $entry_max_num]['user_id'] = $participant->user_id;
                }

                ++$j;
            }
            $returnEntries[$i]['participants'] = $returnParticipants;
            $returnEntries[$i]['substitute_participants'] = $returnSubstituteParticipants;
            ++$i;
        }
        $returnData['entries'] = $returnEntries;

        return response()->json(['event' => $returnData], 200);
    }

    public function getOrganizerEvents(Request $request) {
        $user =$this->auth->getLoginUser();
        if ($user == null) {
            return response()->json([], 403);
        }

        $returnEvents = array();
        $i = 0;
        $organizers = $user->organizers;
        foreach ($organizers as $organizer) {
            $event = $organizer->event;
            $returnEvents[$i]['id'] = $event->id;
            $returnEvents[$i]['title'] = $event->title;
            $returnEvents[$i]['catch_image'] = $event->catch_image;
            $returnEvents[$i]['place'] = $event->place;
            $returnEvents[$i]['day'] = $event->day;
            ++$i;
        }

        $returnData['events'] = $returnEvents;

        return response()->json($returnData, 200);

    }

}
