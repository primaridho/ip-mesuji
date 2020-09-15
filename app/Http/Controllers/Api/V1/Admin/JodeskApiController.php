<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJodeskRequest;
use App\Http\Requests\UpdateJodeskRequest;
use App\Http\Resources\Admin\JodeskResource;
use App\Jodesk;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JodeskApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('jodesk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JodeskResource(Jodesk::with(['petugas'])->get());
    }

    public function store(StoreJodeskRequest $request)
    {
        $jodesk = Jodesk::create($request->all());
        $jodesk->petugas()->sync($request->input('petugas', []));

        return (new JodeskResource($jodesk))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Jodesk $jodesk)
    {
        abort_if(Gate::denies('jodesk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JodeskResource($jodesk->load(['petugas']));
    }

    public function update(UpdateJodeskRequest $request, Jodesk $jodesk)
    {
        $jodesk->update($request->all());
        $jodesk->petugas()->sync($request->input('petugas', []));

        return (new JodeskResource($jodesk))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Jodesk $jodesk)
    {
        abort_if(Gate::denies('jodesk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jodesk->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
