@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.gambarUkur.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gambar-ukurs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.gambarUkur.fields.id') }}
                        </th>
                        <td>
                            {{ $gambarUkur->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gambarUkur.fields.id_pengukuran') }}
                        </th>
                        <td>
                            {{ $gambarUkur->id_pengukuran->no_gu ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gambarUkur.fields.id_kecamatan') }}
                        </th>
                        <td>
                            {{ $gambarUkur->id_kecamatan->nama_kecamatan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gambarUkur.fields.id_desa') }}
                        </th>
                        <td>
                            {{ $gambarUkur->id_desa->nama_desa ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gambarUkur.fields.scan_gu') }}
                        </th>
                        <td>
                            @foreach($gambarUkur->scan_gu as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gambar-ukurs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
