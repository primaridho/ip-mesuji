<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\BerkasKeluar;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBerkasKeluarRequest;
use App\Http\Requests\UpdateBerkasKeluarRequest;
use App\Http\Resources\Admin\BerkasKeluarResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BerkasKeluarApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('berkas_keluar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BerkasKeluarResource(BerkasKeluar::with(['berkasmasuk', 'pemberi_keluar', 'pengukuran', 'isiberkas_keluars'])->get());
    }

    public function store(StoreBerkasKeluarRequest $request)
    {
        $berkasKeluar = BerkasKeluar::create($request->all());
        $berkasKeluar->isiberkas_keluars()->sync($request->input('isiberkas_keluars', []));

        return (new BerkasKeluarResource($berkasKeluar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BerkasKeluar $berkasKeluar)
    {
        abort_if(Gate::denies('berkas_keluar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BerkasKeluarResource($berkasKeluar->load(['berkasmasuk', 'pemberi_keluar', 'pengukuran', 'isiberkas_keluars']));
    }

    public function update(UpdateBerkasKeluarRequest $request, BerkasKeluar $berkasKeluar)
    {
        $berkasKeluar->update($request->all());
        $berkasKeluar->isiberkas_keluars()->sync($request->input('isiberkas_keluars', []));

        return (new BerkasKeluarResource($berkasKeluar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BerkasKeluar $berkasKeluar)
    {
        abort_if(Gate::denies('berkas_keluar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $berkasKeluar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
