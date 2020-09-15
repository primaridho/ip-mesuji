<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Kecamatans
    Route::delete('kecamatans/destroy', 'KecamatanController@massDestroy')->name('kecamatans.massDestroy');
    Route::resource('kecamatans', 'KecamatanController');

    // Desas
    Route::delete('desas/destroy', 'DesaController@massDestroy')->name('desas.massDestroy');
    Route::resource('desas', 'DesaController');

    // Surat Ukurs
    Route::delete('surat-ukurs/destroy', 'SuratUkurController@massDestroy')->name('surat-ukurs.massDestroy');
    Route::post('surat-ukurs/media', 'SuratUkurController@storeMedia')->name('surat-ukurs.storeMedia');
    Route::post('surat-ukurs/ckmedia', 'SuratUkurController@storeCKEditorImages')->name('surat-ukurs.storeCKEditorImages');
    Route::resource('surat-ukurs', 'SuratUkurController');

    // Peta
    Route::delete('peta/destroy', 'PetaController@massDestroy')->name('peta.massDestroy');
    Route::post('peta/media', 'PetaController@storeMedia')->name('peta.storeMedia');
    Route::post('peta/ckmedia', 'PetaController@storeCKEditorImages')->name('peta.storeCKEditorImages');
    Route::resource('peta', 'PetaController');

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::post('teams/media', 'TeamController@storeMedia')->name('teams.storeMedia');
    Route::post('teams/ckmedia', 'TeamController@storeCKEditorImages')->name('teams.storeCKEditorImages');
    Route::resource('teams', 'TeamController');

    // Berkas Masuks
    Route::delete('berkas-masuks/destroy', 'BerkasMasukController@massDestroy')->name('berkas-masuks.massDestroy');
    Route::post('berkas-masuks/media', 'BerkasMasukController@storeMedia')->name('berkas-masuks.storeMedia');
    Route::post('berkas-masuks/ckmedia', 'BerkasMasukController@storeCKEditorImages')->name('berkas-masuks.storeCKEditorImages');
    Route::resource('berkas-masuks', 'BerkasMasukController');

    // Pengukurans
    Route::delete('pengukurans/destroy', 'PengukuranController@massDestroy')->name('pengukurans.massDestroy');
    Route::post('pengukurans/media', 'PengukuranController@storeMedia')->name('pengukurans.storeMedia');
    Route::post('pengukurans/ckmedia', 'PengukuranController@storeCKEditorImages')->name('pengukurans.storeCKEditorImages');
    Route::resource('pengukurans', 'PengukuranController');

    // Berkas Keluars
    Route::delete('berkas-keluars/destroy', 'BerkasKeluarController@massDestroy')->name('berkas-keluars.massDestroy');
    Route::post('berkas-keluars/media', 'BerkasKeluarController@storeMedia')->name('berkas-keluars.storeMedia');
    Route::post('berkas-keluars/ckmedia', 'BerkasKeluarController@storeCKEditorImages')->name('berkas-keluars.storeCKEditorImages');
    Route::resource('berkas-keluars', 'BerkasKeluarController');

    // Gambar Ukurs
    Route::delete('gambar-ukurs/destroy', 'GambarUkurController@massDestroy')->name('gambar-ukurs.massDestroy');
    Route::post('gambar-ukurs/media', 'GambarUkurController@storeMedia')->name('gambar-ukurs.storeMedia');
    Route::post('gambar-ukurs/ckmedia', 'GambarUkurController@storeCKEditorImages')->name('gambar-ukurs.storeCKEditorImages');
    Route::resource('gambar-ukurs', 'GambarUkurController');

    // Jodesks
    Route::delete('jodesks/destroy', 'JodeskController@massDestroy')->name('jodesks.massDestroy');
    Route::resource('jodesks', 'JodeskController');

    // Isi Berkas
    Route::delete('isi-berkas/destroy', 'IsiBerkasController@massDestroy')->name('isi-berkas.massDestroy');
    Route::resource('isi-berkas', 'IsiBerkasController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
