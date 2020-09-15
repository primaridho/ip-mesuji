<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJodeskRequest;
use App\Http\Requests\StoreJodeskRequest;
use App\Http\Requests\UpdateJodeskRequest;
use App\Jodesk;
use App\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JodeskController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('jodesk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Jodesk::with(['petugas'])->select(sprintf('%s.*', (new Jodesk)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'jodesk_show';
                $editGate      = 'jodesk_edit';
                $deleteGate    = 'jodesk_delete';
                $crudRoutePart = 'jodesks';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('nama_jodesk', function ($row) {
                return $row->nama_jodesk ? $row->nama_jodesk : "";
            });
            $table->editColumn('deskripsi', function ($row) {
                return $row->deskripsi ? $row->deskripsi : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Jodesk::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('petugas', function ($row) {
                $labels = [];

                foreach ($row->petugas as $petuga) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $petuga->nama);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'petugas']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.jodesks.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('jodesk_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $petugas = Team::all()->pluck('nama', 'id');

        return view('admin.jodesks.create', compact('petugas'));
    }

    public function store(StoreJodeskRequest $request)
    {
        $jodesk = Jodesk::create($request->all());
        $jodesk->petugas()->sync($request->input('petugas', []));

        return redirect()->route('admin.jodesks.index');
    }

    public function edit(Jodesk $jodesk)
    {
        abort_if(Gate::denies('jodesk_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $petugas = Team::all()->pluck('nama', 'id');

        $jodesk->load('petugas');

        return view('admin.jodesks.edit', compact('petugas', 'jodesk'));
    }

    public function update(UpdateJodeskRequest $request, Jodesk $jodesk)
    {
        $jodesk->update($request->all());
        $jodesk->petugas()->sync($request->input('petugas', []));

        return redirect()->route('admin.jodesks.index');
    }

    public function show(Jodesk $jodesk)
    {
        abort_if(Gate::denies('jodesk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jodesk->load('petugas');

        return view('admin.jodesks.show', compact('jodesk'));
    }

    public function destroy(Jodesk $jodesk)
    {
        abort_if(Gate::denies('jodesk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jodesk->delete();

        return back();
    }

    public function massDestroy(MassDestroyJodeskRequest $request)
    {
        Jodesk::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
