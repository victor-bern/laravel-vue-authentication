<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;

class GameController extends Controller
{
    public function updateGame(Request $request, Game $game)
    {
        $game->name = $request->gameName;
        if ($game->save()) {
            return response()->json([
                "sucess" => true
            ]);
        }
        return response()->json([
            "sucess" => false
        ]);
    }
}
