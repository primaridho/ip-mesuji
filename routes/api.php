<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Kecamatans
    Route::apiResource('kecamatans', 'KecamatanApiController');

    // Desas
    Route::apiResource('desas', 'DesaApiController');

    // Surat Ukurs
    Route::post('surat-ukurs/media', 'SuratUkurApiController@storeMedia')->name('surat-ukurs.storeMedia');
    Route::apiResource('surat-ukurs', 'SuratUkurApiController');

    // Peta
    Route::post('peta/media', 'PetaApiController@storeMedia')->name('peta.storeMedia');
    Route::apiResource('peta', 'PetaApiController');

    // Teams
    Route::post('teams/media', 'TeamApiController@storeMedia')->name('teams.storeMedia');
    Route::apiResource('teams', 'TeamApiController');

    // Berkas Masuks
    Route::post('berkas-masuks/media', 'BerkasMasukApiController@storeMedia')->name('berkas-masuks.storeMedia');
    Route::apiResource('berkas-masuks', 'BerkasMasukApiController');

    // Pengukurans
    Route::post('pengukurans/media', 'PengukuranApiController@storeMedia')->name('pengukurans.storeMedia');
    Route::apiResource('pengukurans', 'PengukuranApiController');

    // Berkas Keluars
    Route::post('berkas-keluars/media', 'BerkasKeluarApiController@storeMedia')->name('berkas-keluars.storeMedia');
    Route::apiResource('berkas-keluars', 'BerkasKeluarApiController');

    // Gambar Ukurs
    Route::post('gambar-ukurs/media', 'GambarUkurApiController@storeMedia')->name('gambar-ukurs.storeMedia');
    Route::apiResource('gambar-ukurs', 'GambarUkurApiController');

    // Jodesks
    Route::apiResource('jodesks', 'JodeskApiController');

    // Isi Berkas
    Route::apiResource('isi-berkas', 'IsiBerkasApiController');
});
