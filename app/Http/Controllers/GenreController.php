<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Genre;
class GenreController extends Controller
{
    //
    /**
     * イベントの一覧を取得
     *
     * @return Response
     */
    public function getGenres() {
        $genre = Genre::all();
        return response()->json($genre, 200);
    }
}
