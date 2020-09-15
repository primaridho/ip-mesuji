<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

  <div class="c-sidebar-brand d-md-down-none">
      <a class="c-sidebar-brand-full h4" href="#">
        <img style="margin-right: 10px;" width="50" height="50" alt="atr" src="{{ url('img/atr.png') }}" >
      </a>
    <span>{{ trans('panel.site_title') }}
    <br><h4>{{ trans('panel.ip') }}<h4></span>
  </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('informasi_berka_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.informasiBerka.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('berkas_masuk_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.berkas-masuks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/berkas-masuks") || request()->is("admin/berkas-masuks/*") ? "active" : "" }}">
                                <i class="fa-fw far fa-envelope c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.berkasMasuk.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('berkas_keluar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.berkas-keluars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/berkas-keluars") || request()->is("admin/berkas-keluars/*") ? "active" : "" }}">
                                <i class="fa-fw far fa-envelope-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.berkasKeluar.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('jobdesk_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-building c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.jobdesk.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('pengukuran_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.pengukurans.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pengukurans") || request()->is("admin/pengukurans/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-ruler c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.pengukuran.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('jodesk_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.jodesks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/jodesks") || request()->is("admin/jodesks/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-tasks c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.jodesk.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('inventarisasi_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-archive c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.inventarisasi.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('surat_ukur_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.surat-ukurs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/surat-ukurs") || request()->is("admin/surat-ukurs/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-atlas c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.suratUkur.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('petum_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.peta.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/peta") || request()->is("admin/peta/*") ? "active" : "" }}">
                                <i class="fa-fw far fa-map c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.petum.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('gambar_ukur_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.gambar-ukurs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/gambar-ukurs") || request()->is("admin/gambar-ukurs/*") ? "active" : "" }}">
                                <i class="fa-fw far fa-images c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.gambarUkur.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users-cog c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                  @can('kecamatan_access')
                      <li class="c-sidebar-nav-item">
                          <a href="{{ route("admin.kecamatans.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/kecamatans") || request()->is("admin/kecamatans/*") ? "active" : "" }}">
                              <i class="fa-fw fas fa-map-marked-alt c-sidebar-nav-icon">

                              </i>
                              {{ trans('cruds.kecamatan.title') }}
                          </a>
                      </li>
                  @endcan
                  @can('desa_access')
                      <li class="c-sidebar-nav-item">
                          <a href="{{ route("admin.desas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/desas") || request()->is("admin/desas/*") ? "active" : "" }}">
                              <i class="fa-fw fas fa-map-marker-alt c-sidebar-nav-icon">

                              </i>
                              {{ trans('cruds.desa.title') }}
                          </a>
                      </li>
                  @endcan
                    @can('isi_berka_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.isi-berkas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/isi-berkas") || request()->is("admin/isi-berkas/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.isiBerka.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('team_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.teams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.team.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
