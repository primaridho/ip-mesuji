@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.desa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.desas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="id_kecamatan_id">{{ trans('cruds.desa.fields.id_kecamatan') }}</label>
                <select class="form-control select2 {{ $errors->has('id_kecamatan') ? 'is-invalid' : '' }}" name="id_kecamatan_id" id="id_kecamatan_id" required>
                    @foreach($id_kecamatans as $id => $id_kecamatan)
                        <option value="{{ $id }}" {{ old('id_kecamatan_id') == $id ? 'selected' : '' }}>{{ $id_kecamatan }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_kecamatan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_kecamatan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.desa.fields.id_kecamatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kode_desa">{{ trans('cruds.desa.fields.kode_desa') }}</label>
                <input class="form-control {{ $errors->has('kode_desa') ? 'is-invalid' : '' }}" type="text" name="kode_desa" id="kode_desa" value="{{ old('kode_desa', '') }}" required>
                @if($errors->has('kode_desa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kode_desa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.desa.fields.kode_desa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_desa">{{ trans('cruds.desa.fields.nama_desa') }}</label>
                <input class="form-control {{ $errors->has('nama_desa') ? 'is-invalid' : '' }}" type="text" name="nama_desa" id="nama_desa" value="{{ old('nama_desa', '') }}" required>
                @if($errors->has('nama_desa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_desa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.desa.fields.nama_desa_helper') }}</span>
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
