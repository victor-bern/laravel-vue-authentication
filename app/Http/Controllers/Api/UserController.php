<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function addUser(Request $request)
    {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                "Erro" => "Formato de email inválido"
            ]);
        }

        if (User::where("email", "=", $request->email)) {
            return response()->json([
                "Erro" => "Email já existente"
            ]);
        }

        if (strlen($request->password) < 8) {
            return response()->json([
                "Erro" => "Senha precisa ter 8 caracteres ou mais"
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "sucess" => true,
            "token" => $token,
            "user" => $user->id
        ]);
    }
    public function addGames(Request $request)
    {
        $user = User::find($request->user_id);

        $game = new Game();
        $game->name = $request->name;
        $game->finished = $request->finished;

        $game = $user->games()->save($game);

        return response()->json([
            "Sucess" => true,
            "game" => $game
        ]);
    }

    public function getGames(User $user)
    {
        return response()->json([
            "user" => $user->games()->get()
        ]);
    }
}
