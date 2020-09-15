@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.berkasKeluar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.berkas-keluars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasKeluar.fields.id') }}
                        </th>
                        <td>
                            {{ $berkasKeluar->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasKeluar.fields.berkasmasuk') }}
                        </th>
                        <td>
                            {{ $berkasKeluar->berkasmasuk->no_berkas ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasKeluar.fields.tgl_keluar') }}
                        </th>
                        <td>
                            {{ $berkasKeluar->tgl_keluar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasKeluar.fields.penerima_keluar') }}
                        </th>
                        <td>
                            {{ $berkasKeluar->penerima_keluar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasKeluar.fields.pemberi_keluar') }}
                        </th>
                        <td>
                            {{ $berkasKeluar->pemberi_keluar->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasKeluar.fields.pengukuran') }}
                        </th>
                        <td>
                            {{ $berkasKeluar->pengukuran->tanggal_pengukuran ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasKeluar.fields.isiberkas_keluar') }}
                        </th>
                        <td>
                            @foreach($berkasKeluar->isiberkas_keluars as $key => $isiberkas_keluar)
                                <span class="label label-info">{{ $isiberkas_keluar->nama_isi }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasKeluar.fields.keterangan') }}
                        </th>
                        <td>
                            {!! $berkasKeluar->keterangan !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.berkas-keluars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
