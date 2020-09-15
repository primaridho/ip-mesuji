<?php

namespace App\Http\Controllers\Admin;

use App\Desa;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySuratUkurRequest;
use App\Http\Requests\StoreSuratUkurRequest;
use App\Http\Requests\UpdateSuratUkurRequest;
use App\Kecamatan;
use App\SuratUkur;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SuratUkurController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('surat_ukur_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SuratUkur::with(['id_kecamatan', 'id_desa'])->select(sprintf('%s.*', (new SuratUkur)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'surat_ukur_show';
                $editGate      = 'surat_ukur_edit';
                $deleteGate    = 'surat_ukur_delete';
                $crudRoutePart = 'surat-ukurs';

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

            $table->editColumn('no_su', function ($row) {
                return $row->no_su ? $row->no_su : "";
            });

            $table->editColumn('gambar', function ($row) {
                if ($photo = $row->gambar) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'id_kecamatan', 'id_desa', 'gambar']);

            return $table->make(true);
        }

        $kecamatans = Kecamatan::get();
        $desas      = Desa::get();

        return view('admin.suratUkurs.index', compact('kecamatans', 'desas'));
    }

    public function create()
    {
        abort_if(Gate::denies('surat_ukur_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_kecamatans = Kecamatan::all()->pluck('nama_kecamatan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_desas = Desa::all()->pluck('nama_desa', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.suratUkurs.create', compact('id_kecamatans', 'id_desas'));
    }

    public function store(StoreSuratUkurRequest $request)
    {
        $suratUkur = SuratUkur::create($request->all());

        if ($request->input('gambar', false)) {
            $suratUkur->addMedia(storage_path('tmp/uploads/' . $request->input('gambar')))->toMediaCollection('gambar');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $suratUkur->id]);
        }

        return redirect()->route('admin.surat-ukurs.index');
    }

    public function edit(SuratUkur $suratUkur)
    {
        abort_if(Gate::denies('surat_ukur_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_kecamatans = Kecamatan::all()->pluck('nama_kecamatan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_desas = Desa::all()->pluck('nama_desa', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suratUkur->load('id_kecamatan', 'id_desa');

        return view('admin.suratUkurs.edit', compact('id_kecamatans', 'id_desas', 'suratUkur'));
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

        return redirect()->route('admin.surat-ukurs.index');
    }

    public function show(SuratUkur $suratUkur)
    {
        abort_if(Gate::denies('surat_ukur_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suratUkur->load('id_kecamatan', 'id_desa');

        return view('admin.suratUkurs.show', compact('suratUkur'));
    }

    public function destroy(SuratUkur $suratUkur)
    {
        abort_if(Gate::denies('surat_ukur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suratUkur->delete();

        return back();
    }

    public function massDestroy(MassDestroySuratUkurRequest $request)
    {
        SuratUkur::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('surat_ukur_create') && Gate::denies('surat_ukur_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SuratUkur();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
