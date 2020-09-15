<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIsiBerkaRequest;
use App\Http\Requests\UpdateIsiBerkaRequest;
use App\Http\Resources\Admin\IsiBerkaResource;
use App\IsiBerka;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsiBerkasApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('isi_berka_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IsiBerkaResource(IsiBerka::all());
    }

    public function store(StoreIsiBerkaRequest $request)
    {
        $isiBerka = IsiBerka::create($request->all());

        return (new IsiBerkaResource($isiBerka))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IsiBerka $isiBerka)
    {
        abort_if(Gate::denies('isi_berka_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IsiBerkaResource($isiBerka);
    }

    public function update(UpdateIsiBerkaRequest $request, IsiBerka $isiBerka)
    {
        $isiBerka->update($request->all());

        return (new IsiBerkaResource($isiBerka))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IsiBerka $isiBerka)
    {
        abort_if(Gate::denies('isi_berka_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $isiBerka->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
