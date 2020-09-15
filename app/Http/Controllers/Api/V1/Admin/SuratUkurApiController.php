<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSuratUkurRequest;
use App\Http\Requests\UpdateSuratUkurRequest;
use App\Http\Resources\Admin\SuratUkurResource;
use App\SuratUkur;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuratUkurApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('surat_ukur_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuratUkurResource(SuratUkur::with(['id_kecamatan', 'id_desa'])->get());
    }

    public function store(StoreSuratUkurRequest $request)
    {
        $suratUkur = SuratUkur::create($request->all());

        if ($request->input('gambar', false)) {
            $suratUkur->addMedia(storage_path('tmp/uploads/' . $request->input('gambar')))->toMediaCollection('gambar');
        }

        return (new SuratUkurResource($suratUkur))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SuratUkur $suratUkur)
    {
        abort_if(Gate::denies('surat_ukur_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuratUkurResource($suratUkur->load(['id_kecamatan', 'id_desa']));
    }

    public function update(UpdateSuratUkurRequest $request, SuratUkur $suratUkur)
    {
        $suratUkur->update($request->all());

        if ($request->input('gambar', false)) {
            if (!$suratUkur->gambar || $request->input('gambar') !== $suratUkur->gambar->file_name) {
                if ($suratUkur->gambar) {
                    $suratUkur->gambar->delete();
                }

                $suratUkur->addMedia(storage_path('tmp/uploads/' . $request->input('gambar')))->toMediaCollection('gambar');
            }
        } elseif ($suratUkur->gambar) {
            $suratUkur->gambar->delete();
        }

        return (new SuratUkurResource($suratUkur))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SuratUkur $suratUkur)
    {
        abort_if(Gate::denies('surat_ukur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suratUkur->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
