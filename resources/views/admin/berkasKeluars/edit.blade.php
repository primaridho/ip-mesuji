@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.berkasKeluar.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.berkas-keluars.update", [$berkasKeluar->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="berkasmasuk_id">{{ trans('cruds.berkasKeluar.fields.berkasmasuk') }}</label>
                <select class="form-control select2 {{ $errors->has('berkasmasuk') ? 'is-invalid' : '' }}" name="berkasmasuk_id" id="berkasmasuk_id" required>
                    @foreach($berkasmasuks as $id => $berkasmasuk)
                        <option value="{{ $id }}" {{ (old('berkasmasuk_id') ? old('berkasmasuk_id') : $berkasKeluar->berkasmasuk->id ?? '') == $id ? 'selected' : '' }}>{{ $berkasmasuk }}</option>
                    @endforeach
                </select>
                @if($errors->has('berkasmasuk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('berkasmasuk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasKeluar.fields.berkasmasuk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tgl_keluar">{{ trans('cruds.berkasKeluar.fields.tgl_keluar') }}</label>
                <input class="form-control datetime {{ $errors->has('tgl_keluar') ? 'is-invalid' : '' }}" type="text" name="tgl_keluar" id="tgl_keluar" value="{{ old('tgl_keluar', $berkasKeluar->tgl_keluar) }}" required>
                @if($errors->has('tgl_keluar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tgl_keluar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasKeluar.fields.tgl_keluar_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="penerima_keluar">{{ trans('cruds.berkasKeluar.fields.penerima_keluar') }}</label>
                <input class="form-control {{ $errors->has('penerima_keluar') ? 'is-invalid' : '' }}" type="text" name="penerima_keluar" id="penerima_keluar" value="{{ old('penerima_keluar', $berkasKeluar->penerima_keluar) }}" required>
                @if($errors->has('penerima_keluar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('penerima_keluar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasKeluar.fields.penerima_keluar_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pemberi_keluar_id">{{ trans('cruds.berkasKeluar.fields.pemberi_keluar') }}</label>
                <select class="form-control select2 {{ $errors->has('pemberi_keluar') ? 'is-invalid' : '' }}" name="pemberi_keluar_id" id="pemberi_keluar_id" required>
                    @foreach($pemberi_keluars as $id => $pemberi_keluar)
                        <option value="{{ $id }}" {{ (old('pemberi_keluar_id') ? old('pemberi_keluar_id') : $berkasKeluar->pemberi_keluar->id ?? '') == $id ? 'selected' : '' }}>{{ $pemberi_keluar }}</option>
                    @endforeach
                </select>
                @if($errors->has('pemberi_keluar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pemberi_keluar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasKeluar.fields.pemberi_keluar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pengukuran_id">{{ trans('cruds.berkasKeluar.fields.pengukuran') }}</label>
                <select class="form-control select2 {{ $errors->has('pengukuran') ? 'is-invalid' : '' }}" name="pengukuran_id" id="pengukuran_id">
                    @foreach($pengukurans as $id => $pengukuran)
                        <option value="{{ $id }}" {{ (old('pengukuran_id') ? old('pengukuran_id') : $berkasKeluar->pengukuran->id ?? '') == $id ? 'selected' : '' }}>{{ $pengukuran }}</option>
                    @endforeach
                </select>
                @if($errors->has('pengukuran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pengukuran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasKeluar.fields.pengukuran_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="isiberkas_keluars">{{ trans('cruds.berkasKeluar.fields.isiberkas_keluar') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('isiberkas_keluars') ? 'is-invalid' : '' }}" name="isiberkas_keluars[]" id="isiberkas_keluars" multiple required>
                    @foreach($isiberkas_keluars as $id => $isiberkas_keluar)
                        <option value="{{ $id }}" {{ (in_array($id, old('isiberkas_keluars', [])) || $berkasKeluar->isiberkas_keluars->contains($id)) ? 'selected' : '' }}>{{ $isiberkas_keluar }}</option>
                    @endforeach
                </select>
                @if($errors->has('isiberkas_keluars'))
                    <div class="invalid-feedback">
                        {{ $errors->first('isiberkas_keluars') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasKeluar.fields.isiberkas_keluar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.berkasKeluar.fields.keterangan') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan">{!! old('keterangan', $berkasKeluar->keterangan) !!}</textarea>
                @if($errors->has('keterangan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('keterangan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.berkasKeluar.fields.keterangan_helper') }}</span>
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
                xhr.open('POST', '/admin/berkas-keluars/ckmedia', true);
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
                data.append('crud_id', {{ $berkasKeluar->id ?? 0 }});
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
