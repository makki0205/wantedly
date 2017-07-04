<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserDetail\PutUserDetailRequest;
use App\Http\Requests\UserDetail\PostImageRequest;
use Intervention\Image\Facades\Image;
use \App\UserDetail;
use \App\Region;
use \App\AspiringIndustry;
use \App\Topic;
use \App\UserDetailCareerHistory;
use \App\UserDetailAward;
use Storage;
use \App\Service\UserDetailService;
use \App\Service\AuthService;
use \App\Service\WaveScoreService;

class UserDetailController extends Controller
{

    use \App\Http\Json\UserDetailJson;
    private $User_detail_Service = null;
    private $auth = null;
    private $wave_score = null;
    public function __construct(UserDetailService $User_detail_Service, AuthService $auth, WaveScoreService $wave_score)
    {
        $this->User_detail_Service = $User_detail_Service;
        $this->auth = $auth;
        $this->wave_score = $wave_score;
    }

    public function getTopicAndAspiringIndustry()
    {
        $topic = $this->User_detail_Service->getTopicAll();
        $aspiringIndustry = $this->User_detail_Service->getAspiringIndustryAll();

        return response()->json($this->TopicAndAspiringIndustry($topic, $aspiringIndustry), 200);

    }

    /**
     * [GET] /user/detail
     * ユーザ詳細情報の取得
     * @param {int} user_id ユーザのID
     * @return { json } UserDetail ユーザ詳細情報
     */
    public function getUserDetail($nickname)
    {
        // リクエストパラメータの取得
        $user_detail_data = UserDetail::where('nickname', $nickname)->first();
        if (!$user_detail_data) {
            return response()->json(['nickname' => ["nickname is not found"]], 400);
        }

        $award_data = $user_detail_data->award;
        $career_history_date = $user_detail_data->careerHistory;
        $region = Region::where('id', intval($user_detail_data['address']))->first();
        $aspiring_industry_date = AspiringIndustry::get();
        $topic_date = Topic::get();

        //値の処理
        $aspiring_industrie_ids = explode(',', $user_detail_data['aspiring_industrie_id']);
        $topics_ids = explode(',', $user_detail_data['topics_id']);

        $aspiring_industrie = [];
        $topic = [];

        foreach ($aspiring_industrie_ids as $key => $value) {
            $value = intval($value);
            foreach ($aspiring_industry_date as $db_value) {
                if ($db_value['id'] === $value) {
                    $aspiring_industrie[$key] = ['id' => $db_value['id'], 'aspiring_industry' => $db_value['aspiring_industry']];
                }
            }
        }
        foreach ($topics_ids as $key => $value) {
            $value = intval($value);
            foreach ($topic_date as $db_value) {
                if($db_value['id'] === $value){
                    $topic[$key] = ['id' => $db_value['id'], 'topic' => $db_value['topic']];
                }
            }
        }
        //レスポンスデータ生成
        $returnDate['nickname'] = $user_detail_data['nickname'];
        $returnDate['display_name'] = $user_detail_data['display_name'];
        $returnDate['sex'] = $user_detail_data['sex'];
        $returnDate['cover_image'] = $user_detail_data['cover_image'];
        $returnDate['icon'] = $user_detail_data['icon'];
        $returnDate['description'] = $user_detail_data['description'];
        $returnDate['introduction'] = $user_detail_data['introduction'];
        $returnDate['school_name'] = $user_detail_data['school_name'];
        $returnDate['undergraduate'] = $user_detail_data['undergraduate'];
        $returnDate['graduate'] = $user_detail_data['graduate'];
        $returnDate['address'] = $region;
        $returnDate['facebook'] = $user_detail_data['facebook'];
        $returnDate['twitter'] = $user_detail_data['twitter'];
        $returnDate['number_participate'] = $user_detail_data['number_participate'];
        $returnDate['number_build'] = $user_detail_data['number_build'];
        $returnDate['career_history'] = $career_history_date;
        $returnDate['aspiring_industries'] = $aspiring_industrie;
        $returnDate['award'] = $award_data;
        $returnDate['topic'] = $topic;
        $returnDate['wave_point'] = $user_detail_data['wave_point'];

        return response()->json(['user_id' => intval($user_detail_data['id']), 'user_detail' => $returnDate], 200);
    }

