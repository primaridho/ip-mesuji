<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKecamatanRequest;
use App\Http\Requests\StoreKecamatanRequest;
use App\Http\Requests\UpdateKecamatanRequest;
use App\Kecamatan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KecamatanController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('kecamatan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Kecamatan::query()->select(sprintf('%s.*', (new Kecamatan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'kecamatan_show';
                $editGate      = 'kecamatan_edit';
                $deleteGate    = 'kecamatan_delete';
                $crudRoutePart = 'kecamatans';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('kode_kecamatan', function ($row) {
                return $row->kode_kecamatan ? $row->kode_kecamatan : "";
            });
            $table->editColumn('nama_kecamatan', function ($row) {
                return $row->nama_kecamatan ? $row->nama_kecamatan : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.kecamatans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kecamatan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kecamatans.create');
    }

    public function store(StoreKecamatanRequest $request)
    {
        $kecamatan = Kecamatan::create($request->all());

        return redirect()->route('admin.kecamatans.index');
    }

    public function edit(Kecamatan $kecamatan)
    {
        abort_if(Gate::denies('kecamatan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kecamatans.edit', compact('kecamatan'));
    }

    public function update(UpdateKecamatanRequest $request, Kecamatan $kecamatan)
    {
        $kecamatan->update($request->all());

        return redirect()->route('admin.kecamatans.index');
    }

    public function show(Kecamatan $kecamatan)
    {
        abort_if(Gate::denies('kecamatan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kecamatan->load('idKecamatanPeta');

        return view('admin.kecamatans.show', compact('kecamatan'));
    }

    public function destroy(Kecamatan $kecamatan)
    {
        abort_if(Gate::denies('kecamatan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kecamatan->delete();

        return back();
    }

    public function massDestroy(MassDestroyKecamatanRequest $request)
    {
        Kecamatan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
