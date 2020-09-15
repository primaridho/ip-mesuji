
<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pengukuran_create')): ?>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="<?php echo e(route('admin.pengukurans.create')); ?>">
                <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.pengukuran.title_singular')); ?>

            </a>
        </div>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.pengukuran.title_singular')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Pengukuran">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        <?php echo e(trans('cruds.pengukuran.fields.id_berkas')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.berkasMasuk.fields.tgl_masuk')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.berkasMasuk.fields.petugas_loket')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.pengukuran.fields.pembantu_ukur')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.pengukuran.fields.desa')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.pengukuran.fields.kecamatan')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.pengukuran.fields.no_gu')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.pengukuran.fields.no_su_baru')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.pengukuran.fields.tanggal_pengukuran')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.pengukuran.fields.file_dwg')); ?>

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
                            <?php $__currentLoopData = $berkas_masuks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->no_surattugas); ?>"><?php echo e($item->no_surattugas); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value><?php echo e(trans('global.all')); ?></option>
                            <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->nama); ?>"><?php echo e($item->nama); ?></option>
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
                        <select class="search">
                            <option value><?php echo e(trans('global.all')); ?></option>
                            <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->nama_kecamatan); ?>"><?php echo e($item->nama_kecamatan); ?></option>
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
                        <input class="search" type="text" placeholder="<?php echo e(trans('global.search')); ?>">
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
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pengukuran_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.pengukurans.massDestroy')); ?>",
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
    ajax: "<?php echo e(route('admin.pengukurans.index')); ?>",
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
{ data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DEV\laragon\www\ip-mesuji\resources\views/admin/pengukurans/index.blade.php ENDPATH**/ ?>