    /**
     * [PUT] /user/detail
     * UserDetailの変更
     * @param {int} user_id ユーザのID
     * @param { json } UserDetail ユーザ詳細情報
     */
    public function putUserDetail(PutUserDetailRequest $request)
    {
        // TODO　トークンチェック
        $user_id = $request->input('user_id');
        if ($this->auth->getLoginUser()->id != $user_id) {
            return response()->json($this->unauthorized(), 401);
        }
        // UserDetailDBを更新する
        $user_detail = UserDetail::where('user_id', $user_id)->first();

        if (!$this->updateUserDetail($request, $user_detail)) {
            return response()->json([], 404);
        }
        // 職歴DBを更新
        if (!$hoge = $this->updateCareerHistory($request, $user_detail)) {
            return response()->json([], 404);
        }
        // 受賞歴DBを更新
        if (!$hoge = $this->updateAward($request, $user_detail)) {
            return response()->json([], 404);
        }
        $this->wave_score->update($user_id);
        // ステータスコード200返す
        return response()->json([], 200);
    }

    private function updateUserDetail($req, $user_detail)
    {

        $user_id = $req->input('user_id');
        $data = $req->input('user_detail');

        $data['aspiring_industries'] = "";
        foreach ($req->input('user_detail.aspiring_industries') as $key => $value) {
            $data['aspiring_industries'] = $data['aspiring_industries'] . $value['id'] . ",";
        }
        $data['aspiring_industries'] = substr($data['aspiring_industries'], 0, -1);
        $data['topic'] = "";
        foreach ($req->input('user_detail.topic') as $key => $value) {
            $data['topic'] = $data['topic'] . $value['id'] . ",";
        }
        $data['topic'] = substr($data['topic'], 0, -1);
        $user_detail->nickname = $data['nickname'];
        $user_detail->display_name = $data['display_name'];
        $user_detail->sex = $data['sex'];
        $user_detail->description = $data['description'];
        $user_detail->introduction = $data['introduction'];
        $user_detail->school_name = $data['school_name'];
        $user_detail->undergraduate = $data['undergraduate'];
        $user_detail->graduate = $data['graduate'];
        $user_detail->address = $data['address']['id'];
        $user_detail->aspiring_industrie_id = $data['aspiring_industries'];
        $user_detail->topics_id = $data['topic'];
        $result = $user_detail->save();

        return $result;
    }

    private function updateCareerHistory($req, $user_detail)
    {
        $user_id = $req->input('user_id');
        $career_history = $req->input('user_detail.career_history');
        $userDetailCareerHistory = $user_detail->careerHistory()->get();

        $result = 1;
        foreach ($career_history as $key => $value) {
            if ($value['id'] == 0) {
                UserDetailCareerHistory::create([
                    'title' => $value['title'],
                    'user_id' => $user_id,
                    'Contents' => $value['Contents'],
                    'start_time' => $value['start_time'],
                    'end_time' => $value['end_time']
                ]);
            }
        }
        foreach ($userDetailCareerHistory as $db_value) {
            if ($db_value['user_id'] !== $user_id) {
                break;
            }
            $flg = true;
            foreach ($career_history as $value) {
                if ($db_value['id'] == $value['id']) {
                    $db_value->title = $value['title'];
                    $db_value->Contents = $value['Contents'];
                    $db_value->start_time = $value['start_time'];
                    $db_value->end_time = $value['end_time'];
                    $db_value->save();
                    $flg = false;
                }
            }
            if ($flg) {
                $db_value->delete();
            }
        }
        return $result;
    }

