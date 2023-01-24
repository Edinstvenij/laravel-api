<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeskRequest;
use App\Http\Resources\DeskResource;
use App\Models\Desk;
use App\Models\DeskList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class DeskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return DeskResource::collection(Desk::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DeskRequest $request
     * @return DeskResource
     */
    public function store(DeskRequest $request): DeskResource
    {
        return new DeskResource(Desk::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param Desk $desk
     * @return DeskResource
     */
    public function show(Desk $desk): DeskResource
    {
        return new DeskResource($desk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DeskRequest $request
     * @param Desk $desk
     * @return DeskResource
     */
    public function update(DeskRequest $request, Desk $desk): DeskResource
    {
        $desk->update($request->validated());
        return new DeskResource($desk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Desk $desk
     * @return Response
     */
    public function destroy(Desk $desk): Response
    {
        $desk->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
