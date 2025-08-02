<?php

namespace Modules\BackOffice\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\BackOffice\Entities\UserTmModel;
use Illuminate\Support\Facades\Hash;
use Modules\BackOffice\Entities\UserTypeModels;

class UserTmControllers extends Controller
{
    use \App\Traits\ApiResponseTrait;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users = UserTmModel::with(['userType'])->orderBy('id', 'desc')->get();
        return $this->successResponse($users,"User list retrieved successfully. ");
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:userTm,email',
            'password' => 'required|min:6',
            'user_type_id' => 'required|exists:userType,id',
            'phone_number' => 'required|unique:userTm,phone_number',
        ]);

        // Hasher le mot de passe
        $validated['password'] = Hash::make($validated['password']);

        $user = userTmModel::create($validated);

        // Générer le token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully.',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $user = UserTmModel::find($id);
        if (!$user) {
            return $this->notFoundResponse();
        }
        return $this->successResponse($user);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = UserTmModel::find($id);
        if (!$user) {
            return $this->notFoundResponse();
        }
        $user->update($request->all());
        return $this->successResponse($user);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = UserTmModel::find($id);
        if (!$user) {
            return $this->notFoundResponse();
        }
        $user->delete();
        return $this->deletedResponse();
    }
}