    // UserDetailDBを更新

    private function updateAward($req, $user_detail)
    {
        $user_id = $req->input('user_id');
        $award = $req->input('user_detail.award');
        $userDetailAward = $user_detail->award()->get();

        $result = 1;
        foreach ($award as $key => $value) {
            if ($value['id'] == 0) {
                UserDetailAward::create([
                    'award' => $value['award'],
                    'user_id' => $user_id,
                    'date' => $value['date']
                ]);
            }
        }
        foreach ($userDetailAward as $db_value) {
            if ($db_value['user_id'] !== $user_id) {
                break;
            }
            $flg = true;
            foreach ($award as $value) {
                if ($db_value['id'] == $value['id']) {
                    $db_value->award = $value['award'];
                    $db_value->date = $value['date'];
                    $db_value->save();
                    $flg = false;
                }
            }
            if ($flg) {
                $db_value->delete();
            }
        }
        return $result;
    }

    // 職歴DBを更新

    /**
     * [PUT] /users/icon
     * iconの変更
     * @param {int} user_id ユーザのID
     * @param { file } アイコン画像
     */
    public function updateIcon(PostImageRequest $request)
    {
        // TODO　トークンチェック
        $user_id = $request->input('user_id');
        if ($this->auth->getLoginUser()->id != $user_id) {
            return response()->json($this->unauthorized(), 401);
        }
        //リクエスト処理
        $file = $request->file('image');
        $user_detail = UserDetail::where('user_id', $user_id)->first();
        $file_name = $user_detail->icon;

        if ($file_name == "defaulticon.png") {
            //ランダムな数値がかぶらないようにする。
            while (true) {
                $file_name = str_random(40) . ".jpg";
                $check = UserDetail::where('icon', $file_name)->first();
                if ($check == null) {
                    break;
                }
            }
        }
        //イメージの加工及び保存
        $small_icon = Image::make($file->getRealPath())
            ->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

        $large_icon = Image::make($file->getRealPath())
            ->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

        // S3にファイルアップロード
        $small_icon = (string)$small_icon->encode();
        $large_icon = (string)$large_icon->encode();
        $disk = Storage::disk('s3');
        $disk->put("/media/small_icon/" . $file_name, $small_icon, 'public');
        $disk->put("/media/large_icon/" . $file_name, $large_icon, 'public');

        // DB書き換え
        $user_detail->icon = $file_name;
        $user_detail->save();

        return response()->json(["path" => $file_name], 200);
    }

    // 受賞歴DBを更新

    /**
     * [PUT] /users/cover_image
     * cover_imageの変更
     * @param {int} user_id ユーザのID
     * @param { file } Cover画像
     */
    public function updateCoverImage(PostImageRequest $request)
    {
        // TODO　トークンチェック
        $user_id = $request->input('user_id');
        if ($this->auth->getLoginUser()->id != $user_id) {
            return response()->json($this->unauthorized(), 401);
        }
        //リクエスト処理
        $file = $request->file('image');
        $user_detail = UserDetail::where('user_id', $user_id)->first();
        $file_name = $user_detail->cover_image;

        //ランダムな数値がかぶらないようにする。
        if ($file_name == "defaultcover.png") {
            //ランダムな数値がかぶらないようにする。
            while (true) {
                $file_name = str_random(40) . ".jpg";
                $check = UserDetail::where('icon', $file_name)->first();
                if ($check == null) {
                    break;
                }
            }
        }

        $cover = Image::make($file->getRealPath())
            ->resize(1500, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

        // S3にファイルアップロード
        $cover = (string)$cover->encode();
        $disk = Storage::disk('s3');
        $disk->put("/media/cover/" . $file_name, $cover, 'public');

        // DB書き換え
        $user_detail->cover_image = $file_name;
        $user_detail->save();

        return response()->json(["path" => $file_name], 200);
    }
}
