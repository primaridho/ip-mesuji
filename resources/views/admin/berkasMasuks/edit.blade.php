@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.berkasMasuk.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.berkas-masuks.update", [$berkasMasuk->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="tgl_masuk">{{ trans('cruds.berkasMasuk.fields.tgl_masuk') }}</label>
                <input class="form-control datetime {{ $errors->has('tgl_masuk') ? 'is-invalid' : '' }}" type="text" name="tgl_masuk" id="tgl_masuk" value="{{ old('tgl_masuk', $berkasMasuk->tgl_masuk) }}" required>
                @if($errors->has('tgl_masuk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tgl_masuk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.tgl_masuk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="petugas_loket">{{ trans('cruds.berkasMasuk.fields.petugas_loket') }}</label>
                <input class="form-control {{ $errors->has('petugas_loket') ? 'is-invalid' : '' }}" type="text" name="petugas_loket" id="petugas_loket" value="{{ old('petugas_loket', $berkasMasuk->petugas_loket) }}" required>
                @if($errors->has('petugas_loket'))
                    <div class="invalid-feedback">
                        {{ $errors->first('petugas_loket') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.petugas_loket_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="penerima_masuk_id">{{ trans('cruds.berkasMasuk.fields.penerima_masuk') }}</label>
                <select class="form-control select2 {{ $errors->has('penerima_masuk') ? 'is-invalid' : '' }}" name="penerima_masuk_id" id="penerima_masuk_id" required>
                    @foreach($penerima_masuks as $id => $penerima_masuk)
                        <option value="{{ $id }}" {{ (old('penerima_masuk_id') ? old('penerima_masuk_id') : $berkasMasuk->penerima_masuk->id ?? '') == $id ? 'selected' : '' }}>{{ $penerima_masuk }}</option>
                    @endforeach
                </select>
                @if($errors->has('penerima_masuk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('penerima_masuk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.penerima_masuk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_berkas">{{ trans('cruds.berkasMasuk.fields.no_berkas') }}</label>
                <input class="form-control {{ $errors->has('no_berkas') ? 'is-invalid' : '' }}" type="text" name="no_berkas" id="no_berkas" value="{{ old('no_berkas', $berkasMasuk->no_berkas) }}" required>
                @if($errors->has('no_berkas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_berkas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.no_berkas_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_pemohon">{{ trans('cruds.berkasMasuk.fields.nama_pemohon') }}</label>
                <input class="form-control {{ $errors->has('nama_pemohon') ? 'is-invalid' : '' }}" type="text" name="nama_pemohon" id="nama_pemohon" value="{{ old('nama_pemohon', $berkasMasuk->nama_pemohon) }}" required>
                @if($errors->has('nama_pemohon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_pemohon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.nama_pemohon_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="desa_id">{{ trans('cruds.berkasMasuk.fields.desa') }}</label>
                <select class="form-control select2 {{ $errors->has('desa') ? 'is-invalid' : '' }}" name="desa_id" id="desa_id" required>
                    @foreach($desas as $id => $desa)
                        <option value="{{ $id }}" {{ (old('desa_id') ? old('desa_id') : $berkasMasuk->desa->id ?? '') == $id ? 'selected' : '' }}>{{ $desa }}</option>
                    @endforeach
                </select>
                @if($errors->has('desa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('desa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.desa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kecamatan_id">{{ trans('cruds.berkasMasuk.fields.kecamatan') }}</label>
                <select class="form-control select2 {{ $errors->has('kecamatan') ? 'is-invalid' : '' }}" name="kecamatan_id" id="kecamatan_id" required>
                    @foreach($kecamatans as $id => $kecamatan)
                        <option value="{{ $id }}" {{ (old('kecamatan_id') ? old('kecamatan_id') : $berkasMasuk->kecamatan->id ?? '') == $id ? 'selected' : '' }}>{{ $kecamatan }}</option>
                    @endforeach
                </select>
                @if($errors->has('kecamatan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kecamatan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.kecamatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.berkasMasuk.fields.jenis_kegiatan') }}</label>
                <select class="form-control {{ $errors->has('jenis_kegiatan') ? 'is-invalid' : '' }}" name="jenis_kegiatan" id="jenis_kegiatan" required>
                    <option value disabled {{ old('jenis_kegiatan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\BerkasMasuk::JENIS_KEGIATAN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('jenis_kegiatan', $berkasMasuk->jenis_kegiatan) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenis_kegiatan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jenis_kegiatan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.jenis_kegiatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_surattugas">{{ trans('cruds.berkasMasuk.fields.no_surattugas') }}</label>
                <input class="form-control {{ $errors->has('no_surattugas') ? 'is-invalid' : '' }}" type="text" name="no_surattugas" id="no_surattugas" value="{{ old('no_surattugas', $berkasMasuk->no_surattugas) }}" required>
                @if($errors->has('no_surattugas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_surattugas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.no_surattugas_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tgl_surattugas">{{ trans('cruds.berkasMasuk.fields.tgl_surattugas') }}</label>
                <input class="form-control date {{ $errors->has('tgl_surattugas') ? 'is-invalid' : '' }}" type="text" name="tgl_surattugas" id="tgl_surattugas" value="{{ old('tgl_surattugas', $berkasMasuk->tgl_surattugas) }}" required>
                @if($errors->has('tgl_surattugas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tgl_surattugas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.tgl_surattugas_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_su">{{ trans('cruds.berkasMasuk.fields.no_su') }}</label>
                <input class="form-control {{ $errors->has('no_su') ? 'is-invalid' : '' }}" type="text" name="no_su" id="no_su" value="{{ old('no_su', $berkasMasuk->no_su) }}">
                @if($errors->has('no_su'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_su') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.no_su_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_hak">{{ trans('cruds.berkasMasuk.fields.no_hak') }}</label>
                <input class="form-control {{ $errors->has('no_hak') ? 'is-invalid' : '' }}" type="text" name="no_hak" id="no_hak" value="{{ old('no_hak', $berkasMasuk->no_hak) }}">
                @if($errors->has('no_hak'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_hak') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.no_hak_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="isiberkas">{{ trans('cruds.berkasMasuk.fields.isiberkas') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('isiberkas') ? 'is-invalid' : '' }}" name="isiberkas[]" id="isiberkas" multiple required>
                    @foreach($isiberkas as $id => $isiberkas)
                        <option value="{{ $id }}" {{ (in_array($id, old('isiberkas', [])) || $berkasMasuk->isiberkas->contains($id)) ? 'selected' : '' }}>{{ $isiberkas }}</option>
                    @endforeach
                </select>
                @if($errors->has('isiberkas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('isiberkas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.isiberkas_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="gambar_berkas">{{ trans('cruds.berkasMasuk.fields.gambar_berkas') }}</label>
                <div class="needsclick dropzone {{ $errors->has('gambar_berkas') ? 'is-invalid' : '' }}" id="gambar_berkas-dropzone">
                </div>
                @if($errors->has('gambar_berkas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gambar_berkas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.gambar_berkas_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.berkasMasuk.fields.keterangan') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan">{!! old('keterangan', $berkasMasuk->keterangan) !!}</textarea>
                @if($errors->has('keterangan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('keterangan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasMasuk.fields.keterangan_helper') }}</span>
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
    var uploadedGambarBerkasMap = {}
Dropzone.options.gambarBerkasDropzone = {
    url: '{{ route('admin.berkas-masuks.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="gambar_berkas[]" value="' + response.name + '">')
      uploadedGambarBerkasMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedGambarBerkasMap[file.name]
      }
      $('form').find('input[name="gambar_berkas[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($berkasMasuk) && $berkasMasuk->gambar_berkas)
      var files = {!! json_encode($berkasMasuk->gambar_berkas) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="gambar_berkas[]" value="' + file.file_name + '">')
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
                xhr.open('POST', '/admin/berkas-masuks/ckmedia', true);
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
                data.append('crud_id', {{ $berkasMasuk->id ?? 0 }});
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
