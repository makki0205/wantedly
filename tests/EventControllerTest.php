<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;

class EventControllerTest extends TestCase
{
    /**
     * イベント一覧取得の正常テスト
     */
    public function testSuccessGetEvents()
    {
        $events = factory(App\Event::class, 2)
            ->create()
            ->each(function ($event) {
               // $event->save();
            });
        $response = $this->json('GET', "/api/events")->seeStatusCode(200);

        $response->seeJsonEquals(['events' =>[
            [
                'id' => 1,
                'title' => $events[0]->title,
                'catch_image' => $events[0]->catch_image,
                'place' => $events[0]->place,
                'day' => $events[0]->day->format('Y-m-d H:i:s'),
                'genre' => $events[0]->genre,
                'tag' => $events[0]->tag,
                'content' => $events[0]->content,
                'created_at' => $events[0]->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $events[0]->updated_at->format('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'title' => $events[1]->title,
                'catch_image' => $events[1]->catch_image,
                'place' => $events[1]->place,
                'day' => $events[1]->day->format('Y-m-d H:i:s'),
                'genre' => $events[1]->genre,
                'tag' => $events[1]->tag,
                'content' => $events[1]->content,
                'created_at' => $events[1]->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $events[1]->updated_at->format('Y-m-d H:i:s')
            ]
        ]]);

    }
    /**
     * イベントアップデート時にイベントが無い場合404が返されているかテスト
     */
    public function testFailNotFoundUpdateEvent()
    {
        // 更新ユーザ
        $user = factory(App\User::class)->create();

        $response = $this->actingAs($user)->json('PATCH', '/api/events/1',
            []
        )->seeStatusCode(404);
        $response->seeJsonEquals([]);
    }

    /**
     * イベントアップデート時にユーザ認証が出来てない場合403が返されているかテスト
     */
    public function testFailUserUpdateEvent()
    {
        factory(App\Event::class)->create();
        $response = $this->json('PATCH', '/api/events/1',
            []
        )->seeStatusCode(403);
        $response->seeJsonEquals([]);
    }

    public function testSuccessDeleteEvent()
    {
        $user = factory(App\User::class)->create();
        // 事前イベントデータをセットしておく
        $event = factory(App\Event::class)
            ->create();
        $event->save();

        $response = $this->actingAs($user)->json('DELETE', '/api/events/1')->seeStatusCode(200);

        $response->seeJsonEquals([]);
    }


    /**
     * イベントが無い場合404が返ってくるかテスト
     */
    public function testFailNotFoundDeleteEvent()
    {
        $user = factory(App\User::class)->create();
        $response = $this->actingAs($user)->json('DELETE', '/api/events/1')->seeStatusCode(404);
        $response->seeJsonEquals([]);
    }

    /**
     * ユーザ認証がされていない場合403が返ってくるかテスト
     */
    public function testFailUserDeleteEvent()
    {
        factory(App\Event::class)->create()->save();
        $response = $this->json('DELETE', '/api/events/1')->seeStatusCode(403);
        $response->seeJsonEquals([]);
    }

    /**
     * 指定イベントの主催者一覧取得の正常テスト
     */
    public function testSuccessGetOrganizers()
    {
        // 事前準備
        $event = factory(App\Event::class)
            ->create()
            ->save();

        $users = factory(App\User::class, 2)
            ->create()
            ->each(function ($user) {
                $user->save();
            });

        $organizers = factory(App\Organizer::class, 2)
            ->create();

        $organizers[0]->event_id = 1;
        $organizers[0]->user_id = $users[0]->id;
        $organizers[1]->event_id = 1;
        $organizers[1]->user_id = $users[1]->id;

        $organizers[0]->save();
        $organizers[1]->save();

        // レスポンスチェック
        $response = $this->json('GET', 'api/events/1/organizers')->seeStatusCode(200);
        $response->seeJsonEquals([
            "organizers" => [
                [
                    "id" => 1,
                    "event_id" => 1,
                    "user_id" => $users[0]->id,
                    "comment" => $organizers[0]->comment,
                    "priority_ranking" => $organizers[0]->priority_ranking
                ],
                [
                    "id" => 2,
                    "event_id" => 1,
                    "user_id" => $users[1]->id,
                    "comment" => $organizers[1]->comment,
                    "priority_ranking" => $organizers[1]->priority_ranking
                ]
            ]
        ]);
    }


    /**
     * 指定したidのイベントが正しく取得出来ているかを確認
     */
    public function testSuccessGetEvent()
    {
        $events = factory(App\Event::class, 3)
            ->create()
            ->each(function ($event) {
                $event->save();
            });

        $response = $this->json('GET', "/api/events/2")->seeStatusCode(200);
        $response->seeJsonEquals(["event" => [
            'id' => 2,
            'title' => $events[1]->title,
            'catch_image' => $events[1]->catch_image,
            'place' => $events[1]->place,
            'day' => $events[1]->day->format('Y-m-d H:i:s'),
            'genre' => $events[1]->genre,
            'tag' => $events[1]->tag,
            'content' => $events[1]->content,
            'created_at' => $events[1]->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $events[1]->updated_at->format('Y-m-d H:i:s')

        ]]);
    }

    /**
     * 存在しないイベントが指定されたとき404を返しているかをテスト
     */
    public function testFailGetEvent()
    {
        $response = $this->json('GET', '/api/events/1')->seeStatusCode(404);
        $response->seeJsonEquals([]);
    }

    public function testSuccessStoreEvent()
    {
        $user = factory(App\User::class)->create();

        $event = factory(App\Event::class)->create();
        // ユーザ認証してアクセスする
        $response = $this->actingAs($user)->json('POST', '/api/events',
            ['event' =>
                [
                    'title' => $event->title,
                    'catch_image' => $event->catch_image,
                    'place' => $event->place,
                    'day' => $event->day->format('Y-m-d H:i:s'),
                    'genre' => $event->genre,
                    'tag' => $event->tag,
                    'content' => $event->content,
                ]
            ]
        )->seeStatusCode(200);

        $response->seeJsonEquals([
            'id' => 2,
            'title' => $event->title,
            'catch_image' => $event->catch_image,
            'place' => $event->place,
            'day' => $event->day->format('Y-m-d H:i:s'),
            'genre' => $event->genre,
            'tag' => $event->tag,
            'content' => $event->content,
            'created_at' => $event->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $event->updated_at->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * イベント追加時にユーザ認証されていない場合失敗するかを確認
     */
    public function testFailUserStoreEvent()
    {
        $event = factory(App\Event::class)->create();
        $response = $this->json('POST', '/api/events',
            ['event' =>
                [
                    'title' => $event->title,
                    'catch_image' => $event->catch_image,
                    'place' => $event->place,
                    'day' => $event->day->format('Y-m-d H:i:s'),
                    'genre' => $event->genre,
                    'tag' => $event->tag,
                    'content' => $event->content,
                ]
            ]
        )->seeStatusCode(403);

        $response->seeJsonEquals([]);
    }


    public function testSuccessUpdateEvent()
    {
        // 更新ユーザ
        $user = factory(App\User::class)->create();

        // 事前イベントデータをセットしておく
        $prev_event = factory(App\Event::class)
            ->create();
        $prev_event->save();

        // 更新用イベントデータ
        $update_event = factory(App\Event::class)
            ->create();


        $response = $this->actingAs($user)->json('PATCH', '/api/events/1',
            ['event' =>
                [
                    'title' => $update_event->title,
                    'catch_image' => $update_event->catch_image,
                    'place' => $update_event->place,
                    'day' => $update_event->day->format('Y-m-d H:i:s'),
                    'genre' => $update_event->genre,
                    'tag' => $update_event->tag,
                    'content' => $update_event->content
                ]
            ]
        )->seeStatusCode(200);

        $response->seeJsonEquals([
            'id' => 1,
            'title' => $update_event->title,
            'catch_image' => $update_event->catch_image,
            'place' => $update_event->place,
            'day' => $update_event->day->format('Y-m-d H:i:s'),
            'genre' => $update_event->genre,
            'tag' => $update_event->tag,
            'content' => $update_event->content,
            'created_at' => $update_event->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $update_event->updated_at->format('Y-m-d H:i:s')
        ]);
    }

    public function testSuccessGetEntries()
    {
        $event = factory(App\Event::class)->create();
        $event->save();

        $entries[0] = $event->entries()->save(factory(App\Entry::class)->make());
        $entries[1] = $event->entries()->save(factory(App\Entry::class)->make());

        $response = $this->json('GET','api/events/'.$event->id.'/entries')->seeStatusCode(200);

        $response->seeJsonEquals([
            "entries" => [
                [
                    'id' => $entries[0]->id,
                    "event_id" => $entries[0]->event_id,
                    "event_entry_name" => $entries[0]->event_entry_name,
                    "event_entry_max_num" => $entries[0]->event_entry_max_num,
                    "event_entry_now_num" => $entries[0]->event_entry_now_num
                ],
                [
                    'id' => $entries[1]->id,
                    "event_id" => $entries[1]->event_id,
                    "event_entry_name" => $entries[1]->event_entry_name,
                    "event_entry_max_num" => $entries[1]->event_entry_max_num,
                    "event_entry_now_num" => $entries[1]->event_entry_now_num
                ]
            ]
        ]);
    }

    public function testSuccessStoreEntry()
    {

        $user = factory(App\User::class)->create();
        $user->save();
        $event = factory(App\Event::class)->create();
        $event->save();

        $entry_name = "参加枠";
        $entry_max_num = 10;

        // ユーザ認証してアクセスする
        $response = $this->actingAs($user)->json('POST', '/api/events/'.$event->id.'/entries',
            ['entry' =>
                [
                    'name' => $entry_name,
                    'max_num' => $entry_max_num,
                ]
            ]
        )->seeStatusCode(200);

        $response->seeJsonEquals([
            'entry' =>
                [
                    "id" => 1,
                    "event_id" => $event->id,
                    "event_entry_name" => $entry_name,
                    "event_entry_max_num" => $entry_max_num,
                    "event_entry_now_num" => 0
                ]
        ]);
    }

    public function testSuccessUpdateEntry()
    {
        $user = factory(App\User::class)->create();
        $user->save();
        $event = factory(App\Event::class)->create();
        $event->save();

        $entry = $event->entries()->save(factory(App\Entry::class)->make());

        $entry_name = "参加枠";
        $entry_max_num = 10;

        // ユーザ認証してアクセスする
        $response = $this->actingAs($user)->json('PATCH', '/api/events/'.$event->id.'/entries/'.$entry->id,
            ['entry' =>
                [
                    'name' => $entry_name,
                    'max_num' => $entry_max_num,
                ]
            ]
        )->seeStatusCode(200);

        $response->seeJsonEquals([
            'entry' =>
                [
                    "id" => 1,
                    "event_id" => $event->id,
                    "event_entry_name" => $entry_name,
                    "event_entry_max_num" => $entry_max_num,
                    "event_entry_now_num" => $entry->event_entry_now_num
                ]
        ]);
    }

    public function testSuccessDeleteEntry()
    {
        $user = factory(App\User::class)->create();
        $user->save();
        $event = factory(App\Event::class)->create();
        $event->save();

        $entry = $event->entries()->save(factory(App\Entry::class)->make());
        // ユーザ認証してアクセスする
        $response = $this->actingAs($user)->json('DELETE', '/api/events/'.$event->id.'/entries/'.$entry->id)->seeStatusCode(200);

        $response->seeJsonEquals([]);
    }

    public function testSuccessGetParticipants()
    {
        $users = factory(App\User::class, 2)->create();
        $users->each(function ($user) {
            $user->save();
        });

        $event = factory(App\Event::class)->create();
        $event->save();

        $entry = $event->entries()->save(factory(App\Entry::class)->make());


        $participants[0] = factory(App\Participant::class)->create();
        $participants[1] = factory(App\Participant::class)->create();

        $participants[0]->user_id = $users[0]->id;
        $participants[1]->user_id = $users[1]->id;

        $entry->participants()->save($participants[0]);
        $entry->participants()->save($participants[1]);

        $response = $this->json('GET','api/events/'.$event->id.'/entries/'.$entry->id)->seeStatusCode(200);

        $response->seeJsonEquals([
            "participants" => [
                [
                    'id' => $participants[0]->id,
                    'event_id' => $participants[0]->event_id,
                    'user_id' => $participants[0]->user_id,
                    'entry_id' => $participants[0]->entry_id,
                    'event_evaluate' => $participants[0]->event_evaluate
                ],
                [
                    'id' => $participants[1]->id,
                    'event_id' => $participants[1]->event_id,
                    'user_id' => $participants[1]->user_id,
                    'entry_id' => $participants[1]->entry_id,
                    'event_evaluate' => $participants[1]->event_evaluate
                ]
            ]
        ]);
    }

    public function testSuccessStoreParticipant()
    {
        $user = factory(App\User::class)->create();
        $user->save();

        $event = factory(App\Event::class)->create();
        $event->save();

        $entry = $event->entries()->save(factory(App\Entry::class)->make());

        $response = $this->actingAs($user)->json('POST', 'api/events/'.$event->id.'/entries/'.$entry->id)->seeStatusCode(200);

        $response->seeJsonEquals([
            "participant" => [
                    'id' => 1,
                    'event_id' => $event->id,
                    'user_id' => $user->id,
                    'entry_id' => $entry->id,
                    'event_evaluate' => 0
            ]
        ]);
    }

    public function testSuccessDeleteParticipant()
    {
        $user = factory(App\User::class)->create();
        $user->save();

        $event = factory(App\Event::class)->create();
        $event->save();

        $entry = $event->entries()->save(factory(App\Entry::class)->make());
        $participant = factory(App\Participant::class)->create();
        $participant->user_id = $user->id;

        $entry->participants()->save($participant);

        $response = $this->actingAs($user)
            ->json('DELETE', 'api/events/'.$event->id.'/entries/'.$entry->id.'/participants/'.$participant->user_id)
            ->seeStatusCode(200);

        $response->seeJsonEquals([]);
    }

    public function testSuccessUpdateEvaluate()
    {
        $user = factory(App\User::class)->create();
        $user->save();

        $event = factory(App\Event::class)->create();
        $event->save();

        $entry = $event->entries()->save(factory(App\Entry::class)->make());

        $participant = factory(App\Participant::class)->create();
        $participant->user_id = $user->id;
        $entry->participants()->save($participant);

        $response = $this->actingAs($user)->json('PATCH', 'api/events/'.$event->id.'/entries/'.$entry->id.'/participants/'.$participant->user_id,
            ['evaluate' => 1
            ]
        )->seeStatusCode(200);

        $response->seeJsonEquals([]);
    }
}
