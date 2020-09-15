<?php

namespace App\Http\Controllers\Admin;

use App\BerkasMasuk;
use App\Desa;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBerkasMasukRequest;
use App\Http\Requests\StoreBerkasMasukRequest;
use App\Http\Requests\UpdateBerkasMasukRequest;
use App\IsiBerka;
use App\Kecamatan;
use App\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BerkasMasukController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('berkas_masuk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BerkasMasuk::with(['penerima_masuk', 'desa', 'kecamatan', 'isiberkas'])->select(sprintf('%s.*', (new BerkasMasuk)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'berkas_masuk_show';
                $editGate      = 'berkas_masuk_edit';
                $deleteGate    = 'berkas_masuk_delete';
                $crudRoutePart = 'berkas-masuks';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('petugas_loket', function ($row) {
                return $row->petugas_loket ? $row->petugas_loket : "";
            });
            $table->addColumn('penerima_masuk_nama', function ($row) {
                return $row->penerima_masuk ? $row->penerima_masuk->nama : '';
            });

            $table->editColumn('no_berkas', function ($row) {
                return $row->no_berkas ? $row->no_berkas : "";
            });
            $table->editColumn('nama_pemohon', function ($row) {
                return $row->nama_pemohon ? $row->nama_pemohon : "";
            });
            $table->addColumn('desa_nama_desa', function ($row) {
                return $row->desa ? $row->desa->nama_desa : '';
            });

            $table->addColumn('kecamatan_nama_kecamatan', function ($row) {
                return $row->kecamatan ? $row->kecamatan->nama_kecamatan : '';
            });

            $table->editColumn('jenis_kegiatan', function ($row) {
                return $row->jenis_kegiatan ? BerkasMasuk::JENIS_KEGIATAN_SELECT[$row->jenis_kegiatan] : '';
            });
            $table->editColumn('no_surattugas', function ($row) {
                return $row->no_surattugas ? $row->no_surattugas : "";
            });

            $table->editColumn('no_su', function ($row) {
                return $row->no_su ? $row->no_su : "";
            });
            $table->editColumn('no_hak', function ($row) {
                return $row->no_hak ? $row->no_hak : "";
            });
            $table->editColumn('isiberkas', function ($row) {
                $labels = [];

                foreach ($row->isiberkas as $isiberka) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $isiberka->nama_isi);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('gambar_berkas', function ($row) {
                if (!$row->gambar_berkas) {
                    return '';
                }

                $links = [];

                foreach ($row->gambar_berkas as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'penerima_masuk', 'desa', 'kecamatan', 'isiberkas', 'gambar_berkas']);

            return $table->make(true);
        }

        $teams      = Team::get();
        $desas      = Desa::get();
        $kecamatans = Kecamatan::get();
        $isi_berkas = IsiBerka::get();

        return view('admin.berkasMasuks.index', compact('teams', 'desas', 'kecamatans', 'isi_berkas'));
    }

    public function create()
    {
        abort_if(Gate::denies('berkas_masuk_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penerima_masuks = Team::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $desas = Desa::all()->pluck('nama_desa', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kecamatans = Kecamatan::all()->pluck('nama_kecamatan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $isiberkas = IsiBerka::all()->pluck('nama_isi', 'id');

        return view('admin.berkasMasuks.create', compact('penerima_masuks', 'desas', 'kecamatans', 'isiberkas'));
    }

    public function store(StoreBerkasMasukRequest $request)
    {
        $berkasMasuk = BerkasMasuk::create($request->all());
        $berkasMasuk->isiberkas()->sync($request->input('isiberkas', []));

        foreach ($request->input('gambar_berkas', []) as $file) {
            $berkasMasuk->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('gambar_berkas');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $berkasMasuk->id]);
        }

        return redirect()->route('admin.berkas-masuks.index');
    }

    public function edit(BerkasMasuk $berkasMasuk)
    {
        abort_if(Gate::denies('berkas_masuk_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penerima_masuks = Team::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $desas = Desa::all()->pluck('nama_desa', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kecamatans = Kecamatan::all()->pluck('nama_kecamatan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $isiberkas = IsiBerka::all()->pluck('nama_isi', 'id');

        $berkasMasuk->load('penerima_masuk', 'desa', 'kecamatan', 'isiberkas');

        return view('admin.berkasMasuks.edit', compact('penerima_masuks', 'desas', 'kecamatans', 'isiberkas', 'berkasMasuk'));
    }

    public function update(UpdateBerkasMasukRequest $request, BerkasMasuk $berkasMasuk)
    {
        $berkasMasuk->update($request->all());
        $berkasMasuk->isiberkas()->sync($request->input('isiberkas', []));

        if (count($berkasMasuk->gambar_berkas) > 0) {
            foreach ($berkasMasuk->gambar_berkas as $media) {
                if (!in_array($media->file_name, $request->input('gambar_berkas', []))) {
                    $media->delete();
                }
            }
        }

        $media = $berkasMasuk->gambar_berkas->pluck('file_name')->toArray();

        foreach ($request->input('gambar_berkas', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $berkasMasuk->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('gambar_berkas');
            }
        }

        return redirect()->route('admin.berkas-masuks.index');
    }

    public function show(BerkasMasuk $berkasMasuk)
    {
        abort_if(Gate::denies('berkas_masuk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $berkasMasuk->load('penerima_masuk', 'desa', 'kecamatan', 'isiberkas');

        return view('admin.berkasMasuks.show', compact('berkasMasuk'));
    }

    public function destroy(BerkasMasuk $berkasMasuk)
    {
        abort_if(Gate::denies('berkas_masuk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $berkasMasuk->delete();

        return back();
    }

    public function massDestroy(MassDestroyBerkasMasukRequest $request)
    {
        BerkasMasuk::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('berkas_masuk_create') && Gate::denies('berkas_masuk_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BerkasMasuk();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
