<?php

namespace App\Http\Controllers\Admin;

use App\Desa;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDesaRequest;
use App\Http\Requests\StoreDesaRequest;
use App\Http\Requests\UpdateDesaRequest;
use App\Kecamatan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DesaController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('desa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Desa::with(['id_kecamatan'])->select(sprintf('%s.*', (new Desa)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'desa_show';
                $editGate      = 'desa_edit';
                $deleteGate    = 'desa_delete';
                $crudRoutePart = 'desas';

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

            $table->editColumn('kode_desa', function ($row) {
                return $row->kode_desa ? $row->kode_desa : "";
            });
            $table->editColumn('nama_desa', function ($row) {
                return $row->nama_desa ? $row->nama_desa : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'id_kecamatan']);

            return $table->make(true);
        }

        $kecamatans = Kecamatan::get();

        return view('admin.desas.index', compact('kecamatans'));
    }

    public function create()
    {
        abort_if(Gate::denies('desa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_kecamatans = Kecamatan::all()->pluck('nama_kecamatan', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.desas.create', compact('id_kecamatans'));
    }

    public function store(StoreDesaRequest $request)
    {
        $desa = Desa::create($request->all());

        return redirect()->route('admin.desas.index');
    }

    public function edit(Desa $desa)
    {
        abort_if(Gate::denies('desa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_kecamatans = Kecamatan::all()->pluck('nama_kecamatan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $desa->load('id_kecamatan');

        return view('admin.desas.edit', compact('id_kecamatans', 'desa'));
    }

    public function update(UpdateDesaRequest $request, Desa $desa)
    {
        $desa->update($request->all());

        return redirect()->route('admin.desas.index');
    }

    public function show(Desa $desa)
    {
        abort_if(Gate::denies('desa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $desa->load('id_kecamatan', 'idDesaPeta');

        return view('admin.desas.show', compact('desa'));
    }

    public function destroy(Desa $desa)
    {
        abort_if(Gate::denies('desa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $desa->delete();

        return back();
    }

    public function massDestroy(MassDestroyDesaRequest $request)
    {
        Desa::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
