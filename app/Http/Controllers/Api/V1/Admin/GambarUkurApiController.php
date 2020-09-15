<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\GambarUkur;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreGambarUkurRequest;
use App\Http\Requests\UpdateGambarUkurRequest;
use App\Http\Resources\Admin\GambarUkurResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GambarUkurApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('gambar_ukur_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GambarUkurResource(GambarUkur::with(['id_pengukuran', 'id_kecamatan', 'id_desa'])->get());
    }

    public function store(StoreGambarUkurRequest $request)
    {
        $gambarUkur = GambarUkur::create($request->all());

        if ($request->input('scan_gu', false)) {
            $gambarUkur->addMedia(storage_path('tmp/uploads/' . $request->input('scan_gu')))->toMediaCollection('scan_gu');
        }

        return (new GambarUkurResource($gambarUkur))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(GambarUkur $gambarUkur)
    {
        abort_if(Gate::denies('gambar_ukur_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GambarUkurResource($gambarUkur->load(['id_pengukuran', 'id_kecamatan', 'id_desa']));
    }

    public function update(UpdateGambarUkurRequest $request, GambarUkur $gambarUkur)
    {
        $gambarUkur->update($request->all());

        if ($request->input('scan_gu', false)) {
            if (!$gambarUkur->scan_gu || $request->input('scan_gu') !== $gambarUkur->scan_gu->file_name) {
                if ($gambarUkur->scan_gu) {
                    $gambarUkur->scan_gu->delete();
                }

                $gambarUkur->addMedia(storage_path('tmp/uploads/' . $request->input('scan_gu')))->toMediaCollection('scan_gu');
            }
        } elseif ($gambarUkur->scan_gu) {
            $gambarUkur->scan_gu->delete();
        }

        return (new GambarUkurResource($gambarUkur))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(GambarUkur $gambarUkur)
    {
        abort_if(Gate::denies('gambar_ukur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gambarUkur->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
