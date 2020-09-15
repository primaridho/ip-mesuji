@extends('layouts.admin')
@section('content')
@can('petum_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.peta.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.petum.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.petum.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Petum">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.petum.fields.id_kecamatan') }}
                    </th>
                    <th>
                        {{ trans('cruds.petum.fields.id_desa') }}
                    </th>
                    <th>
                        {{ trans('cruds.petum.fields.no_peta') }}
                    </th>
                    <th>
                        {{ trans('cruds.petum.fields.no_lembar') }}
                    </th>
                    <th>
                        {{ trans('cruds.petum.fields.tahun') }}
                    </th>
                    <th>
                        {{ trans('cruds.petum.fields.status_peta') }}
                    </th>
                    <th>
                        {{ trans('cruds.petum.fields.scan_peta') }}
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Petum::STATUS_PETA_SELECT as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
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
@can('petum_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.peta.massDestroy') }}",
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
    ajax: "{{ route('admin.peta.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id_kecamatan_nama_kecamatan', name: 'id_kecamatan.nama_kecamatan' },
{ data: 'id_desa_nama_desa', name: 'id_desa.nama_desa' },
{ data: 'no_peta', name: 'no_peta' },
{ data: 'no_lembar', name: 'no_lembar' },
{ data: 'tahun', name: 'tahun' },
{ data: 'status_peta', name: 'status_peta' },
{ data: 'scan_peta', name: 'scan_peta', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-Petum').DataTable(dtOverrideGlobals);
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
