<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePengukuranRequest;
use App\Http\Requests\UpdatePengukuranRequest;
use App\Http\Resources\Admin\PengukuranResource;
use App\Pengukuran;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PengukuranApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pengukuran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PengukuranResource(Pengukuran::with(['id_berkas', 'pembantu_ukurs', 'desa', 'kecamatan'])->get());
    }

    public function store(StorePengukuranRequest $request)
    {
        $pengukuran = Pengukuran::create($request->all());
        $pengukuran->pembantu_ukurs()->sync($request->input('pembantu_ukurs', []));

        if ($request->input('file_dwg', false)) {
            $pengukuran->addMedia(storage_path('tmp/uploads/' . $request->input('file_dwg')))->toMediaCollection('file_dwg');
        }

        return (new PengukuranResource($pengukuran))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pengukuran $pengukuran)
    {
        abort_if(Gate::denies('pengukuran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PengukuranResource($pengukuran->load(['id_berkas', 'pembantu_ukurs', 'desa', 'kecamatan']));
    }

    public function update(UpdatePengukuranRequest $request, Pengukuran $pengukuran)
    {
        $pengukuran->update($request->all());
        $pengukuran->pembantu_ukurs()->sync($request->input('pembantu_ukurs', []));

        if ($request->input('file_dwg', false)) {
            if (!$pengukuran->file_dwg || $request->input('file_dwg') !== $pengukuran->file_dwg->file_name) {
                if ($pengukuran->file_dwg) {
                    $pengukuran->file_dwg->delete();
                }

                $pengukuran->addMedia(storage_path('tmp/uploads/' . $request->input('file_dwg')))->toMediaCollection('file_dwg');
            }
        } elseif ($pengukuran->file_dwg) {
            $pengukuran->file_dwg->delete();
        }

        return (new PengukuranResource($pengukuran))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pengukuran $pengukuran)
    {
        abort_if(Gate::denies('pengukuran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengukuran->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
