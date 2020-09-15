@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.petum.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.peta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.petum.fields.id') }}
                        </th>
                        <td>
                            {{ $petum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.petum.fields.id_kecamatan') }}
                        </th>
                        <td>
                            {{ $petum->id_kecamatan->nama_kecamatan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.petum.fields.id_desa') }}
                        </th>
                        <td>
                            {{ $petum->id_desa->nama_desa ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.petum.fields.no_peta') }}
                        </th>
                        <td>
                            {{ $petum->no_peta }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.petum.fields.no_lembar') }}
                        </th>
                        <td>
                            {{ $petum->no_lembar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.petum.fields.tahun') }}
                        </th>
                        <td>
                            {{ $petum->tahun }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.petum.fields.status_peta') }}
                        </th>
                        <td>
                            {{ App\Petum::STATUS_PETA_SELECT[$petum->status_peta] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.petum.fields.keterangan') }}
                        </th>
                        <td>
                            {!! $petum->keterangan !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.petum.fields.scan_peta') }}
                        </th>
                        <td>
                            @foreach($petum->scan_peta as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.peta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
