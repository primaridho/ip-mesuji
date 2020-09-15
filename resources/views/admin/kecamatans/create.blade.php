@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.kecamatan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kecamatans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="kode_kecamatan">{{ trans('cruds.kecamatan.fields.kode_kecamatan') }}</label>
                <input class="form-control {{ $errors->has('kode_kecamatan') ? 'is-invalid' : '' }}" type="text" name="kode_kecamatan" id="kode_kecamatan" value="{{ old('kode_kecamatan', '') }}" required>
                @if($errors->has('kode_kecamatan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kode_kecamatan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kecamatan.fields.kode_kecamatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_kecamatan">{{ trans('cruds.kecamatan.fields.nama_kecamatan') }}</label>
                <input class="form-control {{ $errors->has('nama_kecamatan') ? 'is-invalid' : '' }}" type="text" name="nama_kecamatan" id="nama_kecamatan" value="{{ old('nama_kecamatan', '') }}" required>
                @if($errors->has('nama_kecamatan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_kecamatan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kecamatan.fields.nama_kecamatan_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
