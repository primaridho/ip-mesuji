<?php

namespace App\Http\Controllers\Admin;

use App\Desa;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPetumRequest;
use App\Http\Requests\StorePetumRequest;
use App\Http\Requests\UpdatePetumRequest;
use App\Kecamatan;
use App\Petum;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PetaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('petum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Petum::with(['id_kecamatan', 'id_desa'])->select(sprintf('%s.*', (new Petum)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'petum_show';
                $editGate      = 'petum_edit';
                $deleteGate    = 'petum_delete';
                $crudRoutePart = 'peta';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('id_kecamatan_nama_kecamatan', function ($row) {
                return $row->id_kecamatan ? $row->id_kecamatan->nama_kecamatan : '';
            });

            $table->addColumn('id_desa_nama_desa', function ($row) {
                return $row->id_desa ? $row->id_desa->nama_desa : '';
            });

            $table->editColumn('no_peta', function ($row) {
                return $row->no_peta ? $row->no_peta : "";
            });
            $table->editColumn('no_lembar', function ($row) {
                return $row->no_lembar ? $row->no_lembar : "";
            });

            $table->editColumn('status_peta', function ($row) {
                return $row->status_peta ? Petum::STATUS_PETA_SELECT[$row->status_peta] : '';
            });
            $table->editColumn('scan_peta', function ($row) {
                if (!$row->scan_peta) {
                    return '';
                }

                $links = [];

                foreach ($row->scan_peta as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'id_kecamatan', 'id_desa', 'scan_peta']);

            return $table->make(true);
        }

        $kecamatans = Kecamatan::get();
        $desas      = Desa::get();

        return view('admin.peta.index', compact('kecamatans', 'desas'));
    }

    public function create()
    {
        abort_if(Gate::denies('petum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_kecamatans = Kecamatan::all()->pluck('nama_kecamatan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_desas = Desa::all()->pluck('nama_desa', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.peta.create', compact('id_kecamatans', 'id_desas'));
    }

    public function store(StorePetumRequest $request)
    {
        $petum = Petum::create($request->all());

        foreach ($request->input('scan_peta', []) as $file) {
            $petum->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('scan_peta');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $petum->id]);
        }

        return redirect()->route('admin.peta.index');
    }

    public function edit(Petum $petum)
    {
        abort_if(Gate::denies('petum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_kecamatans = Kecamatan::all()->pluck('nama_kecamatan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_desas = Desa::all()->pluck('nama_desa', 'id')->prepend(trans('global.pleaseSelect'), '');

        $petum->load('id_kecamatan', 'id_desa');

        return view('admin.peta.edit', compact('id_kecamatans', 'id_desas', 'petum'));
    }

    public function update(UpdatePetumRequest $request, Petum $petum)
    {
        $petum->update($request->all());

        if (count($petum->scan_peta) > 0) {
            foreach ($petum->scan_peta as $media) {
                if (!in_array($media->file_name, $request->input('scan_peta', []))) {
                    $media->delete();
                }
            }
        }

        $media = $petum->scan_peta->pluck('file_name')->toArray();

        foreach ($request->input('scan_peta', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $petum->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('scan_peta');
            }
        }

        return redirect()->route('admin.peta.index');
    }

    public function show(Petum $petum)
    {
        abort_if(Gate::denies('petum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $petum->load('id_kecamatan', 'id_desa');

        return view('admin.peta.show', compact('petum'));
    }

    public function destroy(Petum $petum)
    {
        abort_if(Gate::denies('petum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $petum->delete();

        return back();
    }

    public function massDestroy(MassDestroyPetumRequest $request)
    {
        Petum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('petum_create') && Gate::denies('petum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Petum();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
