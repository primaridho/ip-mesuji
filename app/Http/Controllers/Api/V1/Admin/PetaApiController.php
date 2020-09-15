<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePetumRequest;
use App\Http\Requests\UpdatePetumRequest;
use App\Http\Resources\Admin\PetumResource;
use App\Petum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PetaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('petum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PetumResource(Petum::with(['id_kecamatan', 'id_desa'])->get());
    }

    public function store(StorePetumRequest $request)
    {
        $petum = Petum::create($request->all());

        if ($request->input('scan_peta', false)) {
            $petum->addMedia(storage_path('tmp/uploads/' . $request->input('scan_peta')))->toMediaCollection('scan_peta');
        }

        return (new PetumResource($petum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Petum $petum)
    {
        abort_if(Gate::denies('petum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PetumResource($petum->load(['id_kecamatan', 'id_desa']));
    }

    public function update(UpdatePetumRequest $request, Petum $petum)
    {
        $petum->update($request->all());

        if ($request->input('scan_peta', false)) {
            if (!$petum->scan_peta || $request->input('scan_peta') !== $petum->scan_peta->file_name) {
                if ($petum->scan_peta) {
                    $petum->scan_peta->delete();
                }

                $petum->addMedia(storage_path('tmp/uploads/' . $request->input('scan_peta')))->toMediaCollection('scan_peta');
            }
        } elseif ($petum->scan_peta) {
            $petum->scan_peta->delete();
        }

        return (new PetumResource($petum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Petum $petum)
    {
        abort_if(Gate::denies('petum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $petum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
