
<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('petum_create')): ?>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="<?php echo e(route('admin.peta.create')); ?>">
                <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.petum.title_singular')); ?>

            </a>
        </div>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.petum.title_singular')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Petum">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        <?php echo e(trans('cruds.petum.fields.id_kecamatan')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.petum.fields.id_desa')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.petum.fields.no_peta')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.petum.fields.no_lembar')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.petum.fields.tahun')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.petum.fields.status_peta')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.petum.fields.scan_peta')); ?>

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
                            <option value><?php echo e(trans('global.all')); ?></option>
                            <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->nama_kecamatan); ?>"><?php echo e($item->nama_kecamatan); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value><?php echo e(trans('global.all')); ?></option>
                            <?php $__currentLoopData = $desas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->nama_desa); ?>"><?php echo e($item->nama_desa); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="<?php echo e(trans('global.search')); ?>">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="<?php echo e(trans('global.search')); ?>">
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value><?php echo e(trans('global.all')); ?></option>
                            <?php $__currentLoopData = App\Petum::STATUS_PETA_SELECT; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item); ?>"><?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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



<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('petum_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.peta.massDestroy')); ?>",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('<?php echo e(trans('global.datatables.zero_selected')); ?>')

        return
      }

      if (confirm('<?php echo e(trans('global.areYouSure')); ?>')) {
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
<?php endif; ?>

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "<?php echo e(route('admin.peta.index')); ?>",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id_kecamatan_nama_kecamatan', name: 'id_kecamatan.nama_kecamatan' },
{ data: 'id_desa_nama_desa', name: 'id_desa.nama_desa' },
{ data: 'no_peta', name: 'no_peta' },
{ data: 'no_lembar', name: 'no_lembar' },
{ data: 'tahun', name: 'tahun' },
{ data: 'status_peta', name: 'status_peta' },
{ data: 'scan_peta', name: 'scan_peta', sortable: false, searchable: false },
{ data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DEV\laragon\www\ip-mesuji\resources\views/admin/peta/index.blade.php ENDPATH**/ ?>