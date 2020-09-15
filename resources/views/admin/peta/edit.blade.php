@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.petum.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.peta.update", [$petum->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="id_kecamatan_id">{{ trans('cruds.petum.fields.id_kecamatan') }}</label>
                <select class="form-control select2 {{ $errors->has('id_kecamatan') ? 'is-invalid' : '' }}" name="id_kecamatan_id" id="id_kecamatan_id" required>
                    @foreach($id_kecamatans as $id => $id_kecamatan)
                        <option value="{{ $id }}" {{ (old('id_kecamatan_id') ? old('id_kecamatan_id') : $petum->id_kecamatan->id ?? '') == $id ? 'selected' : '' }}>{{ $id_kecamatan }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_kecamatan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_kecamatan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.petum.fields.id_kecamatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_desa_id">{{ trans('cruds.petum.fields.id_desa') }}</label>
                <select class="form-control select2 {{ $errors->has('id_desa') ? 'is-invalid' : '' }}" name="id_desa_id" id="id_desa_id" required>
                    @foreach($id_desas as $id => $id_desa)
                        <option value="{{ $id }}" {{ (old('id_desa_id') ? old('id_desa_id') : $petum->id_desa->id ?? '') == $id ? 'selected' : '' }}>{{ $id_desa }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_desa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_desa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.petum.fields.id_desa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_peta">{{ trans('cruds.petum.fields.no_peta') }}</label>
                <input class="form-control {{ $errors->has('no_peta') ? 'is-invalid' : '' }}" type="text" name="no_peta" id="no_peta" value="{{ old('no_peta', $petum->no_peta) }}" required>
                @if($errors->has('no_peta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_peta') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.petum.fields.no_peta_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_lembar">{{ trans('cruds.petum.fields.no_lembar') }}</label>
                <input class="form-control {{ $errors->has('no_lembar') ? 'is-invalid' : '' }}" type="text" name="no_lembar" id="no_lembar" value="{{ old('no_lembar', $petum->no_lembar) }}" required>
                @if($errors->has('no_lembar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_lembar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.petum.fields.no_lembar_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tahun">{{ trans('cruds.petum.fields.tahun') }}</label>
                <input class="form-control date {{ $errors->has('tahun') ? 'is-invalid' : '' }}" type="text" name="tahun" id="tahun" value="{{ old('tahun', $petum->tahun) }}" required>
                @if($errors->has('tahun'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tahun') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.petum.fields.tahun_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.petum.fields.status_peta') }}</label>
                <select class="form-control {{ $errors->has('status_peta') ? 'is-invalid' : '' }}" name="status_peta" id="status_peta" required>
                    <option value disabled {{ old('status_peta', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Petum::STATUS_PETA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status_peta', $petum->status_peta) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status_peta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status_peta') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.petum.fields.status_peta_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.petum.fields.keterangan') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan">{!! old('keterangan', $petum->keterangan) !!}</textarea>
                @if($errors->has('keterangan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('keterangan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.petum.fields.keterangan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="scan_peta">{{ trans('cruds.petum.fields.scan_peta') }}</label>
                <div class="needsclick dropzone {{ $errors->has('scan_peta') ? 'is-invalid' : '' }}" id="scan_peta-dropzone">
                </div>
                @if($errors->has('scan_peta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('scan_peta') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.petum.fields.scan_peta_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/peta/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', {{ $petum->id ?? 0 }});
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    var uploadedScanPetaMap = {}
Dropzone.options.scanPetaDropzone = {
    url: '{{ route('admin.peta.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="scan_peta[]" value="' + response.name + '">')
      uploadedScanPetaMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedScanPetaMap[file.name]
      }
      $('form').find('input[name="scan_peta[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($petum) && $petum->scan_peta)
          var files =
            {!! json_encode($petum->scan_peta) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="scan_peta[]" value="' + file.file_name + '">')
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
