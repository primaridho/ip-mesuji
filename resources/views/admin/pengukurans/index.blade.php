@extends('layouts.admin')
@section('content')
@can('pengukuran_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.pengukurans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.pengukuran.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.pengukuran.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Pengukuran">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.pengukuran.fields.id_berkas') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.tgl_masuk') }}
                    </th>
                    <th>
                        {{ trans('cruds.berkasMasuk.fields.petugas_loket') }}
                    </th>
                    <th>
                        {{ trans('cruds.pengukuran.fields.pembantu_ukur') }}
                    </th>
                    <th>
                        {{ trans('cruds.pengukuran.fields.desa') }}
                    </th>
                    <th>
                        {{ trans('cruds.pengukuran.fields.kecamatan') }}
                    </th>
                    <th>
                        {{ trans('cruds.pengukuran.fields.no_gu') }}
                    </th>
                    <th>
                        {{ trans('cruds.pengukuran.fields.no_su_baru') }}
                    </th>
                    <th>
                        {{ trans('cruds.pengukuran.fields.tanggal_pengukuran') }}
                    </th>
                    <th>
                        {{ trans('cruds.pengukuran.fields.file_dwg') }}
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
                                <option value="{{ $item->no_surattugas }}">{{ $item->no_surattugas }}</option>
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
                            @foreach($teams as $key => $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
@can('pengukuran_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pengukurans.massDestroy') }}",
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
    ajax: "{{ route('admin.pengukurans.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id_berkas_no_surattugas', name: 'id_berkas.no_surattugas' },
{ data: 'id_berkas.tgl_masuk', name: 'id_berkas.tgl_masuk' },
{ data: 'id_berkas.petugas_loket', name: 'id_berkas.petugas_loket' },
{ data: 'pembantu_ukur', name: 'pembantu_ukurs.nama' },
{ data: 'desa_nama_desa', name: 'desa.nama_desa' },
{ data: 'kecamatan_nama_kecamatan', name: 'kecamatan.nama_kecamatan' },
{ data: 'no_gu', name: 'no_gu' },
{ data: 'no_su_baru', name: 'no_su_baru' },
{ data: 'tanggal_pengukuran', name: 'tanggal_pengukuran' },
{ data: 'file_dwg', name: 'file_dwg', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 9, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-Pengukuran').DataTable(dtOverrideGlobals);
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
