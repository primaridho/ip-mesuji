<?php

namespace App\Http\Controllers\Admin;

use App\BerkasKeluar;
use App\BerkasMasuk;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBerkasKeluarRequest;
use App\Http\Requests\StoreBerkasKeluarRequest;
use App\Http\Requests\UpdateBerkasKeluarRequest;
use App\IsiBerka;
use App\Pengukuran;
use App\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BerkasKeluarController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('berkas_keluar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BerkasKeluar::with(['berkasmasuk', 'pemberi_keluar', 'pengukuran', 'isiberkas_keluars'])->select(sprintf('%s.*', (new BerkasKeluar)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'berkas_keluar_show';
                $editGate      = 'berkas_keluar_edit';
                $deleteGate    = 'berkas_keluar_delete';
                $crudRoutePart = 'berkas-keluars';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('berkasmasuk_no_berkas', function ($row) {
                return $row->berkasmasuk ? $row->berkasmasuk->no_berkas : '';
            });

            $table->editColumn('berkasmasuk.tgl_masuk', function ($row) {
                return $row->berkasmasuk ? (is_string($row->berkasmasuk) ? $row->berkasmasuk : $row->berkasmasuk->tgl_masuk) : '';
            });
            $table->editColumn('berkasmasuk.jenis_kegiatan', function ($row) {
                return $row->berkasmasuk ? (is_string($row->berkasmasuk) ? $row->berkasmasuk : $row->berkasmasuk->jenis_kegiatan) : '';
            });
            $table->editColumn('berkasmasuk.nama_pemohon', function ($row) {
                return $row->berkasmasuk ? (is_string($row->berkasmasuk) ? $row->berkasmasuk : $row->berkasmasuk->nama_pemohon) : '';
            });

            $table->editColumn('penerima_keluar', function ($row) {
                return $row->penerima_keluar ? $row->penerima_keluar : "";
            });
            $table->addColumn('pemberi_keluar_nama', function ($row) {
                return $row->pemberi_keluar ? $row->pemberi_keluar->nama : '';
            });

            $table->addColumn('pengukuran_tanggal_pengukuran', function ($row) {
                return $row->pengukuran ? $row->pengukuran->tanggal_pengukuran : '';
            });

            $table->editColumn('pengukuran.no_gu', function ($row) {
                return $row->pengukuran ? (is_string($row->pengukuran) ? $row->pengukuran : $row->pengukuran->no_gu) : '';
            });
            $table->editColumn('pengukuran.no_su_baru', function ($row) {
                return $row->pengukuran ? (is_string($row->pengukuran) ? $row->pengukuran : $row->pengukuran->no_su_baru) : '';
            });
            $table->editColumn('isiberkas_keluar', function ($row) {
                $labels = [];

                foreach ($row->isiberkas_keluars as $isiberkas_keluar) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $isiberkas_keluar->nama_isi);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'berkasmasuk', 'pemberi_keluar', 'pengukuran', 'isiberkas_keluar']);

            return $table->make(true);
        }

        $berkas_masuks = BerkasMasuk::get();
        $teams         = Team::get();
        $pengukurans   = Pengukuran::get();
        $isi_berkas    = IsiBerka::get();

        return view('admin.berkasKeluars.index', compact('berkas_masuks', 'teams', 'pengukurans', 'isi_berkas'));
    }

    public function create()
    {
        abort_if(Gate::denies('berkas_keluar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $berkasmasuks = BerkasMasuk::all()->pluck('no_berkas', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pemberi_keluars = Team::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengukurans = Pengukuran::all()->pluck('tanggal_pengukuran', 'id')->prepend(trans('global.pleaseSelect'), '');

        $isiberkas_keluars = IsiBerka::all()->pluck('nama_isi', 'id');

        return view('admin.berkasKeluars.create', compact('berkasmasuks', 'pemberi_keluars', 'pengukurans', 'isiberkas_keluars'));
    }

    public function store(StoreBerkasKeluarRequest $request)
    {
        $berkasKeluar = BerkasKeluar::create($request->all());
        $berkasKeluar->isiberkas_keluars()->sync($request->input('isiberkas_keluars', []));

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $berkasKeluar->id]);
        }

        return redirect()->route('admin.berkas-keluars.index');
    }

    public function edit(BerkasKeluar $berkasKeluar)
    {
        abort_if(Gate::denies('berkas_keluar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $berkasmasuks = BerkasMasuk::all()->pluck('no_berkas', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pemberi_keluars = Team::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengukurans = Pengukuran::all()->pluck('tanggal_pengukuran', 'id')->prepend(trans('global.pleaseSelect'), '');

        $isiberkas_keluars = IsiBerka::all()->pluck('nama_isi', 'id');

        $berkasKeluar->load('berkasmasuk', 'pemberi_keluar', 'pengukuran', 'isiberkas_keluars');

        return view('admin.berkasKeluars.edit', compact('berkasmasuks', 'pemberi_keluars', 'pengukurans', 'isiberkas_keluars', 'berkasKeluar'));
    }

    public function update(UpdateBerkasKeluarRequest $request, BerkasKeluar $berkasKeluar)
    {
        $berkasKeluar->update($request->all());
        $berkasKeluar->isiberkas_keluars()->sync($request->input('isiberkas_keluars', []));

        return redirect()->route('admin.berkas-keluars.index');
    }

    public function show(BerkasKeluar $berkasKeluar)
    {
        abort_if(Gate::denies('berkas_keluar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $berkasKeluar->load('berkasmasuk', 'pemberi_keluar', 'pengukuran', 'isiberkas_keluars');

        return view('admin.berkasKeluars.show', compact('berkasKeluar'));
    }

    public function destroy(BerkasKeluar $berkasKeluar)
    {
        abort_if(Gate::denies('berkas_keluar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $berkasKeluar->delete();

        return back();
    }

    public function massDestroy(MassDestroyBerkasKeluarRequest $request)
    {
        BerkasKeluar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('berkas_keluar_create') && Gate::denies('berkas_keluar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BerkasKeluar();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
