<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\BerkasMasuk;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBerkasMasukRequest;
use App\Http\Requests\UpdateBerkasMasukRequest;
use App\Http\Resources\Admin\BerkasMasukResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BerkasMasukApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('berkas_masuk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BerkasMasukResource(BerkasMasuk::with(['penerima_masuk', 'desa', 'kecamatan', 'isiberkas'])->get());
    }

    public function store(StoreBerkasMasukRequest $request)
    {
        $berkasMasuk = BerkasMasuk::create($request->all());
        $berkasMasuk->isiberkas()->sync($request->input('isiberkas', []));

        if ($request->input('gambar_berkas', false)) {
            $berkasMasuk->addMedia(storage_path('tmp/uploads/' . $request->input('gambar_berkas')))->toMediaCollection('gambar_berkas');
        }

        return (new BerkasMasukResource($berkasMasuk))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BerkasMasuk $berkasMasuk)
    {
        abort_if(Gate::denies('berkas_masuk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BerkasMasukResource($berkasMasuk->load(['penerima_masuk', 'desa', 'kecamatan', 'isiberkas']));
    }

    public function update(UpdateBerkasMasukRequest $request, BerkasMasuk $berkasMasuk)
    {
        $berkasMasuk->update($request->all());
        $berkasMasuk->isiberkas()->sync($request->input('isiberkas', []));

        if ($request->input('gambar_berkas', false)) {
            if (!$berkasMasuk->gambar_berkas || $request->input('gambar_berkas') !== $berkasMasuk->gambar_berkas->file_name) {
                if ($berkasMasuk->gambar_berkas) {
                    $berkasMasuk->gambar_berkas->delete();
                }

                $berkasMasuk->addMedia(storage_path('tmp/uploads/' . $request->input('gambar_berkas')))->toMediaCollection('gambar_berkas');
            }
        } elseif ($berkasMasuk->gambar_berkas) {
            $berkasMasuk->gambar_berkas->delete();
        }

        return (new BerkasMasukResource($berkasMasuk))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BerkasMasuk $berkasMasuk)
    {
        abort_if(Gate::denies('berkas_masuk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $berkasMasuk->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
