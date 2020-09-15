<?php

namespace App\Http\Controllers\Admin;

use App\BerkasMasuk;
use App\Desa;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPengukuranRequest;
use App\Http\Requests\StorePengukuranRequest;
use App\Http\Requests\UpdatePengukuranRequest;
use App\Kecamatan;
use App\Pengukuran;
use App\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PengukuranController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('pengukuran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Pengukuran::with(['id_berkas', 'pembantu_ukurs', 'desa', 'kecamatan'])->select(sprintf('%s.*', (new Pengukuran)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'pengukuran_show';
                $editGate      = 'pengukuran_edit';
                $deleteGate    = 'pengukuran_delete';
                $crudRoutePart = 'pengukurans';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('id_berkas_no_surattugas', function ($row) {
                return $row->id_berkas ? $row->id_berkas->no_surattugas : '';
            });

            $table->editColumn('id_berkas.tgl_masuk', function ($row) {
                return $row->id_berkas ? (is_string($row->id_berkas) ? $row->id_berkas : $row->id_berkas->tgl_masuk) : '';
            });
            $table->editColumn('id_berkas.petugas_loket', function ($row) {
                return $row->id_berkas ? (is_string($row->id_berkas) ? $row->id_berkas : $row->id_berkas->petugas_loket) : '';
            });
            $table->editColumn('pembantu_ukur', function ($row) {
                $labels = [];

                foreach ($row->pembantu_ukurs as $pembantu_ukur) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $pembantu_ukur->nama);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('desa_nama_desa', function ($row) {
                return $row->desa ? $row->desa->nama_desa : '';
            });

            $table->addColumn('kecamatan_nama_kecamatan', function ($row) {
                return $row->kecamatan ? $row->kecamatan->nama_kecamatan : '';
            });

            $table->editColumn('no_gu', function ($row) {
                return $row->no_gu ? $row->no_gu : "";
            });
            $table->editColumn('no_su_baru', function ($row) {
                return $row->no_su_baru ? $row->no_su_baru : "";
            });

            $table->editColumn('file_dwg', function ($row) {
                if (!$row->file_dwg) {
                    return '';
                }

                $links = [];

                foreach ($row->file_dwg as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'id_berkas', 'pembantu_ukur', 'desa', 'kecamatan', 'file_dwg']);

            return $table->make(true);
        }

        $berkas_masuks = BerkasMasuk::get();
        $teams         = Team::get();
        $desas         = Desa::get();
        $kecamatans    = Kecamatan::get();

        return view('admin.pengukurans.index', compact('berkas_masuks', 'teams', 'desas', 'kecamatans'));
    }

    public function create()
    {
        abort_if(Gate::denies('pengukuran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_berkas = BerkasMasuk::all()->pluck('no_surattugas', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pembantu_ukurs = Team::all()->pluck('nama', 'id');

        $desas = Desa::all()->pluck('nama_desa', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kecamatans = Kecamatan::all()->pluck('nama_kecamatan', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pengukurans.create', compact('id_berkas', 'pembantu_ukurs', 'desas', 'kecamatans'));
    }

    public function store(StorePengukuranRequest $request)
    {
        $pengukuran = Pengukuran::create($request->all());
        $pengukuran->pembantu_ukurs()->sync($request->input('pembantu_ukurs', []));

        foreach ($request->input('file_dwg', []) as $file) {
            $pengukuran->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('file_dwg');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pengukuran->id]);
        }

        return redirect()->route('admin.pengukurans.index');
    }

    public function edit(Pengukuran $pengukuran)
    {
        abort_if(Gate::denies('pengukuran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_berkas = BerkasMasuk::all()->pluck('no_surattugas', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pembantu_ukurs = Team::all()->pluck('nama', 'id');

        $desas = Desa::all()->pluck('nama_desa', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kecamatans = Kecamatan::all()->pluck('nama_kecamatan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengukuran->load('id_berkas', 'pembantu_ukurs', 'desa', 'kecamatan');

        return view('admin.pengukurans.edit', compact('id_berkas', 'pembantu_ukurs', 'desas', 'kecamatans', 'pengukuran'));
    }

    public function update(UpdatePengukuranRequest $request, Pengukuran $pengukuran)
    {
        $pengukuran->update($request->all());
        $pengukuran->pembantu_ukurs()->sync($request->input('pembantu_ukurs', []));

        if (count($pengukuran->file_dwg) > 0) {
            foreach ($pengukuran->file_dwg as $media) {
                if (!in_array($media->file_name, $request->input('file_dwg', []))) {
                    $media->delete();
                }
            }
        }

        $media = $pengukuran->file_dwg->pluck('file_name')->toArray();

        foreach ($request->input('file_dwg', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $pengukuran->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('file_dwg');
            }
        }

        return redirect()->route('admin.pengukurans.index');
    }

    public function show(Pengukuran $pengukuran)
    {
        abort_if(Gate::denies('pengukuran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengukuran->load('id_berkas', 'pembantu_ukurs', 'desa', 'kecamatan');

        return view('admin.pengukurans.show', compact('pengukuran'));
    }

    public function destroy(Pengukuran $pengukuran)
    {
        abort_if(Gate::denies('pengukuran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengukuran->delete();

        return back();
    }

    public function massDestroy(MassDestroyPengukuranRequest $request)
    {
        Pengukuran::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('pengukuran_create') && Gate::denies('pengukuran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Pengukuran();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
