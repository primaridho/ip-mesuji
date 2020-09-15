@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.suratUkur.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.surat-ukurs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="id_kecamatan_id">{{ trans('cruds.suratUkur.fields.id_kecamatan') }}</label>
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
                <span class="help-block">{{ trans('cruds.suratUkur.fields.id_kecamatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_desa_id">{{ trans('cruds.suratUkur.fields.id_desa') }}</label>
                <select class="form-control select2 {{ $errors->has('id_desa') ? 'is-invalid' : '' }}" name="id_desa_id" id="id_desa_id" required>
                    @foreach($id_desas as $id => $id_desa)
                        <option value="{{ $id }}" {{ old('id_desa_id') == $id ? 'selected' : '' }}>{{ $id_desa }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_desa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_desa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suratUkur.fields.id_desa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_su">{{ trans('cruds.suratUkur.fields.no_su') }}</label>
                <input class="form-control {{ $errors->has('no_su') ? 'is-invalid' : '' }}" type="text" name="no_su" id="no_su" value="{{ old('no_su', '') }}" required>
                @if($errors->has('no_su'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_su') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suratUkur.fields.no_su_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tahun">{{ trans('cruds.suratUkur.fields.tahun') }}</label>
                <input class="form-control date {{ $errors->has('tahun') ? 'is-invalid' : '' }}" type="text" name="tahun" id="tahun" value="{{ old('tahun') }}" required>
                @if($errors->has('tahun'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tahun') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suratUkur.fields.tahun_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="gambar">{{ trans('cruds.suratUkur.fields.gambar') }}</label>
                <div class="needsclick dropzone {{ $errors->has('gambar') ? 'is-invalid' : '' }}" id="gambar-dropzone">
                </div>
                @if($errors->has('gambar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gambar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suratUkur.fields.gambar_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.gambarDropzone = {
    url: '{{ route('admin.surat-ukurs.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="gambar"]').remove()
      $('form').append('<input type="hidden" name="gambar" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="gambar"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($suratUkur) && $suratUkur->gambar)
      var file = {!! json_encode($suratUkur->gambar) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="gambar" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection
