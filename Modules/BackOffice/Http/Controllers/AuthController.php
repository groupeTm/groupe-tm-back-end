<?php

namespace Modules\BackOffice\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\BackOffice\Entities\userTmModel;
use App\Traits\ApiResponseTrait;

class AuthController extends Controller
{
    use ApiResponseTrait;

    /**
     * Authentification de l'utilisateur
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // ✅ Validation des champs
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // 🔍 Récupération de l'utilisateur
        $utilisateur = userTmModel::where('email', $credentials['email'])->first();

        // ❌ Vérification de l'utilisateur et du mot de passe
        if (!$utilisateur || !Hash::check($credentials['password'], $utilisateur->password)) {
            return $this->validationErrorResponse([
                'email' => ['Les informations d’identification sont incorrectes.']
            ]);
        }

        // ✅ Création du token
        $token = $utilisateur->createToken('auth_token')->plainTextToken;

        return $this->successResponse([
            'user' => $utilisateur,
            'token' => $token
        ], 'Authentification réussie');
    }

    /**
     * Déconnexion (révocation du token)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse(null, 'Déconnexion réussie');
    }
}
