@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pengukuran.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pengukurans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="id_berkas_id">{{ trans('cruds.pengukuran.fields.id_berkas') }}</label>
                <select class="form-control select2 {{ $errors->has('id_berkas') ? 'is-invalid' : '' }}" name="id_berkas_id" id="id_berkas_id" required>
                    @foreach($id_berkas as $id => $id_berkas)
                        <option value="{{ $id }}" {{ old('id_berkas_id') == $id ? 'selected' : '' }}>{{ $id_berkas }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_berkas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_berkas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pengukuran.fields.id_berkas_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pembantu_ukurs">{{ trans('cruds.pengukuran.fields.pembantu_ukur') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('pembantu_ukurs') ? 'is-invalid' : '' }}" name="pembantu_ukurs[]" id="pembantu_ukurs" multiple required>
                    @foreach($pembantu_ukurs as $id => $pembantu_ukur)
                        <option value="{{ $id }}" {{ in_array($id, old('pembantu_ukurs', [])) ? 'selected' : '' }}>{{ $pembantu_ukur }}</option>
                    @endforeach
                </select>
                @if($errors->has('pembantu_ukurs'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pembantu_ukurs') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pengukuran.fields.pembantu_ukur_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="desa_id">{{ trans('cruds.pengukuran.fields.desa') }}</label>
                <select class="form-control select2 {{ $errors->has('desa') ? 'is-invalid' : '' }}" name="desa_id" id="desa_id" required>
                    @foreach($desas as $id => $desa)
                        <option value="{{ $id }}" {{ old('desa_id') == $id ? 'selected' : '' }}>{{ $desa }}</option>
                    @endforeach
                </select>
                @if($errors->has('desa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('desa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pengukuran.fields.desa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kecamatan_id">{{ trans('cruds.pengukuran.fields.kecamatan') }}</label>
                <select class="form-control select2 {{ $errors->has('kecamatan') ? 'is-invalid' : '' }}" name="kecamatan_id" id="kecamatan_id" required>
                    @foreach($kecamatans as $id => $kecamatan)
                        <option value="{{ $id }}" {{ old('kecamatan_id') == $id ? 'selected' : '' }}>{{ $kecamatan }}</option>
                    @endforeach
                </select>
                @if($errors->has('kecamatan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kecamatan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pengukuran.fields.kecamatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_gu">{{ trans('cruds.pengukuran.fields.no_gu') }}</label>
                <input class="form-control {{ $errors->has('no_gu') ? 'is-invalid' : '' }}" type="text" name="no_gu" id="no_gu" value="{{ old('no_gu', '') }}" required>
                @if($errors->has('no_gu'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_gu') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pengukuran.fields.no_gu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_su_baru">{{ trans('cruds.pengukuran.fields.no_su_baru') }}</label>
                <input class="form-control {{ $errors->has('no_su_baru') ? 'is-invalid' : '' }}" type="text" name="no_su_baru" id="no_su_baru" value="{{ old('no_su_baru', '') }}">
                @if($errors->has('no_su_baru'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_su_baru') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pengukuran.fields.no_su_baru_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tanggal_pengukuran">{{ trans('cruds.pengukuran.fields.tanggal_pengukuran') }}</label>
                <input class="form-control datetime {{ $errors->has('tanggal_pengukuran') ? 'is-invalid' : '' }}" type="text" name="tanggal_pengukuran" id="tanggal_pengukuran" value="{{ old('tanggal_pengukuran') }}" required>
                @if($errors->has('tanggal_pengukuran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tanggal_pengukuran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pengukuran.fields.tanggal_pengukuran_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_dwg">{{ trans('cruds.pengukuran.fields.file_dwg') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_dwg') ? 'is-invalid' : '' }}" id="file_dwg-dropzone">
                </div>
                @if($errors->has('file_dwg'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_dwg') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pengukuran.fields.file_dwg_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.pengukuran.fields.keterangan') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan">{!! old('keterangan') !!}</textarea>
                @if($errors->has('keterangan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('keterangan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pengukuran.fields.keterangan_helper') }}</span>
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
    var uploadedFileDwgMap = {}
Dropzone.options.fileDwgDropzone = {
    url: '{{ route('admin.pengukurans.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file_dwg[]" value="' + response.name + '">')
      uploadedFileDwgMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileDwgMap[file.name]
      }
      $('form').find('input[name="file_dwg[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($pengukuran) && $pengukuran->file_dwg)
          var files =
            {!! json_encode($pengukuran->file_dwg) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file_dwg[]" value="' + file.file_name + '">')
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
                xhr.open('POST', '/admin/pengukurans/ckmedia', true);
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
                data.append('crud_id', {{ $pengukuran->id ?? 0 }});
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

@endsection
