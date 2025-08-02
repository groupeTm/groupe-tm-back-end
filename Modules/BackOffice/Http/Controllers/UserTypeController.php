<?php

namespace Modules\BackOffice\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\BackOffice\Entities\UserTypeModels;

class UserTypeController extends Controller
{
    use \App\Traits\ApiResponseTrait;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //
        // This method should return a list of user types
        $userTypes = UserTypeModels::all();
        return $this->successResponse($userTypes);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $userType = UserTypeModels::create($request->all());
        return $this->createdResponse($userType);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $userType = UserTypeModels::find($id);
        if (!$userType) {
            return $this->notFoundResponse();
        }
        return $this->successResponse($userType);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $userType = UserTypeModels::find($id);
        if (!$userType) {
            return $this->notFoundResponse();
        }
        $userType->update($request->all());
        return $this->successResponse($userType);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $userType = UserTypeModels::find($id);
        if (!$userType) {
            return $this->notFoundResponse();
        }
        $userType->delete();
        return $this->deletedResponse();
    }
}
