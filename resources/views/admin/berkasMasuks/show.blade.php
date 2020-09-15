@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.berkasMasuk.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.berkas-masuks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.id') }}
                        </th>
                        <td>
                            {{ $berkasMasuk->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.tgl_masuk') }}
                        </th>
                        <td>
                            {{ $berkasMasuk->tgl_masuk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.petugas_loket') }}
                        </th>
                        <td>
                            {{ $berkasMasuk->petugas_loket }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.penerima_masuk') }}
                        </th>
                        <td>
                            {{ $berkasMasuk->penerima_masuk->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.no_berkas') }}
                        </th>
                        <td>
                            {{ $berkasMasuk->no_berkas }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.nama_pemohon') }}
                        </th>
                        <td>
                            {{ $berkasMasuk->nama_pemohon }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.desa') }}
                        </th>
                        <td>
                            {{ $berkasMasuk->desa->nama_desa ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.kecamatan') }}
                        </th>
                        <td>
                            {{ $berkasMasuk->kecamatan->nama_kecamatan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.jenis_kegiatan') }}
                        </th>
                        <td>
                            {{ App\BerkasMasuk::JENIS_KEGIATAN_SELECT[$berkasMasuk->jenis_kegiatan] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.no_surattugas') }}
                        </th>
                        <td>
                            {{ $berkasMasuk->no_surattugas }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.tgl_surattugas') }}
                        </th>
                        <td>
                            {{ $berkasMasuk->tgl_surattugas }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.no_su') }}
                        </th>
                        <td>
                            {{ $berkasMasuk->no_su }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.no_hak') }}
                        </th>
                        <td>
                            {{ $berkasMasuk->no_hak }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.isiberkas') }}
                        </th>
                        <td>
                            @foreach($berkasMasuk->isiberkas as $key => $isiberkas)
                                <span class="label label-info">{{ $isiberkas->nama_isi }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.gambar_berkas') }}
                        </th>
                        <td>
                            @foreach($berkasMasuk->gambar_berkas as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.berkasMasuk.fields.keterangan') }}
                        </th>
                        <td>
                            {!! $berkasMasuk->keterangan !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.berkas-masuks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
