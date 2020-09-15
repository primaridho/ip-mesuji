@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kecamatan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kecamatans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kecamatan.fields.id') }}
                        </th>
                        <td>
                            {{ $kecamatan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kecamatan.fields.kode_kecamatan') }}
                        </th>
                        <td>
                            {{ $kecamatan->kode_kecamatan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kecamatan.fields.nama_kecamatan') }}
                        </th>
                        <td>
                            {{ $kecamatan->nama_kecamatan }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kecamatans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#id_kecamatan_peta" role="tab" data-toggle="tab">
                {{ trans('cruds.petum.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="id_kecamatan_peta">
            @includeIf('admin.kecamatans.relationships.idKecamatanPeta', ['peta' => $kecamatan->idKecamatanPeta])
        </div>
    </div>
</div>

@endsection
