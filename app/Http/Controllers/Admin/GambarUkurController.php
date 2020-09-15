<?php

namespace App\Http\Controllers\Admin;

use App\Desa;
use App\GambarUkur;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGambarUkurRequest;
use App\Http\Requests\StoreGambarUkurRequest;
use App\Http\Requests\UpdateGambarUkurRequest;
use App\Kecamatan;
use App\Pengukuran;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GambarUkurController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('gambar_ukur_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GambarUkur::with(['id_pengukuran', 'id_kecamatan', 'id_desa'])->select(sprintf('%s.*', (new GambarUkur)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'gambar_ukur_show';
                $editGate      = 'gambar_ukur_edit';
                $deleteGate    = 'gambar_ukur_delete';
                $crudRoutePart = 'gambar-ukurs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('id_pengukuran_no_gu', function ($row) {
                return $row->id_pengukuran ? $row->id_pengukuran->no_gu : '';
            });

            $table->editColumn('id_pengukuran.tanggal_pengukuran', function ($row) {
                return $row->id_pengukuran ? (is_string($row->id_pengukuran) ? $row->id_pengukuran : $row->id_pengukuran->tanggal_pengukuran) : '';
            });
            $table->addColumn('id_kecamatan_nama_kecamatan', function ($row) {
                return $row->id_kecamatan ? $row->id_kecamatan->nama_kecamatan : '';
            });

            $table->addColumn('id_desa_nama_desa', function ($row) {
                return $row->id_desa ? $row->id_desa->nama_desa : '';
            });

            $table->editColumn('id_desa.kode_desa', function ($row) {
                return $row->id_desa ? (is_string($row->id_desa) ? $row->id_desa : $row->id_desa->kode_desa) : '';
            });
            $table->editColumn('scan_gu', function ($row) {
                if (!$row->scan_gu) {
                    return '';
                }

                $links = [];

                foreach ($row->scan_gu as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'id_pengukuran', 'id_kecamatan', 'id_desa', 'scan_gu']);

            return $table->make(true);
        }

        $pengukurans = Pengukuran::get();
        $kecamatans  = Kecamatan::get();
        $desas       = Desa::get();

        return view('admin.gambarUkurs.index', compact('pengukurans', 'kecamatans', 'desas'));
    }

    public function create()
    {
        abort_if(Gate::denies('gambar_ukur_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_pengukurans = Pengukuran::all()->pluck('no_gu', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_kecamatans = Kecamatan::all()->pluck('nama_kecamatan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_desas = Desa::all()->pluck('nama_desa', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.gambarUkurs.create', compact('id_pengukurans', 'id_kecamatans', 'id_desas'));
    }

    public function store(StoreGambarUkurRequest $request)
    {
        $gambarUkur = GambarUkur::create($request->all());

        foreach ($request->input('scan_gu', []) as $file) {
            $gambarUkur->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('scan_gu');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $gambarUkur->id]);
        }

        return redirect()->route('admin.gambar-ukurs.index');
    }

    public function edit(GambarUkur $gambarUkur)
    {
        abort_if(Gate::denies('gambar_ukur_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_pengukurans = Pengukuran::all()->pluck('no_gu', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_kecamatans = Kecamatan::all()->pluck('nama_kecamatan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_desas = Desa::all()->pluck('nama_desa', 'id')->prepend(trans('global.pleaseSelect'), '');

        $gambarUkur->load('id_pengukuran', 'id_kecamatan', 'id_desa');

        return view('admin.gambarUkurs.edit', compact('id_pengukurans', 'id_kecamatans', 'id_desas', 'gambarUkur'));
    }

    public function update(UpdateGambarUkurRequest $request, GambarUkur $gambarUkur)
    {
        $gambarUkur->update($request->all());

        if (count($gambarUkur->scan_gu) > 0) {
            foreach ($gambarUkur->scan_gu as $media) {
                if (!in_array($media->file_name, $request->input('scan_gu', []))) {
                    $media->delete();
                }
            }
        }

        $media = $gambarUkur->scan_gu->pluck('file_name')->toArray();

        foreach ($request->input('scan_gu', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $gambarUkur->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('scan_gu');
            }
        }

        return redirect()->route('admin.gambar-ukurs.index');
    }

    public function show(GambarUkur $gambarUkur)
    {
        abort_if(Gate::denies('gambar_ukur_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gambarUkur->load('id_pengukuran', 'id_kecamatan', 'id_desa');

        return view('admin.gambarUkurs.show', compact('gambarUkur'));
    }

    public function destroy(GambarUkur $gambarUkur)
    {
        abort_if(Gate::denies('gambar_ukur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gambarUkur->delete();

        return back();
    }

    public function massDestroy(MassDestroyGambarUkurRequest $request)
    {
        GambarUkur::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('gambar_ukur_create') && Gate::denies('gambar_ukur_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new GambarUkur();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
