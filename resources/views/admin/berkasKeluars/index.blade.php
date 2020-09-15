@extends('layouts.admin')
@section('content')
@can('berkas_keluar_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.berkas-keluars.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.berkasKeluar.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.berkasKeluar.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BerkasKeluar">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.berkasKeluar.fields.berkasmasuk') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.tgl_masuk') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.jenis_kegiatan') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.nama_pemohon') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasKeluar.fields.tgl_keluar') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasKeluar.fields.penerima_keluar') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasKeluar.fields.pemberi_keluar') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasKeluar.fields.pengukuran') }}
                    </th>
                    <th>
                        {{ trans('cruds.pengukuran.fields.no_gu') }}
                    </th>
                    <th>
                        {{ trans('cruds.pengukuran.fields.no_su_baru') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasKeluar.fields.isiberkas_keluar') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($berkas_masuks as $key => $item)
                                <option value="{{ $item->no_berkas }}">{{ $item->no_berkas }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
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
                            @foreach($teams as $key => $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($pengukurans as $key => $item)
                                <option value="{{ $item->tanggal_pengukuran }}">{{ $item->tanggal_pengukuran }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
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
@can('berkas_keluar_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.berkas-keluars.massDestroy') }}",
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
    ajax: "{{ route('admin.berkas-keluars.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'berkasmasuk_no_berkas', name: 'berkasmasuk.no_berkas' },
{ data: 'berkasmasuk.tgl_masuk', name: 'berkasmasuk.tgl_masuk' },
{ data: 'berkasmasuk.jenis_kegiatan', name: 'berkasmasuk.jenis_kegiatan' },
{ data: 'berkasmasuk.nama_pemohon', name: 'berkasmasuk.nama_pemohon' },
{ data: 'tgl_keluar', name: 'tgl_keluar' },
{ data: 'penerima_keluar', name: 'penerima_keluar' },
{ data: 'pemberi_keluar_nama', name: 'pemberi_keluar.nama' },
{ data: 'pengukuran_tanggal_pengukuran', name: 'pengukuran.tanggal_pengukuran' },
{ data: 'pengukuran.no_gu', name: 'pengukuran.no_gu' },
{ data: 'pengukuran.no_su_baru', name: 'pengukuran.no_su_baru' },
{ data: 'isiberkas_keluar', name: 'isiberkas_keluars.nama_isi' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 5, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-BerkasKeluar').DataTable(dtOverrideGlobals);
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
