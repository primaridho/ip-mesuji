@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.desa.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.desas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.desa.fields.id') }}
                        </th>
                        <td>
                            {{ $desa->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.desa.fields.id_kecamatan') }}
                        </th>
                        <td>
                            {{ $desa->id_kecamatan->nama_kecamatan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.desa.fields.kode_desa') }}
                        </th>
                        <td>
                            {{ $desa->kode_desa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.desa.fields.nama_desa') }}
                        </th>
                        <td>
                            {{ $desa->nama_desa }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.desas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
