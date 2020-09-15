@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.gambarUkur.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.gambar-ukurs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="id_pengukuran_id">{{ trans('cruds.gambarUkur.fields.id_pengukuran') }}</label>
                <select class="form-control select2 {{ $errors->has('id_pengukuran') ? 'is-invalid' : '' }}" name="id_pengukuran_id" id="id_pengukuran_id" required>
                    @foreach($id_pengukurans as $id => $id_pengukuran)
                        <option value="{{ $id }}" {{ old('id_pengukuran_id') == $id ? 'selected' : '' }}>{{ $id_pengukuran }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_pengukuran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_pengukuran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.gambarUkur.fields.id_pengukuran_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_kecamatan_id">{{ trans('cruds.gambarUkur.fields.id_kecamatan') }}</label>
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
                <span class="help-block">{{ trans('cruds.gambarUkur.fields.id_kecamatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_desa_id">{{ trans('cruds.gambarUkur.fields.id_desa') }}</label>
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
                <span class="help-block">{{ trans('cruds.gambarUkur.fields.id_desa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="scan_gu">{{ trans('cruds.gambarUkur.fields.scan_gu') }}</label>
                <div class="needsclick dropzone {{ $errors->has('scan_gu') ? 'is-invalid' : '' }}" id="scan_gu-dropzone">
                </div>
                @if($errors->has('scan_gu'))
                    <div class="invalid-feedback">
                        {{ $errors->first('scan_gu') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.gambarUkur.fields.scan_gu_helper') }}</span>
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
    var uploadedScanGuMap = {}
Dropzone.options.scanGuDropzone = {
    url: '{{ route('admin.gambar-ukurs.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="scan_gu[]" value="' + response.name + '">')
      uploadedScanGuMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedScanGuMap[file.name]
      }
      $('form').find('input[name="scan_gu[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($gambarUkur) && $gambarUkur->scan_gu)
          var files =
            {!! json_encode($gambarUkur->scan_gu) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="scan_gu[]" value="' + file.file_name + '">')
            }
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
