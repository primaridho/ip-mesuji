<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'lokasi_access',
            ],
            [
                'id'    => 18,
                'title' => 'kecamatan_create',
            ],
            [
                'id'    => 19,
                'title' => 'kecamatan_edit',
            ],
            [
                'id'    => 20,
                'title' => 'kecamatan_show',
            ],
            [
                'id'    => 21,
                'title' => 'kecamatan_delete',
            ],
            [
                'id'    => 22,
                'title' => 'kecamatan_access',
            ],
            [
                'id'    => 23,
                'title' => 'desa_create',
            ],
            [
                'id'    => 24,
                'title' => 'desa_edit',
            ],
            [
                'id'    => 25,
                'title' => 'desa_show',
            ],
            [
                'id'    => 26,
                'title' => 'desa_delete',
            ],
            [
                'id'    => 27,
                'title' => 'desa_access',
            ],
            [
                'id'    => 28,
                'title' => 'inventarisasi_access',
            ],
            [
                'id'    => 29,
                'title' => 'surat_ukur_create',
            ],
            [
                'id'    => 30,
                'title' => 'surat_ukur_edit',
            ],
            [
                'id'    => 31,
                'title' => 'surat_ukur_show',
            ],
            [
                'id'    => 32,
                'title' => 'surat_ukur_delete',
            ],
            [
                'id'    => 33,
                'title' => 'surat_ukur_access',
            ],
            [
                'id'    => 34,
                'title' => 'petum_create',
            ],
            [
                'id'    => 35,
                'title' => 'petum_edit',
            ],
            [
                'id'    => 36,
                'title' => 'petum_show',
            ],
            [
                'id'    => 37,
                'title' => 'petum_delete',
            ],
            [
                'id'    => 38,
                'title' => 'petum_access',
            ],
            [
                'id'    => 39,
                'title' => 'team_create',
            ],
            [
                'id'    => 40,
                'title' => 'team_edit',
            ],
            [
                'id'    => 41,
                'title' => 'team_show',
            ],
            [
                'id'    => 42,
                'title' => 'team_delete',
            ],
            [
                'id'    => 43,
                'title' => 'team_access',
            ],
            [
                'id'    => 44,
                'title' => 'informasi_berka_access',
            ],
            [
                'id'    => 45,
                'title' => 'berkas_masuk_create',
            ],
            [
                'id'    => 46,
                'title' => 'berkas_masuk_edit',
            ],
            [
                'id'    => 47,
                'title' => 'berkas_masuk_show',
            ],
            [
                'id'    => 48,
                'title' => 'berkas_masuk_delete',
            ],
            [
                'id'    => 49,
                'title' => 'berkas_masuk_access',
            ],
            [
                'id'    => 50,
                'title' => 'pengukuran_create',
            ],
            [
                'id'    => 51,
                'title' => 'pengukuran_edit',
            ],
            [
                'id'    => 52,
                'title' => 'pengukuran_show',
            ],
            [
                'id'    => 53,
                'title' => 'pengukuran_delete',
            ],
            [
                'id'    => 54,
                'title' => 'pengukuran_access',
            ],
            [
                'id'    => 55,
                'title' => 'berkas_keluar_create',
            ],
            [
                'id'    => 56,
                'title' => 'berkas_keluar_edit',
            ],
            [
                'id'    => 57,
                'title' => 'berkas_keluar_show',
            ],
            [
                'id'    => 58,
                'title' => 'berkas_keluar_delete',
            ],
            [
                'id'    => 59,
                'title' => 'berkas_keluar_access',
            ],
            [
                'id'    => 60,
                'title' => 'gambar_ukur_create',
            ],
            [
                'id'    => 61,
                'title' => 'gambar_ukur_edit',
            ],
            [
                'id'    => 62,
                'title' => 'gambar_ukur_show',
            ],
            [
                'id'    => 63,
                'title' => 'gambar_ukur_delete',
            ],
            [
                'id'    => 64,
                'title' => 'gambar_ukur_access',
            ],
            [
                'id'    => 65,
                'title' => 'jodesk_create',
            ],
            [
                'id'    => 66,
                'title' => 'jodesk_edit',
            ],
            [
                'id'    => 67,
                'title' => 'jodesk_show',
            ],
            [
                'id'    => 68,
                'title' => 'jodesk_delete',
            ],
            [
                'id'    => 69,
                'title' => 'jodesk_access',
            ],
            [
                'id'    => 70,
                'title' => 'isi_berka_create',
            ],
            [
                'id'    => 71,
                'title' => 'isi_berka_edit',
            ],
            [
                'id'    => 72,
                'title' => 'isi_berka_show',
            ],
            [
                'id'    => 73,
                'title' => 'isi_berka_delete',
            ],
            [
                'id'    => 74,
                'title' => 'isi_berka_access',
            ],
            [
                'id'    => 75,
                'title' => 'jobdesk_access',
            ],
            [
                'id'    => 76,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 77,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 78,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
