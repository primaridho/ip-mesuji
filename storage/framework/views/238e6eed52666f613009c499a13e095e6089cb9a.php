<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

  <div class="c-sidebar-brand d-md-down-none">
      <a class="c-sidebar-brand-full h4" href="#">
        <img style="margin-right: 10px;" width="50" height="50" alt="atr" src="<?php echo e(url('img/atr.png')); ?>" >
      </a>
    <span><?php echo e(trans('panel.site_title')); ?>

    <br><h4><?php echo e(trans('panel.ip')); ?><h4></span>
  </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="<?php echo e(route("admin.home")); ?>" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                <?php echo e(trans('global.dashboard')); ?>

            </a>
        </li>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('informasi_berka_access')): ?>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                    </i>
                    <?php echo e(trans('cruds.informasiBerka.title')); ?>

                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('berkas_masuk_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.berkas-masuks.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/berkas-masuks") || request()->is("admin/berkas-masuks/*") ? "active" : ""); ?>">
                                <i class="fa-fw far fa-envelope c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.berkasMasuk.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('berkas_keluar_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.berkas-keluars.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/berkas-keluars") || request()->is("admin/berkas-keluars/*") ? "active" : ""); ?>">
                                <i class="fa-fw far fa-envelope-open c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.berkasKeluar.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('jobdesk_access')): ?>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-building c-sidebar-nav-icon">

                    </i>
                    <?php echo e(trans('cruds.jobdesk.title')); ?>

                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pengukuran_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.pengukurans.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/pengukurans") || request()->is("admin/pengukurans/*") ? "active" : ""); ?>">
                                <i class="fa-fw fas fa-ruler c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.pengukuran.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('jodesk_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.jodesks.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/jodesks") || request()->is("admin/jodesks/*") ? "active" : ""); ?>">
                                <i class="fa-fw fas fa-tasks c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.jodesk.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventarisasi_access')): ?>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-archive c-sidebar-nav-icon">

                    </i>
                    <?php echo e(trans('cruds.inventarisasi.title')); ?>

                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('surat_ukur_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.surat-ukurs.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/surat-ukurs") || request()->is("admin/surat-ukurs/*") ? "active" : ""); ?>">
                                <i class="fa-fw fas fa-atlas c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.suratUkur.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('petum_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.peta.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/peta") || request()->is("admin/peta/*") ? "active" : ""); ?>">
                                <i class="fa-fw far fa-map c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.petum.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gambar_ukur_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.gambar-ukurs.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/gambar-ukurs") || request()->is("admin/gambar-ukurs/*") ? "active" : ""); ?>">
                                <i class="fa-fw far fa-images c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.gambarUkur.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_management_access')): ?>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users-cog c-sidebar-nav-icon">

                    </i>
                    <?php echo e(trans('cruds.userManagement.title')); ?>

                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('kecamatan_access')): ?>
                      <li class="c-sidebar-nav-item">
                          <a href="<?php echo e(route("admin.kecamatans.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/kecamatans") || request()->is("admin/kecamatans/*") ? "active" : ""); ?>">
                              <i class="fa-fw fas fa-map-marked-alt c-sidebar-nav-icon">

                              </i>
                              <?php echo e(trans('cruds.kecamatan.title')); ?>

                          </a>
                      </li>
                  <?php endif; ?>
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('desa_access')): ?>
                      <li class="c-sidebar-nav-item">
                          <a href="<?php echo e(route("admin.desas.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/desas") || request()->is("admin/desas/*") ? "active" : ""); ?>">
                              <i class="fa-fw fas fa-map-marker-alt c-sidebar-nav-icon">

                              </i>
                              <?php echo e(trans('cruds.desa.title')); ?>

                          </a>
                      </li>
                  <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isi_berka_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.isi-berkas.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/isi-berkas") || request()->is("admin/isi-berkas/*") ? "active" : ""); ?>">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.isiBerka.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('team_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.teams.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : ""); ?>">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.team.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.permissions.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : ""); ?>">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.permission.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.roles.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : ""); ?>">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.role.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.users.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/users") || request()->is("admin/users/*") ? "active" : ""); ?>">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.user.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('audit_log_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.audit-logs.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : ""); ?>">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.auditLog.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('profile_password_edit')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : ''); ?>" href="<?php echo e(route('profile.password.edit')); ?>">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        <?php echo e(trans('global.change_password')); ?>

                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                <?php echo e(trans('global.logout')); ?>

            </a>
        </li>
    </ul>

</div>
<?php /**PATH D:\DEV\laragon\www\ip-mesuji\resources\views/partials/menu.blade.php ENDPATH**/ ?>