<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIsiBerkaRequest;
use App\Http\Requests\StoreIsiBerkaRequest;
use App\Http\Requests\UpdateIsiBerkaRequest;
use App\IsiBerka;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IsiBerkasController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('isi_berka_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IsiBerka::query()->select(sprintf('%s.*', (new IsiBerka)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'isi_berka_show';
                $editGate      = 'isi_berka_edit';
                $deleteGate    = 'isi_berka_delete';
                $crudRoutePart = 'isi-berkas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('nama_isi', function ($row) {
                return $row->nama_isi ? $row->nama_isi : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.isiBerkas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('isi_berka_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.isiBerkas.create');
    }

    public function store(StoreIsiBerkaRequest $request)
    {
        $isiBerka = IsiBerka::create($request->all());

        return redirect()->route('admin.isi-berkas.index');
    }

    public function edit(IsiBerka $isiBerka)
    {
        abort_if(Gate::denies('isi_berka_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.isiBerkas.edit', compact('isiBerka'));
    }

    public function update(UpdateIsiBerkaRequest $request, IsiBerka $isiBerka)
    {
        $isiBerka->update($request->all());

        return redirect()->route('admin.isi-berkas.index');
    }

    public function show(IsiBerka $isiBerka)
    {
        abort_if(Gate::denies('isi_berka_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.isiBerkas.show', compact('isiBerka'));
    }

    public function destroy(IsiBerka $isiBerka)
    {
        abort_if(Gate::denies('isi_berka_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $isiBerka->delete();

        return back();
    }

    public function massDestroy(MassDestroyIsiBerkaRequest $request)
    {
        IsiBerka::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
