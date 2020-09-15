@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.jodesk.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.jodesks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_jodesk">{{ trans('cruds.jodesk.fields.nama_jodesk') }}</label>
                <input class="form-control {{ $errors->has('nama_jodesk') ? 'is-invalid' : '' }}" type="text" name="nama_jodesk" id="nama_jodesk" value="{{ old('nama_jodesk', '') }}" required>
                @if($errors->has('nama_jodesk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_jodesk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jodesk.fields.nama_jodesk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="deskripsi">{{ trans('cruds.jodesk.fields.deskripsi') }}</label>
                <input class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}" type="text" name="deskripsi" id="deskripsi" value="{{ old('deskripsi', '') }}" required>
                @if($errors->has('deskripsi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deskripsi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jodesk.fields.deskripsi_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.jodesk.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Jodesk::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jodesk.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="petugas">{{ trans('cruds.jodesk.fields.petugas') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('petugas') ? 'is-invalid' : '' }}" name="petugas[]" id="petugas" multiple>
                    @foreach($petugas as $id => $petugas)
                        <option value="{{ $id }}" {{ in_array($id, old('petugas', [])) ? 'selected' : '' }}>{{ $petugas }}</option>
                    @endforeach
                </select>
                @if($errors->has('petugas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('petugas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jodesk.fields.petugas_helper') }}</span>
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
