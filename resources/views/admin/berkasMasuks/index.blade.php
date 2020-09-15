@extends('layouts.admin')
@section('content')
@can('berkas_masuk_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.berkas-masuks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.berkasMasuk.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.berkasMasuk.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BerkasMasuk">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.tgl_masuk') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.petugas_loket') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.penerima_masuk') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.no_berkas') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.nama_pemohon') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.desa') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.kecamatan') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.jenis_kegiatan') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.no_surattugas') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.tgl_surattugas') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.no_su') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.no_hak') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.isiberkas') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.gambar_berkas') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($teams as $key => $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($desas as $key => $item)
                                <option value="{{ $item->nama_desa }}">{{ $item->nama_desa }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($kecamatans as $key => $item)
                                <option value="{{ $item->nama_kecamatan }}">{{ $item->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\BerkasMasuk::JENIS_KEGIATAN_SELECT as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($isi_berkas as $key => $item)
                                <option value="{{ $item->nama_isi }}">{{ $item->nama_isi }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('berkas_masuk_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.berkas-masuks.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.berkas-masuks.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'tgl_masuk', name: 'tgl_masuk' },
{ data: 'petugas_loket', name: 'petugas_loket' },
{ data: 'penerima_masuk_nama', name: 'penerima_masuk.nama' },
{ data: 'no_berkas', name: 'no_berkas' },
{ data: 'nama_pemohon', name: 'nama_pemohon' },
{ data: 'desa_nama_desa', name: 'desa.nama_desa' },
{ data: 'kecamatan_nama_kecamatan', name: 'kecamatan.nama_kecamatan' },
{ data: 'jenis_kegiatan', name: 'jenis_kegiatan' },
{ data: 'no_surattugas', name: 'no_surattugas' },
{ data: 'tgl_surattugas', name: 'tgl_surattugas' },
{ data: 'no_su', name: 'no_su' },
{ data: 'no_hak', name: 'no_hak' },
{ data: 'isiberkas', name: 'isiberkas.nama_isi' },
{ data: 'gambar_berkas', name: 'gambar_berkas', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-BerkasMasuk').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value
      table
        .column($(this).parent().index())
        .search(value, strict)
        .draw()
  });
});

</script>
@endsection
