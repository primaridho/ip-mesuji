<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Pengukuran',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Pengukuran',
            'group_by_field'        => 'tanggal_pengukuran',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '30',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'           => 'Pengukuran Terakhir',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Pengukuran',
            'group_by_field'        => 'tanggal_pengukuran',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'tanggal_pengukuran' => '',
                'desa'               => 'nama_desa',
                'kecamatan'          => 'nama_kecamatan',
                'pembantu_ukurs'     => 'nama',
            ],
        ];

        $settings2['data'] = [];

        if (class_exists($settings2['model'])) {
            $settings2['data'] = $settings2['model']::latest()
                ->take($settings2['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings2)) {
            $settings2['fields'] = [];
        }

        $settings3 = [
            'chart_title'           => 'Berkas masuk terbaru',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\BerkasMasuk',
            'group_by_field'        => 'tgl_masuk',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'tgl_masuk'      => '',
                'petugas_loket'  => '',
                'penerima_masuk' => 'nama',
                'jenis_kegiatan' => '',
                'nama_pemohon'   => '',
                'desa'           => 'nama_desa',
                'kecamatan'      => 'nama_kecamatan',
            ],
        ];

        $settings3['data'] = [];

        if (class_exists($settings3['model'])) {
            $settings3['data'] = $settings3['model']::latest()
                ->take($settings3['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings3)) {
            $settings3['fields'] = [];
        }

        $settings4 = [
            'chart_title'           => 'Job',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Jodesk',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '30',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '10',
            'fields'                => [
                'nama_jodesk' => '',
                'deskripsi'   => '',
                'status'      => '',
                'petugas'     => 'nama',
            ],
        ];

        $settings4['data'] = [];

        if (class_exists($settings4['model'])) {
            $settings4['data'] = $settings4['model']::latest()
                ->take($settings4['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings4)) {
            $settings4['fields'] = [];
        }

        return view('home', compact('chart1', 'settings2', 'settings3', 'settings4'));
    }
}
