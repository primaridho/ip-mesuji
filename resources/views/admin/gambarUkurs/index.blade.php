@extends('layouts.admin')
@section('content')
@can('gambar_ukur_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.gambar-ukurs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.gambarUkur.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.gambarUkur.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-GambarUkur">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.gambarUkur.fields.id_pengukuran') }}
                    </th>
                    <th>
                        {{ trans('cruds.pengukuran.fields.tanggal_pengukuran') }}
                    </th>
                    <th>
                        {{ trans('cruds.gambarUkur.fields.id_kecamatan') }}
                    </th>
                    <th>
                        {{ trans('cruds.gambarUkur.fields.id_desa') }}
                    </th>
                    <th>
                        {{ trans('cruds.desa.fields.kode_desa') }}
                    </th>
                    <th>
                        {{ trans('cruds.gambarUkur.fields.scan_gu') }}
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
                            @foreach($pengukurans as $key => $item)
                                <option value="{{ $item->no_gu }}">{{ $item->no_gu }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($desas as $key => $item)
                                <option value="{{ $item->nama_desa }}">{{ $item->nama_desa }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
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
@can('gambar_ukur_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.gambar-ukurs.massDestroy') }}",
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
    ajax: "{{ route('admin.gambar-ukurs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id_pengukuran_no_gu', name: 'id_pengukuran.no_gu' },
{ data: 'id_pengukuran.tanggal_pengukuran', name: 'id_pengukuran.tanggal_pengukuran' },
{ data: 'id_kecamatan_nama_kecamatan', name: 'id_kecamatan.nama_kecamatan' },
{ data: 'id_desa_nama_desa', name: 'id_desa.nama_desa' },
{ data: 'id_desa.kode_desa', name: 'id_desa.kode_desa' },
{ data: 'scan_gu', name: 'scan_gu', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 3, 'asc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-GambarUkur').DataTable(dtOverrideGlobals);
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
