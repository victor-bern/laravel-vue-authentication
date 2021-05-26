<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addUser(Request $request)
    {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                "Erro" => "Formato de email inválido"
            ]);

        }

        if(strlen($request->password) < 8){
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
            "Sucesso" => true,
            "token" => $token
        ]);
    }

}
