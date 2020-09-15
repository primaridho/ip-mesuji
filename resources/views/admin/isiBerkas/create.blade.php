@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.isiBerka.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.isi-berkas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_isi">{{ trans('cruds.isiBerka.fields.nama_isi') }}</label>
                <input class="form-control {{ $errors->has('nama_isi') ? 'is-invalid' : '' }}" type="text" name="nama_isi" id="nama_isi" value="{{ old('nama_isi', '') }}" required>
                @if($errors->has('nama_isi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_isi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.isiBerka.fields.nama_isi_helper') }}</span>
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
