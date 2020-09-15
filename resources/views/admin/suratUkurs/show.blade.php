@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.suratUkur.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.surat-ukurs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.suratUkur.fields.id') }}
                        </th>
                        <td>
                            {{ $suratUkur->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratUkur.fields.id_kecamatan') }}
                        </th>
                        <td>
                            {{ $suratUkur->id_kecamatan->nama_kecamatan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratUkur.fields.id_desa') }}
                        </th>
                        <td>
                            {{ $suratUkur->id_desa->nama_desa ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratUkur.fields.no_su') }}
                        </th>
                        <td>
                            {{ $suratUkur->no_su }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratUkur.fields.tahun') }}
                        </th>
                        <td>
                            {{ $suratUkur->tahun }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratUkur.fields.gambar') }}
                        </th>
                        <td>
                            @if($suratUkur->gambar)
                                <a href="{{ $suratUkur->gambar->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $suratUkur->gambar->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.surat-ukurs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
