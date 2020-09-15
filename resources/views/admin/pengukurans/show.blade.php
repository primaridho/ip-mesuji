@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pengukuran.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pengukurans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pengukuran.fields.id') }}
                        </th>
                        <td>
                            {{ $pengukuran->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengukuran.fields.id_berkas') }}
                        </th>
                        <td>
                            {{ $pengukuran->id_berkas->no_surattugas ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengukuran.fields.pembantu_ukur') }}
                        </th>
                        <td>
                            @foreach($pengukuran->pembantu_ukurs as $key => $pembantu_ukur)
                                <span class="label label-info">{{ $pembantu_ukur->nama }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengukuran.fields.desa') }}
                        </th>
                        <td>
                            {{ $pengukuran->desa->nama_desa ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengukuran.fields.kecamatan') }}
                        </th>
                        <td>
                            {{ $pengukuran->kecamatan->nama_kecamatan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengukuran.fields.no_gu') }}
                        </th>
                        <td>
                            {{ $pengukuran->no_gu }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengukuran.fields.no_su_baru') }}
                        </th>
                        <td>
                            {{ $pengukuran->no_su_baru }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengukuran.fields.tanggal_pengukuran') }}
                        </th>
                        <td>
                            {{ $pengukuran->tanggal_pengukuran }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengukuran.fields.file_dwg') }}
                        </th>
                        <td>
                            @foreach($pengukuran->file_dwg as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengukuran.fields.keterangan') }}
                        </th>
                        <td>
                            {!! $pengukuran->keterangan !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pengukurans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
