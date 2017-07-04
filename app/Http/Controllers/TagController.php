<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Tag;



class TagController extends Controller
{
    //
    /**
     * [GET] /tag
     * タグを取得
     * @param { string } Prefix 文字の先頭
     * @param { int } number　必要個数
     * @return { json } genre　タグの一覧を返す
     */
    public function getTags(Request $request){
        // リクエストデータ取得
        $prefix = $request->input('Prefix');
        $number = $request->input('number');
        // 変数初期化
        $cnt = 0;
        $tag = array();
        // 要求個数１０個以上は処理しない
        if ($number>=10) {
            return response()->json("err", 400);
        }

        // 検索
        $data = Tag::where('tag', 'LIKE', "$prefix%")->get();
        $cnt += $this->appendData($data,$tag);
        if($cnt<=$number){
            $data = Tag::where('tag', 'LIKE', "%$prefix%")->get();
            $cnt += $this->appendData($data,$tag);
        }

        if($cnt<=$number){
            $data = Tag::where('spell1', 'LIKE', "$prefix%")->get();
            $cnt += $this->appendData($data,$tag);
        }

        if($cnt<=$number){
            $data = Tag::where('spell1', 'LIKE', "%$prefix%")->get();
            $cnt += $this->appendData($data,$tag);
        }

        if($cnt<=$number){
            $data = Tag::where('spell2', 'LIKE', "$prefix%")->get();
            $cnt += $this->appendData($data,$tag);
        }

        if($cnt<=$number){
            $data = Tag::where('spell2', 'LIKE', "%$prefix%")->get();
            $cnt += $this->appendData($data,$tag);
        }

        if($cnt<=$number){
            $data = Tag::where('spell3', 'LIKE', "$prefix%")->get();
            $cnt += $this->appendData($data,$tag);
        }

        if($cnt<=$number){
            $data = Tag::where('spell3', 'LIKE', "%$prefix%")->get();
            $cnt += $this->appendData($data,$tag);
        }

        // 結果をscore順にソート
        foreach ((array) $tag as $key => $value) {
            $sort[$key] = $value['score'];
        }
        array_multisort($sort, SORT_DESC, $tag);
        // 要求個数以上切り取り

        array_splice($tag,$number);
        // レスポンス
        return response()->json($tag, 200);
    }
    // 配列の末尾にデータを追加する
    private function appendData($data,&$tag){
        $cnt = 0;
        foreach($data as $key => $val){
            if ($this->dupCheck($val['id'],$tag)) {
                array_push($tag, array('id' => $val['id'], 'tag' => $val['tag'], 'score'=>$val['Score']));
            }
            $cnt++;
        }
        return $cnt;
    }
    // 重複をチェックする関数
    private function dupCheck($id,$tag){
        $flg = true;
        foreach ($tag as $key => $value) {
            if ($value['id'] == $id) {
                $flg = false;
            }
        }
        return $flg;
    }
}
